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
      $lien = array(
                      "nom" => $c->nom,
                      "lien" => DIR."/categories/$c->id/"
                    );
      array_push($categories_tab, $lien);
    //   var_dump($this->request->router->PathFor('categories', array('id' => $c->id)));
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
        $lien_ingredients = ["ingredients" => DIR."/categories/$category->id/ingredients/"];
        $chaine = [
                    "id" => $category->id,
                    "nom" => $category->nom,
                    "description" => $category->description,
                    "links" => $lien_ingredients
                  ];
        return $this->responseJSON(200, $chaine);
    }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        $chaine = ["error" => "Categorie d'ingrédients $id introuvable."];
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
          array_push(
                      $ingredients_tab,
                      [
                        "id" => $i->id,
                        "nom" => $i->nom,
                        "cat_id" => $i->cat_id,
                        "description" => $i->description,
                        "fournisseur" => $i->fournisseur,
                        "img" => $i->img,
                        "lien" => DIR."/ingredients/$i->id/"
                      ]
                    );
        }

        $chaine = [
                    "nombre_d_ingredient" => $nb_ingredients,
                    "ingredients" => $ingredients_tab
                  ];
        return $this->responseJSON(200, $chaine);

      }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        $chaine = ["Erreur", "Categorie d'ingrédients $id introuvable."];
        return $this->responseJSON(400, $chaine);
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
