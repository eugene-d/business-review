<?php namespace App\Console\Commands\Import;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;

class HttpClient extends Common {
    private $httpClient;
    private $httpClientCookies;
    private $baseUrl = '';
    private $resourceUrl = '/api/v1/branch';
    private $tokenUrl = '/api/v1/branch';
    private $token = '';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
        $this->httpClient = new Client();
        $this->httpClientCookies = new CookieJar();
    }

    /**
     * Create new branch by sending POST request to API
     * @param array $requestBody
     */
    public function post(Array $requestBody) {
        try {
            $request = $this->httpClient->createRequest('POST', $this->baseUrl . $this->resourceUrl, [
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
     * Set baseUrl from options for guzzle http client
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl) {
        $this->baseUrl = $baseUrl;
        $this->token = $this->getXsrfToken();
    }

    /**
     * Set resourceUrl from options for guzzle http client
     * @param string $resourceUrl
     */
    public function setResourceUrl($resourceUrl) {
        $this->resourceUrl = $resourceUrl;
    }

    /**
     * Send GET request to API and retrieve XSRF-TOKEN from response cookies
     * @return string
     */
    private function getXsrfToken() {
        $token = '';
        $this->info('Send GET request for retrieve token to: ' . $this->baseUrl . $this->resourceUrl);
        $this->httpClient->get($this->baseUrl . $this->tokenUrl, ['cookies' => $this->httpClientCookies]);

        foreach ($this->httpClientCookies->toArray() as $cookie) {
            if ($cookie['Name'] === 'XSRF-TOKEN') {
                $token = $cookie['Value'];
            }
        }
        return urldecode($token);
    }
}