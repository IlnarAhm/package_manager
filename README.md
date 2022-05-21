# PackageManager

Класс PackageManager, разбивает массив файлов на пакеты, ограниченные определенным размером в байтах. 
Совокупный размер каждого пакета не будет превышать (средний размер файлов) * 3

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=for-the-badge)](https://php.net/)

## Использование

Для начала работы, необходимо создать объект класса PackageManager:

```php
$packageManager = new PackageManager();
```

Чтобы запустить процесс создания пакетов, небходимо вызвать метод createPackages(), передать в него массив с файлами 
и путь, где нужно создать пакеты:

```php
$packageManager->createPackages(['/file.doc', '/file2.doc'], '/packages');
```

## Пример

Пример  использования класса PackageManager:

```php
<?php

use Ilnarahm\Packagemanager\PackageManager;

$files = [
    __DIR__ . '/files/file1.png',
    __DIR__ . '/files/file2.png',
    __DIR__ . '/files/file3.png',
    __DIR__ . '/files/file4.png',
    __DIR__ . '/files/file5.png'
];

$packagesPath = __DIR__ . '/packages';

$packageManager = new PackageManager();

try {
    $packageManager->createPackages($files, $packagesPath);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```

В итоге получим такую структуру файлов:

```
files/
    file1.png
    file2.png
    file3.png
    file4.png
    file5.png
packages/
    package_1/
        file1.png
        file2.png
        info.txt
        package_1.zip
    package_2/
        file3.png
        file4.png
        file5.png
        info.txt
        package_1.zip
```

Содержимое текстового файла info.txt:

```text
Размер пакета: 248817 байт
Размер архива: 211142 байт
Сэкономили при сжатии: 37675 байт
```
