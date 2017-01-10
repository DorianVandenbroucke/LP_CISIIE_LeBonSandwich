<?php

namespace src\controllers;

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;

class CommandeController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct(HttpRequest $http_req){
    $this->request = $http_req;
    $this->auth = new Authentification();
  }

  static public function add($montant, $date_de_livraison, $etat){


    if(!isset($args['etat'])){
      $etat = "En attente";
    }

    $commande = new Commande();
    $commande->montant = $montant;
    $commande->date_de_livraison = $date_de_livraison;
    $commande->etat = $etat;

    $commande->save();

    $chaine = [
                "id" => $commande->id,
                "lien" => "/commandes/$commande->id"
              ];
    return $chaine;

  }

  static public function detailCommande($id){
    $commande = Commande::findOrFail($id);

    if($commande->etat != "livrée"){
      $nom_lien = "lien_de_suppression";
      $lien = "/commandes/$commande->id/delete";
    }else{
      $nom_lien = "lien_de_la_facture";
      $lien = "/commandes/$commande->id/facture";
    }

    $chaine = [
                "id" => $commande->id,
                "montant" => $commande->montant,
                "date_de_livraison" => $commande->date_de_livraison,
                "etat" => $commande->etat,
                "lien_du_detail" => "/commandes/$commande->id/sandwichs",
                $nom_lien => $lien
              ];
    return $chaine;
  }

  static public function sandwichsByCommande($id){
    $commande = Commande::findOrFail($id);
    $sandwichs = $commande->sandwichs()->get();
    $nb_sandwichs = $sandwichs->count();

    $sandwichs_tab = [];
    foreach($sandwichs as $s){
      array_push(
                  $sandwichs_tab,
                  [
                    "nom" => $s->nom,
                    "lien_de_suppression" => "/sandwichs/$s->id/commandes/$commande->id/delete"
                  ]
                );
    }

    $chaine = [
                "id_commande" => $commande->id,
                "nb_sandwichs" => $nb_sandwichs,
                "sandwichs"  => $sandwichs_tab,
                "lien_de_modification" => "/commande/$commande->id/update",
                "lien_de_paiement" => "/commande/$commande->id/payment"
              ];

    return $chaine;
  }



  static public function modifySandwich($id, $taille, $pain,$ingredient){

  		$sandwich = Sandwich::findOrFail($id);
     
      $commande = $sandwich->getCommande()->get();
      var_dump($commande);

  		if($commande->etat == "payé" || $commande->etat == "créé"){
  		
          $sandwich->taille = $taille;
          $sandwich->pain = $pain;
          $sandwich->ingredient = $ingredient;
          $sandwich->save();

          $chaine = [
              "id"=> $sandwich->id,
              "pain"=> $sandwich->pain,
              "ingredient"=> $sandwich->ingredient
          ];

          return $chaine;
  		}
      else{
          $error = "Vous ne pouvez  pas faire de modification";

          return $error;
      }
  }
}
