<?php

use PHPUnit\Framework\TestCase;

class ProductsControllerTest extends TestCase
{
    private $client;

    public function setUp() :void
    {
        $this->client=new GuzzleHttp\Client(['base_uri' => 'http://localhost:8000/api/'],[
            'request.options'=>[
            'exceptions'=>false
            ]
        ]);
    }

    public function tearDown() :void
    {
        $this->client=null;
    }

    public function testPost()
    {
        $response = $this->client->post('/api/products',[
            'json' => [
                'Name'=>'Banana',
                'Price'=>200
            ]
        ]);

        $this->assertEquals(201,$response->getStatusCode());
    }

//     public function testPost404()
//     {
//         $response = $this->client->post('/api/products',[
//             'json' => [
//             'Name'=>'Banana',
//             'Price'=>"2412gtes341"
//             ]
//         ]);
//
//          $this->assertEquals(404,$response->getStatusCode();
//     }

    public function testDelete()
    {
        $response = $this->client->delete('/api/products/16',[
            'http_errors'=>false//ne baci exception Gruzzle ako api vrati false
        ]);

        $this->assertEquals(404,$response->getStatusCode());
    }
}