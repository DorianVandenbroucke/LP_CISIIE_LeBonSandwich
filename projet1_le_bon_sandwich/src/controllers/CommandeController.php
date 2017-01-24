<?php

namespace src\controllers;

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;
use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class CommandeController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct($http_req){
    $this->request = $http_req;
    //$this->auth = new Authentification();
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


  
    public function updateCommande($req, $resp, $args){
        try{
            $id = $args['id'];
            $commande = Commande::findOrFail($id);
            $new_date = $req->getParams()['date_de_livraison'];
            if ($commande->etat === "crée") {
                $commande->date_de_livraison = $new_date;
                $chaine = [
                    "id" => $commande->id,
                    "montant" => $commande->montant,
                    "date_de_livraison" => $commande->date_de_livraison,
                    "etat" => $commande->etat
                ];
                $commande->save();
                $resp = $resp->withStatus(200)->withHeader('Content-Type','application/json');
                $resp->getBody()->write(json_encode($chaine));
            } else {
                $chaine = ["Erreur" => "La commande est déjà $commande->etat"];
                $resp = $resp->withHeader('Content-type', 'application/json');
                $resp->getBody()->write(json_encode($chaine));
            }
        }catch(ModelNotFoundException $e){
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json');
            $resp->getBody()->write(json_encode($chaine));
        }
        return $resp;
    }

    public function deleteCommande($req, $resp, $args){
        try {
            $id = $args['id'];
            $commande = Commande::findOrFail($id);
            if ($commande->etat === "crée") {
                $commande->delete();
                $chaine = ["Executé" => "La commande a été correctement supprimée"];
                $resp = $resp->withStatus(200)->withHeader('Content-Type','application/json');
                $resp->getBody()->write(json_encode($chaine));
            }else{
                $chaine = ["Erreur" => "La commande est déjà $commande->etat"];
                $resp = $resp->withHeader('Content-type', 'application/json');
                $resp->getBody()->write(json_encode($chaine));
            }
        } catch (ModelNotFoundException $e) {
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json');
            $resp->getBody()->write(json_encode($chaine));
        }
        return $resp;
    }

    public function payCommande($req, $resp, $args){
        try {
            $id = $args['id'];
            $params = $req->getParams();
            $commande = Commande::findOrFail($id);

            if ($commande->etat === "crée") {
                $num_carte = $params['num_carte'];
                $date_validite = $params['date_validite'];
                $key = $params['key'];
                $commande->etat = "payée";
                $commande->save();
                $chaine = ["Executé" => "La commande a été payée"];
                $resp = $resp->withStatus(200)->withHeader('Content-Type','application/json');
                $resp->getBody()->write(json_encode($chaine));
            } else{
                $chaine = ["Erreur" => "La commande est déjà $commande->etat"];
                $resp = $resp->withHeader('Content-type', 'application/json');
                $resp->getBody()->write(json_encode($chaine));
            }
        } catch (ModelNotFoundException $e) {
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json');
            $resp->getBody()->write(json_encode($chaine));
        }
        return $resp;
    }

    // public function factureCommande($req, $resp, $args){
    //     try {
    //         $id = $args['id'];
    //         $commande = Commande::findOrFail($id);
    //         $sandwich = Sandwich::get();
    //         var_dump($sandwich->id_commande);
    //         if ($commande->etat === "livrée") {
    //             $chaine = [
    //                 "id" => $commande->id,
    //                 "montant" => $commande->montant,
    //                 "date_de_livraison" => $commande->date_de_livraison,
    //                 "etat" => $commande->etat
    //             ];
    //             var_dump($chaine);
    //         } else{
    //             $chaine = ["Erreur" => "La commande n'a pas encore été livrée"];
    //             $resp = $resp->withHeader('Content-type', 'application/json');
    //             $resp->getBody()->write(json_encode($chaine));
    //         }
    //     } catch (ModelNotFoundException $e) {
    //         $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
    //         $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json');
    //         $resp->getBody()->write(json_encode($chaine));
    //     }
    //     return $resp;
    //
    // }

}
