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
        return $this->request->view->render($resp, 'ingredients.html', ["categories"=>$categories, "base_url"=>$args['baseUrl']]);
    }

    public function AddIngredient(Request $req, Response $resp, $args){
        if($req->isGet()){
            $categories = Categorie::all();
            return $this->request->view->render($resp, 'Form_ingredient_add.html', ["categories"=>$categories, "base_url"=>$args['baseUrl']]);
        }
        if($req->isPost()){
            $ingredient = $args['parsedBody'];
            $newIngredient = new Ingredient();
            $newIngredient->nom = filter_var($ingredient["nom"], FILTER_SANITIZE_STRING);
            $newIngredient->cat_id = filter_var($ingredient["cat_id"], FILTER_SANITIZE_STRING);
            $newIngredient->description = filter_var($ingredient["description"], FILTER_SANITIZE_STRING);
            $newIngredient->fournisseur = filter_var($ingredient["fournisseur"], FILTER_SANITIZE_STRING);
            $newIngredient->img = filter_var($ingredient["img"], FILTER_SANITIZE_STRING);

            try{
                $newIngredient->save();
                $categories = Categorie::with('getIngredients')->get();
                return $this->request->view->render($resp, 'ingredients.html', ["categories"=>$categories]);
            }
            catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                echo "Page d'erreur en cours d'elaboration";
            }
        }
    }

    public function DeleteIngredient(Request $req, Response $resp, $args){
        try{
            Ingredient::findOrFail($args['id'])->delete();
            $categories = Categorie::with('getIngredients')->get();
            return $this->request->view->render($resp, 'ingredient_deleted.html', ['id'=>$args['id']]);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            echo "Page d'erreur en cours d'elaboration";
        }
    }
}
