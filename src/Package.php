<?php

namespace Ilnarahm\Packagemanager;

use Exception;
use ZipArchive;


class Package
{
    /**
     * @var string
     */
    private $packageName;

    /**
     * @var string
     */
    private $packagePath;

    /**
     * @var int
     */
    private $packageSize;

    /**
     * @var File[]
     */
    private $files;

    /**
     * @var Archive
     */
    private $archive;

    /**
     * Package constructor.
     * @param String $name
     * @param String $path
     */
    public function __construct(String $name, String $path)
    {
        $this->packageName = $name;
        $this->packagePath = $path . '/' . $name;
    }

    public function addFile(File $file): void
    {
        $this->files[] = $file;
    }

    public function createPackageFolder(): void
    {
        if(!file_exists($this->packagePath)) {
            mkdir($this->packagePath);
        }

        foreach ($this->files as $file) {
            $this->packageSize += $file->getSize();
            copy($file->getPath(), $this->packagePath . '/' . $file->getName());
        }

        $this->archive = new Archive($this->packagePath . '/' . $this->packageName, $this->files);
        $this->archive->createZipArchive();

        TextFile::create($this->packagePath, $this->getPackageInfo());
    }

    private function getPackageInfo(): string
    {
        $text = "Размер пакета: " . $this->packageSize . " байт\n";
        $text .= "Размер архива: " . $this->archive->getArchiveSize() . " байт\n";
        $text .= "Сэкономили при сжатии: " . $this->packageSize - $this->archive->getArchiveSize() . " байт\n";

        return $text;
    }

}