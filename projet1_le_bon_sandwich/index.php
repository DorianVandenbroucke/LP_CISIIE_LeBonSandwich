<?php

define("DIR", $_SERVER['SCRIPT_NAME']);

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');


use src\controllers\CategorieController as CategorieController;
<<<<<<< HEAD
//$c = new CategorieController($this);
//$c::detailCategory(2);

use src\controllers\CommandeController as CommandeController;
use src\controllers\SandwichController as SandwichController;



//var_dump(CommandeController::updateCommande(1, "2017-02-02"));

var_dump(SandwichController::modifyIngredients(1));
=======
echo "<pre>";
CategorieController::ingredientsByCategorie(NULL, 2);
>>>>>>> e846f17195c65bec34976bb1936fbd33e34a16e6
