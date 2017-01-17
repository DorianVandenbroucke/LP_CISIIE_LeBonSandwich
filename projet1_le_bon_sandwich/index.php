<?php

define("DIR", $_SERVER['SCRIPT_NAME']);

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');


use src\controllers\CategorieController as CategorieController;
echo "<pre>";
CategorieController::ingredientsByCategorie(NULL, 2);
