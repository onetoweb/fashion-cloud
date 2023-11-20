<?php

namespace Onetoweb\FashionCloud\Endpoint;

/**
 * Brand Endpoint.
 */
class Brand extends AbstractEndpoint
{
    /**
     * @see https://fashioncloudv2.docs.apiary.io/#reference/0/brands-collection/list-brands
     * 
     * @param array $query = []
     * 
     * @return array|null
     */
    public function list(array $query = []): ?array
    {
        return $this->client->get('brands', $query);
    }
}