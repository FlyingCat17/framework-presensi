<?php

namespace App\Database;

use Riyu\App\Config;
use Riyu\Database\Connection\Connection;

$connection = new Connection;
$connection->config([
    'driver' => Config::get('database')['driver'],
    'host' => Config::get('database')['host'],
    'username' => Config::get('database')['username'],
    'password' => Config::get('database')['password'],
    'database' => Config::get('database')['database'],
    'charset' => Config::get('database')['charset'],
    'port' => Config::get('database')['port'],
]);
