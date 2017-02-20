<?php

define("DIR", $_SERVER['SCRIPT_NAME']);

require("../vendor/autoload.php");
require("../src/utils/Authentification.php");
src\utils\AppInit::bootEloquent('../conf/conf.ini');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Extras\Middleware\HttpBasicAuth;
use src\controllers\CategorieController as CategorieController;
use src\controllers\CommandeController as CommandeController;
use src\controllers\SandwichController as SandwichController;
use src\controllers\IngredientController as IngredientController;
use src\controllers\DashBoardController as DashBoardController;

$conf = ['settings' => ['displayErrorDetails' => true, 'tmpl_dir' => '..\src\templates'],
          'view' => function($c){
            return new \Slim\Views\Twig($c['settings']['tmpl_dir'], ['debug'=>true, 'cache'=> $c['settings']['tmpl_dir']]);
          }];
$container = new \Slim\Container($conf);
$app = new \Slim\App($container);


$app->get("/commandes/{id}[/]",function(Request $req, Response $resp, $args){
     return (new CommandeController($this))->detailCommande($req, $resp, $args['id']);
  })->setName("commandes");


$app->get("/commandes[/]", function(Request $req, Response $resp, $args){
  if(isset($_GET['offset']) || isset($_GET['size']))
  {
     return(new CommandeController($this))->paginationListCommande($req, $resp, $args);
  }
 return (new CommandeController($this))->filtrageCommandes($req, $resp, $args);
})->setName('commandes');


$app->put("/commandes/{id}[/]",function(Request $req, Response $resp, $args){
     return (new CommandeController($this))->changerEtatCommande($req, $resp, $args);
  });


$app->get('/ingredients[/]', function(Request $req, Response $resp, $args){
    return (new DashBoardController($this))->ListIngredients($req, $resp, $args);
});

$app->get('/taille/{id}', function(Request $req, Response $resp, $args, $requestbody){
    return (new DashBoardController($this))->modifierTaille($req, $resp, $args, $requestbody);
});

$app->post('/taille/{id}', function(Request $req, Response $resp, $args, $requestbody){
    return (new DashBoardController($this))->modifierTaille($req, $resp, $args, $requestbody);
});



$app->run();
