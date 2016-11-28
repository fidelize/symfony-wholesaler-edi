<?php

namespace ApiBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client = null;

    public function setUp()
    {
        $this->client = self::createClient();
    }

    public function testInvalidLogin()
    {
        $this->client->request(
            'POST',
            '/user_token',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode([
                '_username' => 'test',
                '_password' => 'invalid_password',
            ])
        );

        $this->assertTrue($this->client->getResponse()->isClientError());
    }
}
