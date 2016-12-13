<?php

header("Content-Type: application/json");

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');

use src\models\Ingredient as Ingredient;
use src\models\Categorie as Categorie;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $categorie = new Categorie();
  $categorie->nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
  $categorie->description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $categorie->save();

  http_response_code(201);
}

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $ingredients = Ingredient::where("cat_id", $id)->get()->toJson();
  $json_char = $ingredients;

}else{
  $nb_categories = Categorie::count();
  $categories = Categorie::select("id", "nom")->get();
  $chaine = [
              "nb" => $nb_categories,
              "categories" => $categories
            ];
  $json_char = json_encode($chaine);
}

echo $json_char;
