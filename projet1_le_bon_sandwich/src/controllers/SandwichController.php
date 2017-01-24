<?php

namespace src\controllers;

const TYPES = ["blanc", "complet", "céréales"];
const SIZES = ["petite faim", "moyenne faim", "grosse faim", "ogre"];

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;

class SandwichController extends AbstractController{

  public function add($req, $resp, $id_commande){
      try{
        $commande = Commande::findOrFail($id_commande);
        $taille = $req->getParams()["taille"];
        $type = $req->getParams()["type"];
		
		if(in_array($taille, SIZES) && in_array($type, TYPES)){
		
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
			
		}else{
			return $this->responseJSON(400, ["erreur" => "Le type ou la taille entré n'est pas valide"]);
		}
      }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $chaine = ["Erreur", "Ressource de la commande $id_commande introuvable."];
            return $this->responseJSON(404, $chaine);
      }
  }

}
