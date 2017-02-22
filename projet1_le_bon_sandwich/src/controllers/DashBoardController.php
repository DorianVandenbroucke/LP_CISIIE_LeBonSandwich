<?php

namespace src\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\Ingredient;
use src\models\Categorie;
use src\models\Taille as Taille;


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
                return $this->request->view->render($resp, 'ingredients.html', ["categories"=>$categories, "base_url"=>$args['baseUrl']]);
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
            return $this->request->view->render($resp, 'ingredient_deleted.html', ['id'=>$args['id'], "base_url"=>$args['baseUrl']]);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            echo "Page d'erreur en cours d'elaboration";
        }
    }

    public function authentificationForm($req, $resp, $args){
        return $this->request->view->render($resp, "authentification.html", ["url" => DIR."/authentification/verify/"]);
    }

    public function modifierTaille(Request $req, Response $resp, $args){
        
        try{

                    $taille = Taille::findOrFail($args["id"]);

                    if(isset($req->getParams()['description'])){
                        $taille->description = filter_var($req->getParams()['description'], FILTER_SANITIZE_STRING);
                    }

                    if(isset($req->getParams()['prix'])){
                        $taille->prix = filter_var($req->getParams()['prix'], FILTER_SANITIZE_STRING) ;
                    }


            }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            echo "Page d'erreur en cours d'elaboration";
        }
       
         /*foreach ($requestbody as $key => $value) {
                        if(in_array($key,$taille->getFillable()))
                        {
                            $taille->$key = filter_var($value, FILTER_SANITIZE_STRING);
                        }
                        else
                        {
                            $data[] =  ["Warning" => "Il manque une valeur à l'attribut $key"];
                        }
        }
        var_dump($requestbody);*/
        $taille->save();
        

        return $this->request->view->render($resp, 'modifierTaille.html', ["taille"=>$taille]);

      
    }
}
