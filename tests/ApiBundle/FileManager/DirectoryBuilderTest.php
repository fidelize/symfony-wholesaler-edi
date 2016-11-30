<?php

namespace ApiBundle\Tests\FileManager;

use ApiBundle\FileManager\DirectoryBuilder;
use PHPUnit\Framework\TestCase;

class DirectoryBuilderTest extends TestCase
{
    /**
     * @var DirectoryBuilder Directory builder object
     */
    protected $directoryBuilder;

    public function setUp()
    {
        $this->directoryBuilder = new DirectoryBuilder(__DIR__.'/../../../var/edi', 'edi/', 'pedidos/');
    }

    /**
     * @expectedException \ApiBundle\Exception\IndustryNotFoundException
     */
    public function testIndustryException()
    {
        $this->directoryBuilder
            ->setWholesaler('santacruz')
            ->getDirectoryAddress();
    }

    /**
     * @expectedException \ApiBundle\Exception\WholesalerNotFoundException
     */
    public function testWholesalerException()
    {
        $this->directoryBuilder
            ->setIndustry('gsk')
            ->getDirectoryAddress();
    }

    public function testDirectoryManipulation()
    {
        $directory = $this->directoryBuilder
            ->setIndustry('gsk')
            ->setWholesaler('santacruz')
            ->getDirectoryAddress();

        $this->assertContains(
            '/gsk/edi//santacruz/pedidos/',
            $directory
        );

        rmdir($directory);

        $directory = $this->directoryBuilder
            ->setIndustry('gsk')
            ->setWholesaler('santacruz')
            ->getDirectoryAddress();

        $this->assertTrue(file_exists($directory));
    }

    public function testGetData()
    {
        $this->directoryBuilder
            ->setIndustry('gsk')
            ->setWholesaler('santacruz');

        $this->assertEquals('gsk', $this->directoryBuilder->getIndustry());
        $this->assertEquals('santacruz', $this->directoryBuilder->getWholesaler());
    }
}
