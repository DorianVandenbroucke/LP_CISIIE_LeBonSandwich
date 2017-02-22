<?php

namespace src\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\Ingredient;
use src\models\Categorie;

use src\models\Taille as Taille;


use src\models\User;


class DashBoardController extends AbstractController
{

    public function ListIngredients(Request $req, Response $resp, $args){
        $ingredients = Ingredient::with('getCategory')->get();
        return $this->request->view->render($resp, 'ingredients.html', ["ingredients"=>$ingredients, "base_url"=>$args['baseUrl']]);
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
                $ingredients = Ingredient::with('getCategory')->get();
                return $this->request->view->render($resp, 'ingredients.html', ["ingredients"=>$ingredients, "base_url"=>$args['baseUrl']]);
            }
            catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                echo "Page d'erreur en cours d'elaboration";
            }
        }
    }

    public function DeleteIngredient(Request $req, Response $resp, $args){
        try{
            Ingredient::findOrFail($args['id'])->delete();
            $ingredients = Ingredient::with('getCategory')->get();
            return $this->request->view->render($resp, 'ingredient_deleted.html', ['id'=>$args['id'], "base_url"=>$args['baseUrl']]);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            echo "Page d'erreur en cours d'elaboration";
        }
    }

    public function authentificationForm($req, $resp, $args){

        if(isset($_SESSION['is_connected'])){
            $this->ListIngredients($req, $resp, $args);
        }else{
            $slimGuard = new \Slim\Csrf\Guard;
            $slimGuard->validateStorage();
            $key = $slimGuard->generateToken();
            $nameKey = $key['csrf_name'] = "tokenFormAuthentification";
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
       
        
        $taille->save();
        

        return $this->request->view->render($resp, 'modifierTaille.html', ["taille"=>$taille]);

      
    }

    public function authentificationVerify($req, $resp, $args){
        if(isset($_SESSION['is_connected'])){
            $this->ListIngredients($req, $resp, $args);
        }else{

            if($_SESSION['tokenFormAuthentification'] == $req->getParams()['valueKey']){
                $user = User::where('name', $req->getParams()['login'])->first();
                if(isset($user->password)){
                    if($user->passwor == password_verify($req->getParams()['password'], PASSWORD_DEFAULT)){
                        $this->ListIngredients($req, $resp,$args);
                        $_SESSION['is_connected'] = $user->id;
                    }else{
                        echo "Mot de passe incorrecte.";
                        $this->authentificationForm($req, $resp, $args);
                    }
                }else{
                    echo "Utilisateur inconnu.";
                    $this->authentificationForm($req, $resp, $args);
                }
            }else{
                echo "une erreur est survenue";
                $this->authentificationForm($req, $resp, $args);
            }

        }

    }

}
