<?php

namespace ApiBundle\Tests\FileManager;

use ApiBundle\FileManager\DirectoryBuilder;
use ApiBundle\FileManager\FileManager;
use ApiBundle\Model\Order;
use PHPUnit\Framework\TestCase;

class FileManagerTest extends TestCase
{
    /**
     * @var FileManager File manager object
     */
    protected $fileManager;

    public function setUp()
    {
        $this->fileManager = new FileManager(
            new DirectoryBuilder(__DIR__.'/../../../var/edi', 'edi/', 'pedidos/')
        );
    }

    public function testBuildOrderFile()
    {
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

        $orderFile = $this->fileManager->buildOrderFile(12345, 'gsk', 'santacruz', $order);
        $orderFile->save();
        $file = $orderFile->getFile();
        $filename = $file->getPath().DIRECTORY_SEPARATOR.$file->getFilename();
        $this->assertTrue(file_exists($filename));
        unlink($filename);
    }
}
