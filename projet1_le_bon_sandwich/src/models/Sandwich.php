<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model{

  protected $table = "sandwich";
  protected $primaryKey = "id";
  protected $fillable = ["type_de_pain", "taille", "id_commande"];
  public $timestamps = false;

<<<<<<< HEAD
  public function ingredients(){
    return $this->belongsToMany("src/models/Ingredients",
                                "ingredient_sandwich", 
                                "id_sandwich", "id_ingredient");

  }
}
=======
  public function ingredient(){
    return $this->belongsToMany('src\models\Ingredient', 'ingredient_sandwich', 'id_sandwich', 'id_ingredient');
  }

}
>>>>>>> e846f17195c65bec34976bb1936fbd33e34a16e6
