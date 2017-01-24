<?php

namespace src\controllers;

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;
use src\models\Ingredient as Ingredient;

use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class SandwichController extends AbstractController{

  //private $request = null;
  //private $auth;

 /* public function __construct($http_req){
    $this->request = $http_req;
    //$this->auth = new Authentification();
  }*/

   static public function add($req, $resp, $args){
    $id_commande = $args['id_commande'];
    $taille = $req->getParams()["taille"];
    $type = $req->getParams()["type"];
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


      public function modifySandwich($req, $resp, $args){

        try{
            $id_sandwich = $args['id_sandwich'];
            $sandwich = Sandwich::findOrFail($id_sandwich);
            $id_commande = $sandwich->id_commande;
            $commande = Commande::findOrfail($id_commande);
        
          if($commande->etat == "payé" || $commande->etat == "créé"){
          
              $taille = $sandwich->taille;
              $type_de_pain = $sandwich->type_de_pain;
              $sandwich->save();

              $chaine = [
                  "taille"=> $taille,
                  "type"=> $type_de_pain,
                  "lien_modification_ingredients"=> DIR."/commandes
                  /{id_commande}/sandwichs/{id_sandwich}/ingredients"
              ];

              $resp->getBody()->write(json_encode($chaine));
              return $resp;
          }
          else{
            $chaine = ["Erreur" => "Impossible de modifier le sandwich"];
            $resp = $resp->withHeader('Content-type', 'application/json');
            $resp->getBody()->write(json_encode($chaine));
          }
      } catch(ModelNotFoundExceptionn $e){
            $chaine = ["Erreur" => "La sandwich est introuvable"];
            $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json');
            $resp->getBody()->write(json_encode($chaine));

      }
        
  }



 /* public function modifyIngredients($req, $resp, $args){

    try{
        $id_sandwich = $args['id'];
        $sandwich = Sandwich::findOrFail($id_sandwich);
        $ingredients = $sandwich->ingredients()->get();
        
        if($ingredients['salade']){
          $ingredients['salade'] = $salade;
          $salade->save();
        }
        if($ingredients['crudite']){
          $ingredients['crudite'] = $crudite;
          $crudite->save();
        } 
        if( $ingredients['viande']){ 
          $ingredients['viande'] = $viande;
          $viande->save();
        } 
        if($ingredients['fromage']){
          $ingredients['fromage']  = $fromage;
          $fromage->save();
        }
        if($ingredients['sauce']){
          $ingredients['sauce'] = $sauce;
          $sauce->save();
        } 

    }catch(ModelNotFoundExceptionn $e){
        $chaine = ["Erreur" => "La sandwich est introuvable"];
        $resp = $resp->withStatus(404)->withHeader('Content-type', 'application/json');
        $resp->getBody()->write(json_encode($chaine));

    }

  }*/

}
