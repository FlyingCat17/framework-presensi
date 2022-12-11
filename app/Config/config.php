<?php

use Riyu\Helpers\Errors\ViewError;
use Riyu\Helpers\Storage\GlobalStorage;

define('base_url', 'http://localhost/framework/');

require_once __DIR__."/../Database/connection.php";
GlobalStorage::set('path', __DIR__.'/../../');
GlobalStorage::set('view_path', __DIR__.'/../../resources/views/');
new ViewError;
?>