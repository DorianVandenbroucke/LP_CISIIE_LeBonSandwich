<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\controllers\CategorieController as CategorieController;
use src\controllers\CommandeController as CommandeController;
use src\controllers\SandwichController as SandwichController;
use src\controllers\IngredientController as IngredientController;
use src\controllers\DashBoardController as DashBoardController;

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


$app->get('/ingredients[/]', function(Request $req, Response $resp, $args){
    $args["baseUrl"] = $req->getUri()->getBaseUrl();
    return (new DashBoardController($this))->ListIngredients($req, $resp, $args);
})->setName('ingredients');

$app->get('/ingredients/add[/]', function(Request $req, Response $resp, $args){
    $args["baseUrl"] = $req->getUri()->getBaseUrl();
    return (new DashBoardController($this))->AddIngredient($req, $resp, $args);
})->setName('addIngredient');

$app->post('/ingredients[/]', function(Request $req, Response $resp, $args){
    $args["parsedBody"] = $req->getParsedBody();
    $args["baseUrl"] = $req->getUri()->getBaseUrl();
    return (new DashBoardController($this))->AddIngredient($req, $resp, $args);
});

$app->get('/ingredients/delete/{id}[/]', function(Request $req, Response $resp, $args){
    $args["baseUrl"] = $req->getUri()->getBaseUrl();
    return (new DashBoardController($this))->DeleteIngredient($req, $resp, $args);
})->setName('deleteIngredient');

$app->get("/authentification[/]", function(Request $req, Response $resp, $args){
    return (new DashBoardController($this))->authentificationForm($req, $resp, $args);
});
