<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model{

  protected $table = "sandwich";
  protected $primaryKey = "id";
  protected $fillable = ["nom"];
  public $timestamps = false;

  public function commandes(){
    return $this->belongsToMany(
                                  "src\models\Sandwich",
                                  "sandwich_commande",
                                  "id_sandwich", "id_commande"
                               );
  }

}
