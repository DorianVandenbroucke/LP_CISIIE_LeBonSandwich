<?php

require("../vendor/autoload.php");
src\utils\AppInit::bootEloquent('../conf/conf.ini');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use src\controllers\CategorieController as CategorieController;
use src\controllers\CommandeController as CommandeController;
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

$app->post(
  "/commandes/add[/]",function(Request $req, Response $resp, $args){
    try{
      $chaine = CommandeController::add($args['montant'], $args['date_de_livraison'], $args['etat']);
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["Erreur", "Une erreur est survenue lors de l'ajout de la commande."];
      $resp = $resp->withStatus(405)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
    return $resp;
  }
);

$app->get(
  "/commandes/{id}[/]",
  function(Request $req, Response $resp, $args){
    try{
      $id = $args['id'];
      $chaine = CommandeController::detailCommande($id);
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["Erreur", "Ressource de la commande $id introuvable."];
      $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
    return $resp;
  }
);

$app->get(
  "/commandes/{id}/sandwichs[/]",
  function(Request $req, Response $resp, $args){
    try{
      $id = $args['id'];
      $chaine = CommandeController::sandwichsByCommande($id);
      $resp = $resp->withStatus(200)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
      $chaine = ["Erreur", "Ressource de la commande $id introuvable."];
      $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json, charset=utf-8');
      $resp->getBody()->write(json_encode($chaine));
    }
    return $resp;
  }
);


$app->put(
  "/commandes/{id_commande}/sandwichs/{id_sandwich}[/]",
    function(Request $req, Response $resp, $args){
      try{
        $chaine = CommandControler::modifySandwich($arg['id'], $args['taille'], $args['pain'], $args['ingredient']);
        $resp = $resp->status(200)->withHeader('Content-type', 'application/json, charset=utf-8');
        $resp->getBody()->write(json_encode($chaine));
      }catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
        $chaine = ["Erreur", "Une erreur est survenue lors de la modification du sandwich."];
        $resp = $resp->withStatus(405)->withHeader('Content-type', 'application/json, charset=utf-8');
        $resp->getBody()->write(json_encode($chaine));
      }
      return $resp;
    }

);


$app->get("/ingredients[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->listIngredients();
})->setName('ingredients');


$app->post("/ingredients[/]",function(Request $req, Response $resp, $args){
  $parsedBody = $req->getParsedBody();
  return (new IngredientController($this))->addIngredient($parsedBody);
});

$app->get("/ingredients/{id}[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->getIngredient($args['id']);
})->setName('ingredient');

$app->delete("/ingredients/{id}[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->deleteIngredient($args['id']);
});

$app->put("/ingredients/{id}[/]",function(Request $req, Response $resp, $args){
  $parsedBody = $req->getParsedBody();
  return (new IngredientController($this))->updateIngredient($args['id'],$parsedBody);
});

$app->get("/ingredients/{id}/categorie[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->getCategorie($args['id']);
})->setName('ingredientCategories');

$app->run();
