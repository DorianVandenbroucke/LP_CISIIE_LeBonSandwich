<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

  protected $table = "user";
  protected $primaryKey = "id";
  protected $fillable = ["name", "password"];
  public $timestamps = false;

}
