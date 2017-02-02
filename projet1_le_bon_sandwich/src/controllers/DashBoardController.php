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
}
