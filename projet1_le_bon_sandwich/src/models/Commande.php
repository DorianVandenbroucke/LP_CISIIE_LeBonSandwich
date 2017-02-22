<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model{

  protected $table = "commande";
  protected $primaryKey = "id";
  protected $fillable = ["montant", "date_de_livraison", "etat", "token"];
  public $timestamps = false;

  public function sandwichs(){
    return $this->hasMany("src\models\Sandwich", "id_commande");
  }

}
