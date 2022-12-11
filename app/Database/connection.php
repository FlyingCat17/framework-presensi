<?php

namespace App\Database;

use Riyu\Database\Connection\Connection;

$connection = new Connection;
$connection->config([
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'db_new_presensi',
    'charset' => 'utf8',
    'port' => '3306'
]);
