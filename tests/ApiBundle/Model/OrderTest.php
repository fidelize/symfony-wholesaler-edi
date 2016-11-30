<?php

namespace ApiBundle\Tests\Model;

use ApiBundle\Model\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     * @var Order Order object
     */
    protected $order;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->order = new Order();
        $this->assertEquals(0, count($this->order->getItens()));
    }

    public function testDataManipulation()
    {
        $this->order
            ->setProjectCode('GSK')
            ->setPosCode('88888888888888')
            ->setEmail('teste@teste.com')
            ->setWholesalerCode('99999999999999')
            ->setTerm('007')
            ->setConditionCode('TX')
            ->setOrderClient('S23333123DB')
            ->setMarkup('6');

        $this->assertEquals('GSK', $this->order->getProjectCode());
        $this->assertEquals('88888888888888', $this->order->getPosCode());
        $this->assertEquals('teste@teste.com', $this->order->getEmail());
        $this->assertEquals('99999999999999', $this->order->getWholesalerCode());
        $this->assertEquals('007', $this->order->getTerm());
        $this->assertEquals('TX', $this->order->getConditionCode());
        $this->assertEquals('S23333123DB', $this->order->getOrderClient());
        $this->assertEquals('6', $this->order->getMarkup());

        $orderItem = new Order\Item();
        $this->order->addItem($orderItem);
        $this->assertEquals(1, count($this->order->getItens()));
        $this->order->removeItem($orderItem);
        $this->assertEquals(0, count($this->order->getItens()));
        $this->order->setItens([$orderItem]);
        $this->assertEquals(1, count($this->order->getItens()));
    }
}
