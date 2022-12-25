<?php

return [
    'app' => [
        'debug' => true,
        'name' => 'Riyu',
        'url' => 'http://localhost/framework-presensi/',
        'timezone' => 'Asia/Jakarta',
        'locale' => 'id_ID.utf8',
    ],

    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'db_new_presensi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],

    "directory" => __DIR__,

    "view" => [
        "path" => __DIR__ . "/../resources/views/",
    ],
];