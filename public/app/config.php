<?php

//-------------------------------//
//                               //
//       Start Application       //
//                               //
//-------------------------------//

$run = new \Riyu\Helpers\Errors\Handler\Run;
$run->run();
new \App\Config\Session;
new \Riyu\Http\Request;
new \Riyu\Validation\Validation;
new \Riyu\Router\Route;
new \Riyu\Router\Matching;
?>