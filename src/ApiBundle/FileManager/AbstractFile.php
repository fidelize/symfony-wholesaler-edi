<?php

namespace ApiBundle\FileManager;

abstract class AbstractFile
{
    /**
     * @var string File path
     */
    protected $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Return file path.
     *
     * @return string File path
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * Write order filename.
     *
     * @return string Order filename
     */
    abstract protected function createFilename(): string;

    /**
     * Create a file object.
     *
     * @return \SplFileObject File object
     */
    protected function createFileObject()
    {
        return new \SplFileObject($this->filePath.DIRECTORY_SEPARATOR.$this->createFilename(), 'w');
    }

    /**
     * Write order content in order file.
     *
     * @return \SplFileObject File object
     */
    abstract public function save();
}
