.. _top:
.. title:: Order

`Back to index <index.rst>`_

=====
Order
=====

.. contents::
    :local:


Create Order
````````````

.. code-block:: php
    
    $result = $client->order->create([
        'products' => [
            [
                'gtin' => '1234567890123',
                'quantity' => 10
            ]
        ],
        'clientId' => 'asd2123-123',
        'clientType' => 'erp',
        'debitor' => [
            'gln' => '1234567890123',
            'phone' => '+49 40 22 86 24 20',
            'name' => 'Fashion Cloud',
            'email' => 'info@fashion.cloud',
            'employeeId' => 'abc123',
            'employeeName' => 'John Doe'
        ],
        'shippingAddress' => [
            'gln' => '45678912344',
            'email' => 'john@example.com',
            'phone' => '01762343211',
            'name' => 'John Doe',
            'address1' => 'Hongkongstrasse 1',
            'address2' => '3rd floor',
            'city' => 'Hamburg',
            'zip' => '20457',
            'country' => 'DE'
        ],
        'billingAddress' => [
            'gln' => '45678912344',
            'email' => 'john@example.com',
            'phone' => '01762343211',
            'name' => 'John Doe',
            'address1' => 'Hongkongstrasse 1',
            'address2' => '3rd floor',
            'city' => 'Hamburg',
            'zip' => '20457',
            'country' => 'DE'
        ],
        'endCustomer' => [
            'customerNumber' => 'abc123',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '01762343211'
        ],
        'useDropshipping' => false,
        'type' => 'endless-aisle',
        'isTest' => true
    ]);


`Back to top <#top>`_