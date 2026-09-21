<?php

namespace Onetoweb\FashionCloud;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use Onetoweb\FashionCloud\Endpoint\Endpoints;
use Onetoweb\FashionCloud\Config\Method;

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
    private $acceptContentType = 'application/json';
    
    /**
     * @param string $token
     * @param int $version = 2
     */
    public function __construct(
        
        #[\SensitiveParameter]
        private string $token,
        
        private int $version = 2
    ) {
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
        return $this->request(Method::GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * 
     * @return array|string|null
     */
    public function post(string $endpoint, array $data = [])
    {
        return $this->request(Method::POST, $endpoint, $data);
    }
    
    /**
     * @param Method $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|string|null
     */
    public function request(Method $method, string $endpoint, array $data = [], array $query = [])
    {
        // add token to query
        $query['token'] = $this->token;
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'Accept' => $this->acceptContentType
            ],
            RequestOptions::QUERY => $query
        ];
        
        if (count($data) > 0) {
            $options[RequestOptions::JSON] = $data;
        }
        
        // make request
        $response = (new GuzzleCLient())->request($method->value, $this->getUrl($endpoint), $options);
        
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
