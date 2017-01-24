<?php

namespace src\controllers;

use src\models\Categorie as Categorie;
use src\models\Ingredient as Ingredient;
use \Psr\Http\Message\ServerRequestInterface as Request;
use src\utils\Authentification ;

class IngredientController extends AbstractController{

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

  public function listIngredients($req, $res, $args)
  {
      if(!Authentification::checkACCESS($req)){
          return $this->responseJSON(401, 'access dined');
      }

      try
      {
        $data = [];
        $ingredients = Ingredient::all();
        foreach ($ingredients as $ingredient) {
            array_push($data, ["ingredient" => $ingredient ,
                                "links" => ["self" => ["href" => $this->request->router->PathFor('ingredient',array('id' => $ingredient->id))]] ]);
        }
        return $this->responseJSON(200, $data);
      }
      catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
      {
        $data =  ["Error" => "Erreur lors de la sélection des données"];
        return $this->responseJSON(404, $data);
      }
  }
    public function getIngredient($req, $res, $id)
    {
        try{
            $ingredient = Ingredient::select('nom','description','fournisseur', 'img')->findOrFail($id);
            $ingredient->categorie = Ingredient::findOrFail($id)->getCategory()->select('nom','description')->get();
            $data = ["ingredient" => $ingredient , "categorie" => $this->request->router->PathFor('ingredientCategories',['id' => $id])];
            return $this->responseJSON(200, $data);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  ["Error" => "Ingredient $id introuvable"];
            return $this->responseJSON(404, $data);
        }
    }

    //Create
    public function addIngredient($req, $res, $ingredient)
    {
      if(!Authentification::checkACCESS($req)){
          return $this->responseJSON(401, 'access dined');
      }

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
            return $this->responseJSON(201, $newIngredient);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return $this->responseJSON(500, $e);
        }
    }

    //Read 
    public function getCategorie($req, $res, $id)
    {
        try{
            $data =  Ingredient::findOrFail($id)->getCategory()->select('nom','description')->get();
            return $this->responseJSON(200,$data);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
           $data =  ["Error" => "Ingredient $id introuvable"];
           return $this->responseJSON(404, $data);
        }
    }


    //Update
    public function updateIngredient($req, $res, $id, $requestbody)
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
                return $this->responseJSON(200, $data);
            return $this->responseJSON(204, NULL);     
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  ["Error" => "Ingredient $id introuvable"];
            return $this->responseJSON(404, $data);
        }
    }       

    //Delete
    public function deleteIngredient($req, $res, $id)
    {
        if(!Authentification::checkACCESS($req)){
          return $this->responseJSON(401, 'access dined');
        }

        try{
            Ingredient::findOrFail($id)->delete();
            return $this->responseJSON(204,NULL);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $data =  ["Error" => "Ingredient $id introuvable"];
            return $this->responseJSON(404, $data);
        }
    }
}
