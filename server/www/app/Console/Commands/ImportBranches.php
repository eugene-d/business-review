<?php namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use URLify;


class ImportBranches extends Command {
    private $httpClient;
    private $httpClientCookies;
    private $baseUrl = 'http://localhost';
    private $resourceUrl = '/api/v1/branch';
    private $token = '';

    /**
     * The console command name.
     * @var string
     */
    protected $name = 'branch:import';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Importing branches from file.';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get baseUrl from options or set localhost and create guzzle http client with cookies
     */
    private function setClient() {
        if ($this->option('baseUrl')) {
            $this->baseUrl = $this->option('baseUrl');
        }

        $this->httpClient = new Client(['base_url' => $this->baseUrl]);
        $this->httpClientCookies = new CookieJar();
        $this->token = $this->getXsrfToken();
    }

    /**
     * Send GET request to API and retrieve XSRF-TOKEN from response cookies
     * @return string
     */
    private function getXsrfToken() {
        $token = '';
        $this->info('Send GET request to: ' . $this->baseUrl . $this->resourceUrl);
        $this->httpClient->get($this->resourceUrl, ['cookies' => $this->httpClientCookies]);

        foreach ($this->httpClientCookies->toArray() as $cookie) {
            if ($cookie['Name'] === 'XSRF-TOKEN') {
                $token = $cookie['Value'];
            }
        }
        return urldecode($token);
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function fire() {
        $this->setClient();

        switch ($this->option('fileType')) {
            case 'json':
                $this->importFromJson();
                break;
            case 'csv':
                $this->info('Implementation is in progress.');
                break;
        }
    }

    /**
     * Run import process from json file
     */
    private function importFromJson() {
        $jsonBranches = $this->getJson();

        foreach ($jsonBranches as $branch) {
            $data = (array) $branch;
            $data = $this->fixCreatedAt($data);
            $data = $this->fixUs($data);
            $data = $this->fixUs($data, 'description');
            $data = $this->fixRequest($data);

            $this->post($data);
        }
    }

    /**
     * Create new branch by sending POST request to API
     * @param array $requestBody
     */
    private function post(Array $requestBody) {
        try {
            $request = $this->httpClient->createRequest('POST', $this->resourceUrl, [
                'cookies' => $this->httpClientCookies,
                'headers' => ['X-XSRF-TOKEN' => $this->token],
                'body' => $requestBody
            ]);

            $this->info('Send POST request to: ' . $this->baseUrl . $this->resourceUrl);
            $response = $this->httpClient->send($request);
            $this->info('POST response: ' . $response->json()['message']);
        } catch (ClientException $e) {
            $this->error("POST request error: ");
            //$this->comment($e->getRequest());
            $this->comment($e->getResponse());
            //exit();
        }
    }

    /**
     * Open file and retrieve json content
     * @return mixed|null
     */
    private function getJson() {
        $json = null;

        if (File::exists($this->argument('filePath')) AND File::isFile($this->argument('filePath'))) {
            $this->info('Getting data from: ' . $this->argument('filePath'));
            $json = $this->parseJson(File::get($this->argument('filePath')));
        } else {
            $this->error("Can't open: " . $this->argument('filePath'));
        }
        return (array)$json;
    }

    /**
     * Decode json string into json object with ability to see parsing errors
     * @param $jsonString
     * @return mixed
     */
    private function parseJson($jsonString) {
        $jsonString = trim($jsonString);
        $jsonObject = json_decode($jsonString);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                break;
            case JSON_ERROR_DEPTH:
                $this->error('JSON_ERROR: The maximum stack depth has been exceeded');
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $this->error('JSON_ERROR: Invalid or malformed JSON');
                break;
            case JSON_ERROR_CTRL_CHAR:
                $this->error('JSON_ERROR: Unexpected control character found');
                break;
            case JSON_ERROR_SYNTAX:
                $this->error('JSON_ERROR: Syntax error, malformed JSON');
                break;
            case JSON_ERROR_UTF8:
                $this->error('JSON_ERROR: Malformed UTF-8 characters, possibly incorrectly encoded');
                break;
            default:
                $this->error('JSON_ERROR: Unknown error');
                break;
        }
        return $jsonObject;
    }


    /**
     * Try to add created_at field
     * @param $in
     * @return array
     */
    private function fixCreatedAt($in) {
        if (!array_key_exists('created_at', $in)) {
            $this->comment('Field created_at not detected try to fix it.');
            $in = array_merge($in, ['created_at' => Carbon::now()->toDateTimeString()]);
        }
        return $in;
    }

    /**
     * Try to add lang dependent field
     * @param $in
     * @param string $field
     * @return array
     */
    private function fixUs($in, $field = 'name') {
        if (!array_key_exists($field . '_us', $in)) {
            $this->comment('Field ' . $field . '_us not detected try to fix it.');
            if(array_key_exists($field . '_ua', $in)){
                $in = array_merge($in, [$field . '_us' => URLify::downcode($in[$field . '_ua'], 'uk')]);
            } elseif (array_key_exists('name_ru', $in)) {
                $in = array_merge($in, [$field . '_us' => URLify::downcode($in[$field . '_ru'], 'ru')]);
            }
        }
        return $in;
    }

    /**
     * Try to add request field
     * @param $in
     * @return array
     */
    private function fixRequest($in) {
        if (!array_key_exists('request', $in) AND array_key_exists('name_us', $in)) {
            $this->comment('Field request not detected try to fix it.');
            $in = array_merge($in, ['request' => URLify::filter($in['name_us'])]);
        }
        return $in;
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments() {
        return [
            ['filePath', InputArgument::REQUIRED, 'Path to file with data.'],
        ];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions() {
        return [
            ['fileType', null, InputOption::VALUE_OPTIONAL, 'File type, default json. (json, csv)', 'json'],
            ['baseUrl', null, InputOption::VALUE_OPTIONAL, 'API host name "http://localhost".', null],
        ];
    }
}