<?php


namespace Ilnarahm\Packagemanager;


class File
{
    /**
     * @var String
     */
    private $path;

    /**
     * File constructor.
     * @param $filePath
     */
    public function __construct(String $filePath) {
        $this->path = $filePath;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): string
    {
        return basename($this->path);
    }

    public function getSize(): int
    {
        return filesize($this->path);
    }
}