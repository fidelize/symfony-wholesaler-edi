<?php

namespace ApiBundle\FileManager;

abstract class AbstractFile
{
    /**
     * @var \SplFileObject File object
     */
    protected $file;

    public function __construct(string $directory)
    {
        $this->setFile(new \SplFileObject($directory.DIRECTORY_SEPARATOR.$this->createFilename(), 'w'));
    }

    /**
     * Return file object.
     *
     * @return \SplFileObject File object
     */
    public function getFile(): \SplFileObject
    {
        return $this->file;
    }

    /**
     * Define file object.
     *
     * @param \SplFileObject $file File object
     */
    public function setFile(\SplFileObject $file)
    {
        $this->file = $file;
    }

    /**
     * Write order filename.
     *
     * @return string Order filename
     */
    abstract protected function createFilename(): string;

    /**
     * Write order content in order file.
     */
    abstract public function save();
}
