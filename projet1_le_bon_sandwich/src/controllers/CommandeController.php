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

  static public function add($args){

    var_dump($args); die;

    if(!isset($args['etat'])){
      $etat = "En attente";
    }

    $commande = new Commande();
    $commande->montant = $args['montant'];
    $commande->date_de_livraison = $args['date_de_livraison'];
    $commande->etat = $args['etat'];

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
      $lien = DIR."/commandes/$commande->id/delete";
    }else{
      $nom_lien = "lien_de_la_facture";
      $lien = DIR."/commandes/$commande->id/facture";
    }

    $chaine = [
                "id" => $commande->id,
                "montant" => $commande->montant,
                "date_de_livraison" => $commande->date_de_livraison,
                "etat" => $commande->etat,
                "lien_du_detail" => DIR."/commandes/$commande->id/sandwichs",
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
                    "taille" => $s->taille,
                    "type_de_pain" => $s->type_de_pain,
                  ]
                );
    }

    $liens = [
              "paiement" => DIR."/commandes/$commande->id/paiement/"
             ];
    $chaine = [
                "id_commande" => $commande->id,
                "nb_sandwichs" => $nb_sandwichs,
                "sandwichs"  => $sandwichs_tab,
                "liens" => $liens
              ];

    return $chaine;
  }

  public function listCommandes()
  {
      $commandes = Commande::orderBy('date_de_livraison','desc')
                            ->orderBy('ordre_creation','desc')
                            ->get();
      $result = $this->request->response->withStatus(200)->withHeader('Content-Type','application/json');
      $result->getBody()->write(json_encode($commandes));
      return $result;
  }

  public function filtrageCommandes($etat, $date)
  {
      if(!isset($date)){
        $commandes = Commande::where('etat','=',$etat)->get();
      }
      else{
        $date = strtotime($date);
        $date = date('Y-m-d',$date);
        $commandes = Commande::where('etat','=',$etat)->where('date_de_livraison','=',$date)->get();
      }
      $result = $this->request->response->withStatus(200)
                             ->withHeader('Content-Type','application/json');
      $result->getBody()->write(json_encode($commandes));
      return $result;
    }

}
