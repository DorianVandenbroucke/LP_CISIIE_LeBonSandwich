<?php

namespace src\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\Ingredient;
use src\models\Categorie;


class DashBoardController extends AbstractController
{
    public function ListIngredients(Request $req, Response $resp, $args){
        $categories = Categorie::with('getIngredients')->get();
        return $this->request->view->render($resp, 'ingredients.html', ["categories"=>$categories]);
    }

    public function AddIngredient(Request $req, Response $resp, $args, $parsedBody){
        if($req->isGet()){
            $categories = Categorie::all();
            return $this->request->view->render($resp, 'Form_ingredient_add.html', ["categories"=>$categories]);
        }
        if($req->isPost()){
            print_r("POST");
        }
    }
}
