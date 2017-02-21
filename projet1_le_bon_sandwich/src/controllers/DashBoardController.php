<?php

namespace src\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\Ingredient;
use src\models\Categorie;


class DashBoardController extends AbstractController
{
    public function ListIngredients(Request $req, Response $resp, $args)
    {
        $categories = Categorie::with('getIngredients')->get();
        return $this->request->view->render($resp, 'commandes.html', ["categories"=>$categories]);
    }

    public function authentificationForm($req, $resp, $args){
        $slimGuard = new \Slim\Csrf\Guard;
        $slimGuard->validateStorage();
        $key = $slimGuard->generateToken();
        $nameKey = $key['csrf_name'];
        $valueKey = $key['csrf_value'];
        $_SESSION[$nameKey] = $valueKey;
        $data = [
                    "token" => [
                                "nameKey" => $nameKey,
                                "valueKey" => $valueKey
                               ]
                ];
        return $this->request->view->render($resp, "authentification.html", $data);
    }

    public function authentificationVerify($req, $resp, $args){
        var_dump($req->getParams());die;
    }
}
