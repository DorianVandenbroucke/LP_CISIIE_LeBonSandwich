<?php

namespace src\controllers;

use src\models\Categorie as Categorie;
use src\models\Ingredient as Ingredient;

class CategorieController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct(HttpRequest $http_req){
    $this->request = $http_req;
    $this->auth = new Authentification();
  }

  static public function listCategories(){
    $categories = Categorie::select("id", "nom")->get();
    $nb_categories = $categories->count();

    $categories_tab = [];
    foreach($categories as $c){
      $lien = array(
                  "nom" => $c->nom,
                  "lien" => "/categories/$c->id");
      array_push($categories_tab, $lien);
    }

    $chaine = [
                "nombre_de_categories" => $nb_categories,
                "categories" => $categories_tab
              ];
    return $chaine;
  }

  static public function detailCategory($id){
    $category = Categorie::findOrFail($id);
    $chaine = [
                "id" => $category->id,
                "nom" => $category->nom,
                "description" => $category->description,
                "lien" => "/categories/$category->id/ingredients",
              ];
    return $chaine;
  }

  static public function ingredientsByCategorie($id){
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
                    "lien" => "/ingredients/$i->id"
                  ]
                );
    }

    $chaine = [
                "nombre_d_ingredient " => $nb_ingredients,
                "ingredients" => $ingredients_tab
              ];
    return $chaine;
  }

  static public function addCategorie(){
    $categorie = new Categorie();
    $categorie->nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
    $categorie->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $categorie->save();
    return $categorie;
  }

}
