<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model{

  protected $table = "sandwich";
  protected $primaryKey = "id";
  protected $fillable = ["type_de_pain", "taille", "id_commande"];
  public $timestamps = false;
<<<<<<< HEAD


=======
>>>>>>> ad628397ee4211ac1f3c81f39c60d0e0562157cf

  public function ingredients(){
    return $this->belongsToMany("src/models/Ingredients",
                                "ingredient_sandwich",
                                "id_sandwich", "id_ingredient");

  }
<<<<<<< HEAD
}


=======

}
>>>>>>> ad628397ee4211ac1f3c81f39c60d0e0562157cf
