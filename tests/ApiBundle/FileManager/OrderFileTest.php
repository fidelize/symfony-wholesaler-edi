<?php

namespace ApiBundle\Tests\FileManager;

use ApiBundle\FileManager\DirectoryBuilder;
use ApiBundle\FileManager\OrderFile;
use ApiBundle\Model\Order;
use PHPUnit\Framework\TestCase;

class OrderFileTest extends TestCase
{
    /**
     * @var OrderFile Order file object
     */
    protected $orderFile;

    public function setUp()
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

        $filePath = (new DirectoryBuilder(__DIR__.'/../../../var/edi', 'edi/', 'pedidos/'))
            ->setIndustry('gsk')
            ->setWholesaler('santacruz')
            ->getDirectoryAddress();

        $this->orderFile = new OrderFile(12345, $filePath, $order);

        $this->assertEquals($filePath, $this->orderFile->getFilePath());
    }

    public function testCreateFilename()
    {
        $reflection = new \ReflectionClass(OrderFile::class);
        $method = $reflection->getMethod('createFilename');
        $method->setAccessible(true);
        $result = $method->invoke($this->orderFile);

        $this->assertContains(
            'PEDIDO_1234500000_99999999999999_GSK.PED',
            $result
        );
    }

    public function testWriterHeader()
    {
        $reflection = new \ReflectionClass(OrderFile::class);
        $method = $reflection->getMethod('writeHeader');
        $method->setAccessible(true);
        $result = $method->invokeArgs($this->orderFile, [
            '88888888888888',
            'teste@teste.com',
            '99999999999999',
            '007',
            'TX',
            'S23333123DB',
            12345,
            '6',
        ]);

        $this->assertEquals(
            '1;88888888888888;teste@teste.com;99999999999999;007;TX;S23333123DB;12345;6'.PHP_EOL,
            $result
        );
    }

    public function testWriteProduct()
    {
        $reflection = new \ReflectionClass(OrderFile::class);
        $method = $reflection->getMethod('writeProduct');
        $method->setAccessible(true);
        $result = $method->invokeArgs($this->orderFile, [
            '7890000000001',
            1,
            10.5,
            12.50,
        ]);

        $this->assertEquals(
            '2;7890000000001;1;10.5;12.5'.PHP_EOL,
            $result
        );
    }

    public function testWriteFooter()
    {
        $reflection = new \ReflectionClass(OrderFile::class);
        $method = $reflection->getMethod('writeFooter');
        $method->setAccessible(true);
        $result = $method->invokeArgs($this->orderFile, [
            2,
        ]);

        $this->assertEquals(
            '9;2'.PHP_EOL,
            $result
        );
    }

    public function testSave()
    {
        $orderFile = $this->getMockBuilder(OrderFile::class)
            ->setConstructorArgs([
                12345,
                __DIR__,
                (new Order())
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
                        ->setNetPrice(12.50)),
            ])
            ->setMethods([
                'createFileObject',
            ])
            ->getMock();

        $orderFile
            ->expects($this->once())
            ->method('createFileObject')
            ->willReturn(new \SplFileObject('php://memory'));

        $reflection = new \ReflectionClass(OrderFile::class);
        $method = $reflection->getMethod('save');
        $result = $method->invoke($orderFile);

        $this->assertTrue($result instanceof \SplFileObject);
    }

    public function testCreateFileObject()
    {
        $reflection = new \ReflectionClass(OrderFile::class);
        $method = $reflection->getMethod('createFileObject');
        $method->setAccessible(true);
        $result = $method->invoke($this->orderFile);
        $this->assertTrue($result instanceof \SplFileObject);
        unlink($result->getPath().DIRECTORY_SEPARATOR.$result->getFilename());
    }
}
