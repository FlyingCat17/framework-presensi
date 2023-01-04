<?php

return [
    'app' => [
        'debug' => true,
        'safety' => false,
        'name' => 'Riyu',
        'url' => 'http://localhost/framework-presensi/',
        'timezone' => 'Asia/Jakarta',
        'locale' => 'id_ID.utf8',
    ],

    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'db_new_presensi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',

        // default options
        // 'options' => [
        //     PDO::ATTR_CASE => PDO::CASE_NATURAL,
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //     PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        //     PDO::ATTR_STRINGIFY_FETCHES => false,
        //     PDO::ATTR_EMULATE_PREPARES => false,
        // ],
    ],

    "directory" => __DIR__,

    "view" => [
        "path" => __DIR__ . "/../resources/views/",
    ],

    "path" => __DIR__ . "/"
];