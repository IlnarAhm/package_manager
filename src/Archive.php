<?php


namespace Ilnarahm\Packagemanager;


use ZipArchive;

class Archive
{
    /**
     * @var File[]
     */
    private $files;

    /**
     * @var string
     */
    private $archivePath;

    /**
     * Размер архива в байтах
     *
     * @var int
     */
    private $archiveSize;

    /**
     * Archive constructor.
     * @param String $path
     * @param array $files
     */
    public function __construct(String $path, Array $files)
    {
        $this->archivePath = $path;
        $this->files = $files;
    }

    public function createZipArchive(): void
    {
        $zip = new ZipArchive();
        $zip->open($this->archivePath . '.zip', ZIPARCHIVE::CREATE);

        foreach ($this->files as $file) {
            $zip->addFile($file->getPath());
        }

        $zip->close();

        $this->archiveSize = filesize($this->archivePath . '.zip');
    }

    /**
     * @return int
     */
    public function getArchiveSize(): int
    {
        return $this->archiveSize;
    }
}