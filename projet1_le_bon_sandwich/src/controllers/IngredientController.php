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

  function issetIngredient($ingredient){
        $ingredient["nom"] = (isset($ingredient["nom"])) ? $ingredient["nom"] : NULL;
        $ingredient["cat_id"] = (isset($ingredient["cat_id"])) ? $ingredient["cat_id"] : NULL;
        $ingredient["description"] = (isset($ingredient["description"])) ? $ingredient["description"] : NULL;
        $ingredient["fournisseur"] = (isset($ingredient["fournisseur"])) ? $ingredient["fournisseur"] : NULL;
        $ingredient["img"] = (isset($ingredient["img"])) ? $ingredient["img"] : NULL;
        return $ingredient;
    }

  function filterIngredient($ingredient){
        $ingredient["nom"] = filter_var($ingredient["nom"], FILTER_SANITIZE_STRING);
        $ingredient["cat_id"] = filter_var($ingredient["cat_id"], FILTER_SANITIZE_STRING);
        $ingredient["description"] = filter_var($ingredient["description"], FILTER_SANITIZE_STRING);
        $ingredient["fournisseur"] = filter_var($ingredient["fournisseur"], FILTER_SANITIZE_STRING);
        $ingredient["img"] = filter_var($ingredient["img"], FILTER_SANITIZE_STRING);
        return($ingredient);
    }
  
  function responseToJSON($data,$status)
    {
        $result = $this->request->response->withStatus($status)
                                 ->withHeader('Content-Type','application/json');
        $result->getBody()->write(json_encode($data));
        return $result;
        echo json_encode($data);
    }

  public function listIngredients()
  {
      try
      {
        $data = [];
        $ingredients = Ingredient::all();
        foreach ($ingredients as $ingredient) {
            array_push($data, ["ingredient" => $ingredient , 
                                "links" => ["self" => ["href" => $this->request->router->PathFor('ingredient',array('id' => $ingredient->id))]] ]);
        }
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
            $ingredient = Ingredient::findOrFail($id);
            $data = ["ingredient" => $ingredient , "href" => $this->request->router->PathFor('ingredientCategories',array('id' => $ingredient->id))];
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
        $ingredient = $this->issetIngredient($ingredient);
        $ingredient = $this->filterIngredient($ingredient);
        $newIngredient = new Ingredient();
        $newIngredient->nom = $nom;
        $newIngredient->cat_id = $cat_id;
        $newIngredient->description = $description;
        $newIngredient->fournisseur = $fournisseur;
        $newIngredient->img = $img;

        try{
            $newIngredient->save();
            return $this->responseToJSON($newIngredient,201);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return$this->responseToJSON($e,500);
        }


    }

}
