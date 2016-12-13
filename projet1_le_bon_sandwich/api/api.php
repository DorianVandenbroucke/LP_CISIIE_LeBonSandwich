<?php

require("../vendor/autoload.php");
src\utils\AppInit::bootEloquent('../conf/conf.ini');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use src\controllers\CategorieController as CategorieController;
use src\controllers\IngredientController as IngredientController;

$app = new \Slim\App;

// On affiche une collection des catégories
$app->get(
  "/categories[/]",
  function(Request $req, Response $resp, $args){
    $chaine = CategorieController::listCategories();
    $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
    $resp->getBody()->write(json_encode($chaine));
    return $resp;
  }
);

// On affiche le détail d'une catégorie
$app->get(
  "/categories/{id}[/]",
  function(Request $req, Response $resp, $args){
    try{
      $id = $args['id'];
      $chaine = CategorieController::detailCategory($id);
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["Erreur", "Categorie d'ingrédients $id introuvable."];
      $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
    return $resp;
  }
);

// On affiche une collection d'ingredients appartenant à une catégorie donnée
$app->get(
  "/categories/{id}/ingredients[/]",
  function(Request $req, Response $resp, $args){
    try{
      $id = $args['id'];
      $chaine = CategorieController::ingredientsByCategorie($id);
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["Erreur", "Categorie d'ingrédients $id introuvable."];
      $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
    return $resp;
  }
);

$app->get("/ingredients[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->listIngredients();
});

$app->get("/ingredients/{id}",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->findIngredient($args['id']);
});

$app->get("/ingredients/{id}/categorie",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->getCategory($args['id']);
});

$app->run();
