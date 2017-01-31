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

$conf = ['settings' => ['displayErrorDetails' => true, 'tmpl_dir' => '..\templates'],
          'view' => function($c){
            return new \Slim\Views\Twig($c['settings']['tmpl_dir'], ['debug'=>true, 'cache'=> $c['settings']['tmpl_dir']]);
          }];
$errorDetails = new \Slim\Container($conf);
$app = new \Slim\App($errorDetails);

// On affiche une collection des catégories
$app->get( "/categories[/]", function(Request $req, Response $resp, $args){
    return (new CategorieController($this))->listCategories($resp);
})->setName("categories");

// On affiche le détail d'une catégorie
$app->get("/categories/{id}[/]",function(Request $req, Response $resp, $args){
	return (new CategorieController($this))->detailCategory($resp, $args['id']);
})->setName("categories");

// On affiche une collection d'ingredients appartenant à une catégorie donnée
$app->get("/categories/{id}/ingredients[/]",function(Request $req, Response $resp, $args){
    return (new CategorieController($this))->ingredientsByCategorie($resp, $args['id']);
})->setName("categories");

// On affiche le détail d'une commande
$app->get(
  "/commandes/{id}[/]",
  function(Request $req, Response $resp, $args){
     return (new CommandeController($this))->detailCommande($req, $resp, $args['id']);
  }
)->setName("commandes")->add('response_JSON')->add('checkTOKEN');

// On supprime un sandwich pour une commande
$app->delete(
  "/commandes/sandwichs/{id}[/]",
  function(Request $req, Response $resp, $args){
     return (new SandwichController($this))->delete($req, $resp, $args['id']);
  }
)->setName("commandes");

$app->put("/commandes/{id_commande}/sandwichs/{id_sandwich}/ingredients[/]",
    function(Request $req, Response $resp, $args){
      return (new SandwichController($this))->modifyIngredients ($req, $resp, $args);
    }
);

$app->put("/commandes/{id_commande}/sandwichs/{id_sandwich}[/]",
    function(Request $req, Response $resp, $args){
      return (new SandwichController($this))->modifySandwich($req, $resp, $args);
    }
);


$app->get("/ingredients[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->listIngredients($req, $resp, $args);
})->setName('ingredients')->add('checkACCESS');


$app->post("/ingredients[/]",function(Request $req, Response $resp, $args){
  $parsedBody = $req->getParsedBody();
  return (new IngredientController($this))->addIngredient($req, $resp, $args, $parsedBody);
})->add('checkACCESS');

$app->get("/ingredients/{id}[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->getIngredient($req, $resp, $args['id']);
})->setName('ingredient');

$app->delete("/ingredients/{id}[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->deleteIngredient($req, $resp, $args['id']);
})->add('checkACCESS');

$app->put("/ingredients/{id}[/]",function(Request $req, Response $resp, $args){
  $parsedBody = $req->getParsedBody();
  return (new IngredientController($this))->updateIngredient($req, $resp, $args['id'], $parsedBody);
});

$app->get("/ingredients/{id}/categorie[/]",function(Request $req, Response $resp, $args){
  return (new IngredientController($this))->getCategorie($req, $resp, $args['id']);
})->setName('ingredientCategories');

$app->get("/commandes[/]", function(Request $req, Response $resp, $args){
  $etat = (isset($_GET['etat'])) ? $_GET['etat'] : null ;
  $date = (isset($_GET['sate'])) ? $_GET['date'] : null ;

  $offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0 ;
  $size = (isset($_GET['size'])) ? $_GET['size'] : 0 ;
  if($offset != 0 || $size != 0){
     return(new CommandeController($this))->paginationListCommande($req, $resp, $args);
  }
 return (new CommandeController($this))->filtrageCommandes($req, $resp, $etat, $date);
})->setName('commandes');

// On crée une commande
$app->post("/commandes[/]",function(Request $req, Response $resp, $args){
    return (new CommandeController($this))->add($req, $resp);
})->setName("commandes");

//On modifie la date de livraison de la commande
$app->put("/commandes/{id}[/]",function(Request $req, Response $resp, $args){
    //récuperer les nouvelles valeurs depuis le Body de la requete
    $parsedBody = $req->getParsedBody();
    return (new CommandeController($this))->updateCommande($req, $resp, $args, $parsedBody);
})->add('response_JSON')->add('checkTOKEN');

//On supprime une commande
$app->delete("/commandes/{id}[/]",function(Request $req, Response $resp, $args){
    return (new CommandeController($this))->deleteCommande($req, $resp, $args);
})->add('response_JSON')->add('checkTOKEN');

//On paye la commande
$app->post("/commandes/{id}/paiement[/]",function(Request $req, Response $resp, $args){
    return (new CommandeController($this))->payCommande($req, $resp, $args);
})->add('response_JSON')->add('checkTOKEN');

// On affiche les sandwichs d'une commande
$app->get(
  "/commandes/{id}/sandwichs[/]",
  function(Request $req, Response $resp, $args){
     return (new CommandeController($this))->sandwichsByCommande($resp, $args['id']);
  }
)->setName("commandes");

// On enregistre un sandwich pour une commande
$app->post(
  "/commandes/{id}/sandwichs[/]",
  function(Request $req, Response $resp, $args){
     return (new SandwichController($this))->add($req, $resp, $args['id']);
  }
)->setName("commandes");

//On obtient la facture pour une commande
$app->get("/commandes/{id}/facture[/]",function(Request $req, Response $resp, $args){
    return (new CommandeController($this))->factureCommande($req, $resp, $args);
})->add('response_JSON')->add('checkTOKEN');


$app->run();
