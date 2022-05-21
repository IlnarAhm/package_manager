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

    public function getExt() {
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }

    public function getSize() {
        return filesize($this->path);
    }

    public function copy($copyPath) {}
    public function delete() {}
    public function rename($newName) {}
    public function replace($newPath) {}
}