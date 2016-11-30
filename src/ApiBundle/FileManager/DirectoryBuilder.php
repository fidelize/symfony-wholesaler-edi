<?php

namespace ApiBundle\FileManager;

use ApiBundle\Exception\IndustryNotFoundException;
use ApiBundle\Exception\WholesalerNotFoundException;

class DirectoryBuilder
{
    /**
     * @var string Base directory address
     */
    protected $baseUri;

    /**
     * @var string EDI directory
     */
    protected $ediDir;

    /**
     * @var string File directory
     */
    protected $fileDir;

    /**
     * @var string Industry identifier
     */
    protected $industry;

    /**
     * @var string Wholesaler identifier
     */
    protected $wholesaler;

    /**
     * DirectoryBuilder constructor.
     *
     * @param string $baseUri Base directory address
     * @param string $ediDir  EDI directory
     * @param string $fileDir
     */
    public function __construct($baseUri, $ediDir, $fileDir)
    {
        $this->baseUri = $baseUri;
        $this->ediDir = $ediDir;
        $this->fileDir = $fileDir;
    }

    /**
     * Return industry identifier.
     *
     * @return string Industry identifier
     */
    public function getIndustry(): string
    {
        return $this->industry;
    }

    /**
     * Define industry identifier.
     *
     * @param string $industry Industry identifier
     *
     * @return DirectoryBuilder
     */
    public function setIndustry(string $industry): DirectoryBuilder
    {
        $this->industry = $industry;

        return $this;
    }

    /**
     * Return wholesaler identifier.
     *
     * @return string Wholesaler identifier
     */
    public function getWholesaler(): string
    {
        return $this->wholesaler;
    }

    /**
     * Define wholesaler identifier.
     *
     * @param string $wholesaler Wholesaler identifier
     *
     * @return DirectoryBuilder
     */
    public function setWholesaler(string $wholesaler): DirectoryBuilder
    {
        $this->wholesaler = $wholesaler;

        return $this;
    }

    /**
     * Create a directory if not exists.
     *
     * @param string $directory Directory address
     *
     * @return DirectoryBuilder
     */
    protected function createDirectory(string $directory): DirectoryBuilder
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        return $this;
    }

    /**
     * Return a file directory address.
     *
     * @return string Directory address
     *
     * @throws IndustryNotFoundException   When industry identifier is not found
     * @throws WholesalerNotFoundException When wholesaler identifier is not found
     */
    public function getDirectoryAddress()
    {
        if ($this->industry === null) {
            throw new IndustryNotFoundException('Industry not found');
        }
        if ($this->wholesaler === null) {
            throw new WholesalerNotFoundException('Wholesaler not found');
        }

        $directory = implode(DIRECTORY_SEPARATOR, [
            $this->baseUri,
            $this->industry,
            $this->ediDir,
            $this->wholesaler,
            $this->fileDir,
        ]);
        $this->createDirectory($directory);

        return $directory;
    }
}
