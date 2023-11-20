<?php

namespace Onetoweb\FashionCloud\Endpoint;

/**
 * Product Endpoint.
 */
class Product extends AbstractEndpoint
{
    /**
     * @see https://fashioncloudv2.docs.apiary.io/#reference/0/products-collection/list-products
     * 
     * @param array $query = []
     * 
     * @return array|null
     */
    public function list(array $query = []): ?array
    {
        return $this->client->get('products', $query);
    }
    
    /**
     * @see https://fashioncloudv2.docs.apiary.io/#reference/0/products-collection/load-product-image
     * 
     * @param string $imageId
     * @param array $query = []
     * 
     * @return array|string|null
     */
    public function loadImage(string $imageId, array $query = [])
    {
        return $this->client->get("products/media/images/$imageId", $query);
    }
    
    /**
     * @see https://fashioncloudv2.docs.apiary.io/#reference/0/products-collection/get-product-prices
     * 
     * @param array $query = []
     * 
     * @return array|string|null
     */
    public function prices(array $query = []): ?array
    {
        return $this->client->get('products/prices', $query);
    }
}