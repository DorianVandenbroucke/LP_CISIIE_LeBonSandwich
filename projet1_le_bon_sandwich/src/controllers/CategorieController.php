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
    $chaine = [
                "nombre_de_categories" => $nb_categories,
                "categories" => $categories
              ];
    return $chaine;
  }

  static public function ingredientsByCategorie($id){
    $categorie = Categorie::findOrFail($id);
    $ingredients = Ingredient::where("cat_id", $id)->get();
    $nb_ingredients = $ingredients->count();
    $chaine = [
                "nombre_d_ingredient " => $nb_ingredients,
                "ingredients" => $ingredients
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
