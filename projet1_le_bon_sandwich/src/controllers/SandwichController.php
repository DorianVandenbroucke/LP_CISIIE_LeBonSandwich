<?php

namespace src\controllers;

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;

class CommandeController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct($http_req){
    $this->request = $http_req;
    //$this->auth = new Authentification();
  }

  static public function add($id_commande, $taille, $type){
    $sandwich = Sandwich::findOrFail($id_sandwich);
    $commandes = $sandwich->commandes()->attach($id_sandwich, ['id_sandwich' => $id_commande]);

    $chaine = [
                "lien_de_la_commande" => DIR."/commandes/$id_commande"
              ];
    return $chaine;

    $commande = Commande::findOrFail($id_commande);

    $sandwich = new Sandwich();
    $sandwich->taille = $taille;
    $sandwich->type = $type;
    $sandwich->id_commande = $id_commande;
    $sandwich->save();

    $id_sandwich = $sandwich->id;

    $lien = [
              "commande" => DIR."/commandes/$id_commande/",
              "ingredients" => DIR."/sandwichs/$id_sandwich/ingredients/"
            ];
    $chaine = [
                "taille" => $taille,
                "type_de_pain" => $type,
                "lien" => $liens
              ];

    return $chaine;

  }

}
