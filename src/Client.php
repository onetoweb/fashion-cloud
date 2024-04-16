<?php

namespace Onetoweb\FashionCloud;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use Onetoweb\FashionCloud\Endpoint\Endpoints;

/**
 * Fashion Cloud Api Client.
 */
#[\AllowDynamicProperties]
class Client
{
    /**
     * Base url
     */
    public const BASE_URL = 'https://api.fashion.cloud';
    
    /**
     * Methods.
     */
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    
    /**
     * @var string
     */
    private $token;
    
    /**
     * @var int
     */
    private $version;
    
    /**
     * @var string
     */
    private $acceptContentType = 'application/json';
    
    /**
     * @param string $token
     * @param int $version = 2
     */
    public function __construct(string $token, int $version = 2)
    {
        $this->token = $token;
        $this->version = $version;
        
        // load endpoints
        $this->loadEndpoints();
    }
    
    /**
     * @return void
     */
    private function loadEndpoints(): void
    {
        foreach (Endpoints::list() as $name => $class) {
            $this->{$name} = new $class($this);
        }
    }
    
    /**
     * @param string $acceptContentType
     *
     * @return void
     */
    public function setAcceptContentType(string $acceptContentType): void
    {
        $this->acceptContentType = $acceptContentType;
    }
    
    /**
     * @param string $endpoint
     * 
     * @return string
     */
    public function getUrl(string $endpoint): string
    {
        return implode('/', [
            self::BASE_URL,
            "v{$this->version}",
            $endpoint
        ]);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * 
     * @return array|null|string
     */
    public function get(string $endpoint, array $query = [])
    {
        return $this->request(self::METHOD_GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * 
     * @return array|string|null
     */
    public function post(string $endpoint, array $data = [])
    {
        return $this->request(self::METHOD_POST, $endpoint, $data);
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|string|null
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = [])
    {
        // add token to query
        $query['token'] = $this->token;
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'Accept' => $this->acceptContentType
            ],
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $data
        ];
        
        // make request
        $response = (new GuzzleCLient())->request($method, $this->getUrl($endpoint), $options);
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        if (
            $response->getHeaderLine('Content-Type') == 'application/json'
            or $response->getHeaderLine('Content-Type') == 'application/json; charset=utf-8'
        ) {
            
            // decode json
            $json = json_decode($contents, true);
            
            return $json;
            
        } else {
            
            // return raw contents
            return $contents;
        }
    }
}