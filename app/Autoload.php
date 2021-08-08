<?php

require_once dirname(__FILE__). '/config/config.php';

function my_autoload($class_name)
{
    // Массив папок, в которых могут находиться необходимые классы
    $array_paths = array(
        '/core/',
        '/http/controllers/',
        '/models/',
    );

    // Проходим по массиву папок
    foreach ($array_paths as $path) {

        // Формируем имя и путь к файлу с классом
        $path = APP_ROOT. $path . $class_name . '.php';

        // Если такой файл существует, подключаем его
        if (is_file($path)) {
            include_once $path;
        }
    }
}
spl_autoload_register('my_autoload');
