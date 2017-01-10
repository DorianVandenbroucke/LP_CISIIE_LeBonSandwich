<?php

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');

use src\controllers\CommandeController as CommandeController;
var_dump(CommandeController::add(2));
