<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Taille extends Model{

  protected $table = "taille";
  protected $primaryKey = "id";
  protected $fillable = ["description", "prix"];
  public $timestamps = false;


}