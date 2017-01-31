<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model{

  protected $table = "sandwich";
  protected $primaryKey = "id";
  protected $fillable = ["type_de_pain", "taille", "id_commande"];
  public $timestamps = false;

  public function ingredients(){
    return $this->belongsToMany("src/models/Ingredients",
                                "ingredient_sandwich", 
                                "id_sandwich", "id_ingredient");

  }
}


