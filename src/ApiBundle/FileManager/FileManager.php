<?php

namespace ApiBundle\FileManager;

use ApiBundle\Model\Order;

class FileManager
{
    /**
     * @var DirectoryBuilder Directory builder object
     */
    protected $directoryBuilder;

    /**
     * FileManager constructor.
     *
     * @param DirectoryBuilder $directoryBuilder
     */
    public function __construct(DirectoryBuilder $directoryBuilder)
    {
        $this->directoryBuilder = $directoryBuilder;
    }

    /**
     * Create the order file.
     *
     * @param int    $id         Order identifier
     * @param string $industry   Industry identifier
     * @param string $wholesaler Wholesaler identifier
     * @param Order  $order      Order object data
     *
     * @return OrderFile Order file
     */
    public function buildOrderFile(int $id, string $industry, string $wholesaler, Order $order)
    {
        $directory = $this->directoryBuilder
            ->setIndustry($industry)
            ->setWholesaler($wholesaler)
            ->getDirectoryAddress();
        $orderFile = new OrderFile($id, $directory, $order);
        $orderFile->save();

        return $orderFile;
    }
}
