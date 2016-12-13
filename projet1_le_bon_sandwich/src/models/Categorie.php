<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model{

  protected $table = "categorie";
  protected $primaryKey = "id";
  protected $fillable = ["nom", "description"];
  public $timestamps = false;

  public function getIngredients(){
    return $this->hasMany("src\models\Ingredient", "cat_id");
  }

}
