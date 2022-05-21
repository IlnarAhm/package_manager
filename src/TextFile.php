<?php

namespace Ilnarahm\Packagemanager;


class TextFile
{
    public static function create($path, $textContent)
    {
        $textFile = fopen($path . "/info.txt", "w");

        fwrite($textFile, $textContent);

        fclose($textFile);
    }
}