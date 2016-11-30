<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class OrderControllerTest extends WebTestCase
{
    protected function createAuthenticatedClient($username = 'teste', $password = '1234')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user_token',
            [
                '_username' => 'teste',
                '_password' => '1234'
            ]
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testCreateAction()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/api/v1/order',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            json_encode([
                'id' => 12345,
                'wholesaler' => 'santacruz',
                'industry' => 'gsk',
                'layout' => '1.0',
                'order' => [
                    'project_code' => 'GSK',
                    'pos_code' => '88888888888888',
                    'email' => 'teste@teste.com',
                    'wholesaler_code' => '99999999999999',
                    'term' => '007',
                    'condition_code' => 'TX',
                    'order_client' => 'S23333123DB',
                    'markup' => '6',
                    'itens' => [
                        [
                            'ean' => '7890000000001',
                            'amount' => 1,
                            'monitored' => false,
                            'discount' => 10.5,
                            'net_price' => 12.5,
                        ],
                        [
                            'ean' => '7890000000002',
                            'amount' => 2,
                            'monitored' => false,
                            'discount' => 0.5,
                            'net_price' => 10,
                        ],
                    ],
                ],
            ])
        );

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());

    }
}
