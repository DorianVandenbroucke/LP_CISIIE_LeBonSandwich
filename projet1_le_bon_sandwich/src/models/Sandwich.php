<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model{

  protected $table = "sandwich";
  protected $primaryKey = "id";
  protected $fillable = ["type_de_pain", "taille", "id_commande"];
  public $timestamps = false;

}
