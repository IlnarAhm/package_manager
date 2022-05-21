<?php


namespace Ilnarahm\Packagemanager;


class File
{
    private $path;

    public function __construct($filePath) {
        $this->path = $filePath;
    }

    public function getPath() {
        return $this->path;
    }

    public function getName() {
        return basename($this->path);
    }

    public function getSize() {
        return filesize($this->path);
    }
}