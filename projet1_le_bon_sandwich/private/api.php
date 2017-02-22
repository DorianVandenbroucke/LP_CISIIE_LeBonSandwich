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

require('../src/routes/private_route.php');



$app->get('/taille/{id}', function(Request $req, Response $resp, $args){
    return (new DashBoardController($this))->modifierTaille($req, $resp, $args);
});

$app->put('/taille/{id}', function(Request $req, Response $resp, $args){
    return (new DashBoardController($this))->modifierTaille($req, $resp, $args);
});


$app->run();
