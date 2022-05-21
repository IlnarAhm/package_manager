<?php


namespace Ilnarahm\Packagemanager;


class Package
{
    /**
     * @var string
     */
    private $packageName;

    /**
     * @var File[]
     */
    private $files;

    public function __construct(String $name)
    {
        $this->packageName = $name;
    }

    public function addFile(File $file) {
        $this->files[] = $file;
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }



    // TODO: УДАЛИТЬ ЭТОТ МЕТОД
    public function getFileNames()
    {
        $size = 0;
        echo '<b>Файлы:</b><ul>';
        foreach ($this->files as $key => $file) {
            $size += $file->getSize();
            echo '<li>' . basename($file->getPath()) . ' ' . $file->getSize() . ' байт </li>';
        }

        echo '</ul><b>Вес пакета:</b>' . $size . ' байт';
    }
}