<?php

namespace Dota2Stats\Bundle\WebBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client $client
     */
    protected $client;
            
    protected function setUp()
    {
        $this->client = static::createClient();
    }
    
    protected function tearDown()
    {
        $this->client = null;
    }
    
    public function testIndex()
    {

        $crawler = $this->client->request('GET', '/');
        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
}
