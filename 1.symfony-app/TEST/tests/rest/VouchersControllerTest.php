<?php

use PHPUnit\Framework\TestCase;

class VouchersControllerTest extends TestCase
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
        $response = $this->client->post('/api/discounttiers/4/vouchers',[
            'json' => [
                'StartDate'=>'Banana',
                'EndDate'=>200
            ]
        ]);

        $this->assertEquals(201,$response->getStatusCode());
    }

    public function testBind()
    {
        $response = $this->client->post('/api/products/17/vouchers/4');

        $this->assertEquals(201,$response->getStatusCode());
    }

    public function testUnBind()
    {
        $response = $this->client->delete('/api/products/17/vouchers/4');

        $this->assertEquals(200,$response->getStatusCode());
    }
}