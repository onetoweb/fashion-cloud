.. _top:
.. title:: Product

`Back to index <index.rst>`_

=======
Product
=======

.. contents::
    :local:


List Products
`````````````

.. code-block:: php
    
    $result = $client->product->list([
        
        'offset' => 0,
        'limit' => 10,
        
        // optional parameters (either brand, or gtin, or articleNumber must be provided)
        'brand' => '{brand_id}',
        'gtin' => '{gtin}',
        'articleNumber' => '{article_Number}',
        
        // other optional parameters
        'lang' => 'nl', // supported languages: en, de, ru, fr, nl, it, da, bg, et, fi, el, ga, hr, lv, lt, no, pl, pt, ro, sv, sk, sl, es, cs, hu, tr
        'season' => 'spring_summer', // possible values are: fall_winter, spring_summer, nos, none
        'seasonYear' => 2024,
        'updatedSince' => '2024-02-27',
        'includePreliminary' => false,
        'includeProductsWithoutImages' => false,
    ]);


Load Product Image
``````````````````

.. code-block:: php
    
    $imageId = '{image_id}';
    $result = $client->product->loadImage($imageId, [
        'px' => '200', // possible values are: '200', '512', '1024'
        'watermark' => false,
        'minAcceptableSize' => '200'// possible values are: '200', '512', '1024'
    ]);
    
    // write data to file
    file_put_contents('/path/to/filename.jpg', $result);


Get Product Prices
``````````````````

.. code-block:: php
    
    $result = $client->product->prices([
        'brand' => '',
        'gtins' => '',
        'updatedSince' => '',
        'limit' => '',
        'afterId' => ''
    ]);


`Back to top <#top>`_