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
     * @var string
     */
    private $packagesPath;

    /**
     * @var int
     */
    private $allowedPackageSize;

    /**
     * @param array $files
     * @param string $packagesPath
     * @throws Exception
     */
    public function createPackages(Array $files, String $packagesPath): void
    {
        if(!file_exists($packagesPath)) {
            if(!mkdir($packagesPath, 0755, true)) {
                throw new Exception("Произошла ошибка при создании пути для пакетов");
            }
        }
        $this->packagesPath = $packagesPath;

        foreach ($files as $file) {
            if (file_exists($file)) {
                $this->files[] = new File($file);
            } else {
                throw new Exception("Файла '{$file}' не существует");
            }
        }

        $this->initPackages();
        $this->createPackageFolders();
    }

    private function initPackages(): void
    {
        $this->allowedPackageSize = $this->getAllowedPackageSize();
        // Разбиваем файлы на пакеты
        do {
            $package = new Package("package_" . (count($this->packages) + 1), $this->packagesPath);
            $this->packages[] = $package;

            $package->addFile(array_shift($this->files));

            $sizeCounter = 0;
            foreach ($this->files as $key => $file) {
                $sizeCounter += $file->getSize();

                if ($sizeCounter < ($this->allowedPackageSize)) {
                    $package->addFile($file);
                    unset($this->files[$key]);
                } else {
                    break;
                }
            }

        } while (count($this->files));
    }

    private function createPackageFolders(): void
    {
        foreach ($this->packages as $package) {
            $package->createPackageFolder();
        }
    }

    private function getAllowedPackageSize(): float
    {
        $averageFilesSize = 0;
        foreach ($this->files as $file) {
            $averageFilesSize += $file->getSize();
        }

        return ($averageFilesSize / count($this->files)) * 3;
    }

}