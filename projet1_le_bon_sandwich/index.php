<?php

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');

use src\controllers\CategorieController as CategorieController;
var_dump(CategorieController::listCategories());
