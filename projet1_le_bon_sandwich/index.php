<?php

define("DIR", $_SERVER['SCRIPT_NAME']);

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');

use src\controllers\CategorieController as CategorieController;
$c = new CategorieController($this);
$c::detailCategory(2);
