<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model{

  protected $table = "ingredient";
  protected $primaryKey = "id";
  protected $fillable = ["name", "cat_id", "description", "fournisseur", "img"];
  public $timestamps = false;

  public function getCategory(){
    return $this->belongsTo("src\models\Category", "cat_id");
  }

}
