<?php

namespace ApiBundle\Tests\Model\Order;

use ApiBundle\Model\Order\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * @var Item Order item object
     */
    protected $item;

    public function setUp()
    {
        $this->item = new Item();
    }

    public function testDataManipulation()
    {
        $this->item
            ->setEan('78900000001')
            ->setAmount(1)
            ->setMonitored(false)
            ->setDiscount(10.5)
            ->setNetPrice(12.50);

        $this->assertEquals('78900000001', $this->item->getEan());
        $this->assertEquals(1, $this->item->getAmount());
        $this->assertEquals(false, $this->item->isMonitored());
        $this->assertEquals(10.5, $this->item->getDiscount());
        $this->assertEquals(12.50, $this->item->getNetPrice());
    }

}
