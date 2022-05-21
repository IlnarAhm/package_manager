<?php

namespace Ilnarahm\Packagemanager;

use Exception;

class PackageManager
{

    /**
     * @var File[]
     */
    private $files = [];

    /**
     * @var Package[]
     */
    private $packages = [];

    /**
     * @var int
     */
    private $allowedPackageSize;

    /**
     * @param array $files
     * @throws Exception
     */
    public function createPackages(Array $files): void
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                $this->files[] = new File($file);
            } else {
                throw new Exception("Файла '{$file}' не существует");
            }
        }

        $this->init();
    }

    private function init(): void
    {
        $this->allowedPackageSize = $this->getAllowedPackageSize();

        // Разбиваем файлы на пакеты
        do {
            $package = new Package("package_" . (count($this->packages) + 1));
            $this->packages[] = $package;

            $sizeCounter = 0;
            foreach ($this->files as $key => $file) {
                $sizeCounter += $file->getSize();

                if ($sizeCounter < $this->allowedPackageSize) {
                    $package->addFile($file);
                    unset($this->files[$key]);
                } else {
                    break;
                }
            }

        } while (count($this->files));

        //
    }

    private function getAllowedPackageSize(): float
    {
        $averageFilesSize = 0;
        foreach ($this->files as $file) {
            $averageFilesSize += $file->getSize();
        }

        return ($averageFilesSize/count($this->files)) * 3;
    }

    // TODO: УДАЛИТЬ ЭТОТ МЕТОД
    public function logger()
    {
        echo '<h1>Допустимый вес пакета: ' . $this->allowedPackageSize . ' байт</h1><br/>';

        foreach ($this->packages as $package) {
            echo '<pre>';
            echo '<b>Пакет:</b> ' . $package->getPackageName() . '<br/>';
            $package->getFileNames();
            echo '</pre>';
            echo '<hr>';
        }
    }

}