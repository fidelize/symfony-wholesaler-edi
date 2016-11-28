<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client = null;

    public function setUp()
    {
        $this->client = self::createClient();
    }

    public function testCreateAction()
    {
    }
}
