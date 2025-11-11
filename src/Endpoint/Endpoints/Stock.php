<?php

namespace Onetoweb\FashionCloud\Endpoint\Endpoints;

use Onetoweb\FashionCloud\Endpoint\AbstractEndpoint;

/**
 * Stock Endpoint.
 */
class Stock extends AbstractEndpoint
{
    /**
     * @see https://fashioncloudv2.docs.apiary.io/#reference/0/stock-data/get-product's-stock-api
     * 
     * @param string $gtin
     * 
     * @return mixed
     */
    public function list(string $gtin)
    {
        return $this->client->get("products/$gtin/stock");
    }
}