<?php

namespace src\controllers;

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;

class SandwichController extends AbstractController{

  public function add($req, $resp, $id_commande){
      try{
        $commande = Commande::findOrFail($id_commande);
        $taille = $req->getParams()["taille"];
        $type = $req->getParams()["type"];

        $sandwich = new Sandwich();
        $sandwich->taille = $taille;
        $sandwich->type_de_pain = $type;
        $sandwich->id_commande = $id_commande;
        $sandwich->save();

        $id_sandwich = $sandwich->id;

        $liens = [
                  "commande" => DIR."/commandes/$id_commande/",
                  "ingredients" => DIR."/sandwichs/$id_sandwich/ingredients/"
                ];
        $chaine = [
                    "taille" => $taille,
                    "type_de_pain" => $type,
                    "links" => $liens
                  ];
        return $this->responseJSON(200, $chaine);
      }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $chaine = ["Erreur", "Ressource de la commande $id_commande introuvable."];
            return $this->responseJSON(404, $chaine);
      }
  }

}
