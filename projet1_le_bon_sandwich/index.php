<?php

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');

use src\controllers\CommandeController as CommandeController;
var_dump(CommandeController::modifySandwich(5,'petit', 'pain viennois','tomate'));


