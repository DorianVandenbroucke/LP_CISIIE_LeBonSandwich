<?php

namespace src\controllers;

use src\models\Categorie as Categorie;
use src\models\Ingredient as Ingredient;

class CategorieController extends AbstractController{

  public function listCategories($resp){
    $categories = Categorie::select("id", "nom")->orderBy("nom")->get();
    $nb_categories = $categories->count();

    $categories_tab = [];
    foreach($categories as $c){
      $url = $this->request->router->PathFor('category', array('id' => $c->id));
      $lien = array(
                      "nom" => $c->nom,
                      "liks" => ["self" => $url]
                    );
      array_push($categories_tab, $lien);
    }

    $chaine = [
                "nombre_de_categories" => $nb_categories,
                "categories" => $categories_tab
              ];
    return $this->responseJSON(200, $chaine);
  }

  public function detailCategory($resp, $id){
     try{
        $category = Categorie::findOrFail($id);
        $url = $this->request->router->PathFor('categories_ingredients', array('id' => $category->id));
        $lien_ingredients = ["ingredients" => $url];
        $chaine = [
                    "id" => $category->id,
                    "nom" => $category->nom,
                    "description" => $category->description,
                    "links" => $lien_ingredients
                  ];
        return $this->responseJSON(200, $chaine);
    }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        $chaine = ["error" => "Categorie $id introuvable."];
        return $this->responseJSON(404, $chaine);
    }
  }

  public function ingredientsByCategorie($resp, $id){
      try{
        $categorie = Categorie::findOrFail($id);
        $ingredients = Ingredient::where("cat_id", $id)->orderBy("nom")->get();
        $nb_ingredients = $ingredients->count();

        $ingredients_tab = [];
        foreach($ingredients as $i){
          $url = $this->request->router->PathFor('ingredient', array('id' => $i->id));
          array_push(
                      $ingredients_tab,
                      [
                        "id" => $i->id,
                        "nom" => $i->nom,
                        "links" => ["self" => $url]
                      ]
                    );
        }

        $chaine = [
                    "nombre_d_ingredient" => $nb_ingredients,
                    "ingredients" => $ingredients_tab
                  ];
        return $this->responseJSON(200, $chaine);

      }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        $chaine = ["error" => "Categorie d'ingrédients $id introuvable."];
        return $this->responseJSON(404, $chaine);
      }
  }

  static public function addCategorie(){
    $categorie = new Categorie();
    $categorie->nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
    $categorie->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $categorie->save();
    return $categorie;
  }

}
