# PackageManager

Класс PackageManager, который умеет массив файлов разбивать на пакеты, ограниченные определенным размером в байтах. 
Совокупный размер каждого пакета не будет превышать (средний размер файлов) * 3

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=for-the-badge)](https://php.net/)

## Использование

Для начала работы, необходимо создать объект класса PackageManager:

```php
$packageManager = new PackageManager();
```

Чтобы запустить процесс создания пакетов, небходимо вызвать метод createPackages(), и передать в него массив с файлами:

```php
$packageManager->createPackages(['/file.doc', '/file2.doc'], '/packages');
```

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