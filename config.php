<?php

return [
    'app' => [
        'debug' => true,
        'name' => 'Riyu',
        'url' => 'http://localhost/framework/',
        'timezone' => 'Asia/Jakarta',
        'locale' => 'id',
    ],

    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'db_new_presensi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',

        // if you want to use PDO options you can uncomment this
        // and set your options
        //
        // 'options' => [
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        //     PDO::ATTR_EMULATE_PREPARES => false,
        // ],
    ],

    "directory" => __DIR__,

    "view" => [
        "path" => __DIR__ . "/../resources/views/",
    ],
];