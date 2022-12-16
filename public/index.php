<?php

/*--------------------------|
|                           |
|   Set Require all Files   |
|                           |
|--------------------------*/

require_once __DIR__."/../vendor/autoload.php";

use Riyu\App\Config;
Config::load(__DIR__.'/../config.php');

require_once __DIR__."/../app/Config/config.php";
require_once __DIR__."/../src/Helpers/Events/Helper.php";
require_once __DIR__.'/../routes/web.php';
require_once __DIR__.'/../routes/api.php';
require_once __DIR__."/../app/Config/Controller.php";
require_once __DIR__."/../app/Config/View.php";
require_once __DIR__."/../app/Config/Session.php";
require_once __DIR__."/app/config.php";
