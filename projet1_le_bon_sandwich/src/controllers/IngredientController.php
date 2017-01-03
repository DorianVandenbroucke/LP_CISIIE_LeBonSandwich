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

<<<<<<< HEAD
  public function responseToJSON($data,$status)
    {
=======
  function issetIngredient($ingredient){
        $ingredient["nom"] = (isset($ingredient["nom"])) ? $ingredient["nom"] : NULL;
        $ingredient["cat_id"] = (isset($ingredient["cat_id"])) ? $ingredient["cat_id"] : 0;
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
  
  function responseToJSON($data,$status){
>>>>>>> developp
        $result = $this->request->response->withStatus($status)
                                 ->withHeader('Content-Type','application/json');
        $result->getBody()->write(json_encode($data));
        return $result;
<<<<<<< HEAD
    }

=======
        echo json_encode($data);
    }

  
>>>>>>> developp
  public function listIngredients()
  {
      try
      {
<<<<<<< HEAD
        $data = Ingredient::all();
=======
        $data = [];
        $ingredients = Ingredient::all();
        foreach ($ingredients as $ingredient) {
            array_push($data, ["ingredient" => $ingredient , 
                                "links" => ["self" => ["href" => $this->request->router->PathFor('ingredient',array('id' => $ingredient->id))]] ]);
        }
>>>>>>> developp
        return $this->responseToJSON($data,200);
      }
      catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
      {
<<<<<<< HEAD
        $message = "erreur lors de la selection des donées";
        return $this->responseToJSON($data,404);
      }
  }
    public function findIngredient($id)
    {
        try{
            $data = Ingredient::findOrFail($id);
            var_dump($data);
=======
        $data =  ["Error" => "Erreur lors de la sélection des données"];
        return $this->responseToJSON($data,404);
      }
  }
    public function getIngredient($id)
    {
        try{
            $ingredient = Ingredient::findOrFail($id);
            $data = ["ingredient" => $ingredient , "categorie" => $this->request->router->PathFor('ingredientCategories',array('id' => $ingredient->id))];
>>>>>>> developp
            return $this->responseToJSON($data,200);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
<<<<<<< HEAD
            $data =  "element introuvable";
=======
            $data =  ["Error" => "Ingredient $id introuvable"];
>>>>>>> developp
            return $this->responseToJson($data,404);
        }
    }

<<<<<<< HEAD
=======
    //Create
    public function addIngredient($ingredient)
    {
        $ingredient = $this->issetIngredient($ingredient);
        $ingredient = $this->filterIngredient($ingredient);
        $newIngredient = new Ingredient();
        $newIngredient->nom = $ingredient["nom"];
        $newIngredient->cat_id = $ingredient["cat_id"];
        $newIngredient->description = $ingredient["description"];
        $newIngredient->fournisseur = $ingredient["fournisseur"];
        $newIngredient->img = $ingredient["img"];

        try{
            $newIngredient->save();
            return $this->responseToJSON($newIngredient,201);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return$this->responseToJSON($e,500);
        }
    }

    //Read 
>>>>>>> developp
    public function getCategorie($id)
    {
        try{
            $data =  Ingredient::findOrFail($id)->getCategory;
            return $this->responseToJSON($data,200);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
<<<<<<< HEAD
            $data =  "element introuvable";
=======
           $data =  ["Error" => "Ingredient $id introuvable"];
>>>>>>> developp
            return $this->responseToJson($data,404);
        }
    }

<<<<<<< HEAD
=======

    //Update
    public function updateIngredient($id, $requestbody)
    {
        $data = [];
        try{
            $ingredient = Ingredient::findOrFail($id);
            foreach ($requestbody as $key => $value) {
                if(in_array($key,$ingredient->getFillable()))
                {
                    $ingredient->$key = filter_var($value, FILTER_SANITIZE_STRING);
                }
                else
                {
                    $data[] =  ["Warring" => "Ingredient ne possede pas l'attribut $key"];
                }
            }
            $ingredient->save();
            if(!empty($data))
                return $this->responseToJSON($data,200);
            return $this->responseToJSON(NULL,204);     
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  ["Error" => "Ingredient $id introuvable"];
            return $this->responseToJson($data,404);
        }
    }       

    //Delete
    public function deleteIngredient($id)
    {
        try{
            Ingredient::findOrFail($id)->delete();
            return $this->responseToJSON(NULL,204);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  ["Error" => "Ingredient $id introuvable"];
            return $this->responseToJson($data,404);
        }
    }
>>>>>>> developp
}
