<?php namespace App\Console\Commands\Import;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Branches extends Command {
    private $httpClient;
    private $httpClientCookies;
    private $baseUrl = 'http://localhost';
    private $resourceUrl = '/api/v1/branch';
    private $token = '';
    private $fileJson;

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
        $this->fileJson = new FileJson();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function fire() {
        $this->setClient();

        switch ($this->option('fileType')) {
            case 'json':
                $this->fileJson->run($this);
                break;
            case 'csv':
                $this->info('Implementation is in progress.');
                break;
        }
    }

    /**
     * Create new branch by sending POST request to API
     * @param array $requestBody
     */
    public function post(Array $requestBody) {
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
            //$this->comment($e->getRequest());
            $this->error($e->getResponse());
        }
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
            ['fileType', null, InputOption::VALUE_OPTIONAL, 'File type. [json|csv]', 'json'],
            ['baseUrl', null, InputOption::VALUE_OPTIONAL, 'API host name "http://localhost".', null],
        ];
    }
}