<?php

namespace Onetoweb\FashionCloud\Endpoint\Endpoints;

use Onetoweb\FashionCloud\Endpoint\AbstractEndpoint;

/**
 * Order Endpoint.
 */
class Order extends AbstractEndpoint
{
    /**
     * @see https://fashioncloudv2.docs.apiary.io/#reference/0/orders/post-order-api
     * 
     * @param string $gtin
     *
     * @return array|null
     */
    public function create(array $data): ?array
    {
        return $this->client->post('orders', $data);
    }
}