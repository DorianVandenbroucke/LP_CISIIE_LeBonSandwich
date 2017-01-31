<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model{

  protected $table = "ingredient";
  protected $primaryKey = "id";
  protected $fillable = ["nom", "cat_id", "description", "fournisseur", "img"];
  public $timestamps = false;

  public function getCategory(){
    return $this->belongsTo("src\models\Categorie", "cat_id");
  }

   public function sandwichs(){
    return $this->belongsToMany("src/models/Sandwich", "ingredient_sandwich", "id_ingredient", "id_sandwich");
  }

}
