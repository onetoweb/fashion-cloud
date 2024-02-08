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
    
    $brandId = '{brand_id}';
    $result = $client->product->list([
        'offset' => 0,
        'limit' => 10,
        'brand' => $brandId,
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