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
  
  public function ingredients(){
    return $this->belongsToMany('src\models\Ingredient', 'ingredient_sandwich', 'id_sandwich', 'id_ingredient');
  }

}
>>>>>>> ebf81c89938e314fe85a076a2d798ce72e24a40f
