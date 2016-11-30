<?php

namespace ApiBundle\Tests\FileManager;

use ApiBundle\FileManager\DirectoryBuilder;
use ApiBundle\Model\Order;
use PHPUnit\Framework\TestCase;

class OrderFileTest extends TestCase
{
    public function testConstructor()
    {
        $directory = (new DirectoryBuilder(__DIR__.'/../../../var/edi', 'edi/', 'pedidos/'))
            ->setIndustry('gsk')
            ->setWholesaler('santacruz')
            ->getDirectoryAddress();

        $order = (new Order())
            ->setProjectCode('GSK')
            ->setPosCode('88888888888888')
            ->setEmail('teste@teste.com')
            ->setWholesalerCode('99999999999999')
            ->setTerm('007')
            ->setConditionCode('TX')
            ->setOrderClient('S23333123DB')
            ->setMarkup('6')
            ->addItem((new Order\Item())
                ->setEan('7890000000001')
                ->setAmount(1)
                ->setMonitored(false)
                ->setDiscount(10.5)
                ->setNetPrice(12.50));
    }

    public function testSave()
    {
    }
}
