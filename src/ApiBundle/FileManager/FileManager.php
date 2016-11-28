<?php

namespace ApiBundle\FileManager;

use ApiBundle\Model\Order;

class FileManager
{
    /**
     * @var string Directory base URI
     */
    protected $baseUri;

    /**
     * @var string Prefix
     */
    protected $prefix;

    /**
     * @var string File directory
     */
    protected $directory;

    public function __construct($baseUri, $prefix, $directory)
    {
        $this->baseUri = !empty($baseUri)
            ? $baseUri
            : __DIR__;
        $this->prefix = $prefix;
        $this->directory = $directory;
    }

    /**
     * Build the order directory address.
     *
     * @param string $industry   Industry identifier
     * @param string $wholesaler Wholesaler identifier
     *
     * @return string Order directory address
     */
    public function buildDirectory(string $industry, string $wholesaler)
    {
        return implode(DIRECTORY_SEPARATOR, [
            $this->baseUri,
            $industry,
            $this->prefix,
            $wholesaler,
            $this->directory,
        ]);
    }

    /**
     * Create the order file.
     *
     * @param int    $id         Order identifier
     * @param string $industry   Industry identifier
     * @param string $wholesaler Wholesaler identifier
     * @param Order  $order      Order object data
     *
     * @return \SplFileObject Order file
     */
    public function createOrderFile(int $id, string $industry, string $wholesaler, Order $order)
    {
        $orderFile = new OrderFile($id, $order);
        $directory = $this->buildDirectory($industry, $wholesaler);
        if (!file_exists($directory)) {
            mkdir($directory, '0777', true);
        }
        $filename = $orderFile->buildFilename();
        $file = new \SplFileObject($directory.DIRECTORY_SEPARATOR.$filename, 'w+');
        $orderFile->save($file);

        return $file;
    }
}
