<?php

namespace src\controllers;

use src\models\Categorie as Categorie;
use src\models\Ingredient as Ingredient;

class IngredientController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct($http_req){
    $this->request = $http_req;
  }

  public function responseToJSON($data,$status)
    {
        $result = $this->request->response->withStatus($status)
                                 ->withHeader('Content-Type','application/json');
        $result->getBody()->write(json_encode($data));
        return $result;
    }

  public function listIngredients()
  {
      try
      {
        $data = Ingredient::all();
        return $this->responseToJSON($data,200);
      }
      catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
      {
        $message = "erreur lors de la selection des donées";
        return $this->responseToJSON($data,404);
      }
  }
    public function findIngredient($id)
    {
        try{
            $data = Ingredient::findOrFail($id);
            return $this->responseToJSON($data,200);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  "element introuvable";
            return $this->responseToJson($data,404);
        }
    }

    public function getCategorie($id)
    {
        try{
            $data =  Ingredient::findOrFail($id)->getCategory;
            return $this->responseToJSON($data,200);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  "element introuvable";
            return $this->responseToJson($data,404);
        }
    }

    public function addIngredient($ingredient){
        $nom= filter_var($ingredient["nom"], FILTER_SANITIZE_STRING);
        $cat_id = filter_var($ingredient["cat_id"], FILTER_SANITIZE_STRING);
        $description = filter_var($ingredient["description"], FILTER_SANITIZE_STRING);
        $fournisseur = filter_var($ingredient["fournisseur"], FILTER_SANITIZE_STRING);
        $img = filter_var($ingredient["img"], FILTER_SANITIZE_STRING);

        $newIngredient = new Ingredient();
        $newIngredient->nom = $nom;
        $newIngredient->cat_id = $cat_id;
        $newIngredient->description = $description;
        $newIngredient->fournisseur = $fournisseur;
        $newIngredient->img = $img;

        $newIngredient->save();

        return $this->responseToJSON($newIngredient,201);

    }

}
