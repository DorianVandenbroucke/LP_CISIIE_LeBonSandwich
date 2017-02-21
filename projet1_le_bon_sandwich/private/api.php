<?php

define("DIR", $_SERVER['SCRIPT_NAME']);

require("../vendor/autoload.php");
require("../src/utils/Authentification.php");
src\utils\AppInit::bootEloquent('../conf/conf.ini');

$conf = ['settings' => ['displayErrorDetails' => true, 'tmpl_dir' => '..\src\templates'],
          'view' => function($c){
            $view = new \Slim\Views\Twig($c['settings']['tmpl_dir'], ['debug'=>true, 'cache'=> $c['settings']['tmpl_dir']]);
            $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
            $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
            return $view;
          }];

session_start();

$container = new \Slim\Container($conf);
$app = new \Slim\App($container);

// $app->get("/commandes/{id}[/]",function(Request $req, Response $resp, $args){
//      return (new CommandeController($this))->detailCommande($req, $resp, $args['id']);
//   })->setName("commandes");
//
//
// $app->get("/commandes[/]", function(Request $req, Response $resp, $args){
//   if(isset($_GET['offset']) || isset($_GET['size']))
//   {
//      return(new CommandeController($this))->paginationListCommande($req, $resp, $args);
//   }
//  return (new CommandeController($this))->filtrageCommandes($req, $resp, $args);
// })->setName('commandes');
//
//
// $app->get('/ingredients[/]', function(Request $req, Response $resp, $args){
//     return (new DashBoardController($this))->ListIngredients($req, $resp, $args);
// });

// $app->get("/authentification[/]", function(Request $req, Response $resp, $args){
//     return (new DashBoardController($this))->authentificationForm($req, $resp, $args);
// });
//
// $app->post("/authentification[/]", function(Request $req, Response $resp, $args){
//     return (new DashBoardController($this))->authentificationVerify($req, $resp, $args);
// });

require('../src/routes/private_route.php');

$app->run();
