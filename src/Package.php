<?php


namespace Ilnarahm\Packagemanager;


use Exception;

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
     * @var File[]
     */
    private $files;

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
            copy($file->getPath(), $this->packagePath . '/' . $file->getName());
        }

        $this->createArchive();
    }

    private function createArchive(): void
    {
        var_dump($this->packagePath);
        $zip = new ZipArchive(); //Создаём объект для работы с ZIP-архивами
        $zip->open($this->packagePath . "/" . $this->packageName . ".zip", ZIPARCHIVE::CREATE); //Открываем (создаём)
        // архив
        // archive.zip
        $zip->addFile("index.php"); //Добавляем в архив файл index.php
        $zip->addFile("styles/style.css"); //Добавляем в архив файл styles/style.css
        $zip->close(); //Завершаем работу с архивом
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }



    // TODO: УДАЛИТЬ ЭТОТ МЕТОД
    public function printPackageInfo()
    {
        $size = 0;
        echo '<b>Пакет:</b> ' . $this->getPackageName() . '<br/>';
        echo '<b>Файлы:</b><ul>';
        foreach ($this->files as $key => $file) {
            $size += $file->getSize();
            echo '<li>' . basename($file->getPath()) . ' ' . $file->getSize() . ' байт </li>';
        }

        echo '</ul><b>Вес пакета:</b>' . $size . ' байт';
    }
}