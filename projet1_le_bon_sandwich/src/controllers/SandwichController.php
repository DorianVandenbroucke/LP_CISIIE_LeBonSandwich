<?php
namespace src\controllers;

const TYPES = ["blanc", "complet", "céréales"];
const SIZES = ["petite faim", "moyenne faim", "grosse faim", "ogre"];
const PRICES = ["petite faim" => 1.00, "moyenne faim" => 1.75, "grosse faim" => 2.30, "ogre" => 2.65];

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;
use src\models\Ingredient as Ingredient;

use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

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

            $commande->montant += PRICES[$taille];
            $commande->save();

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


	public function delete($req, $resp, $id_sandwich){

		try{

			$sandwich = Sandwich::findOrFail($id_sandwich);
			$commande = Commande::findOrFail($sandwich->id_commande);

			$status_commande = ["créée", "payée"];

			if(!in_array($commande->etat, $status_commande)){

				if($sandwich->delete()){
					$liens = ["commande" => DIR."/commandes/".$commande->id];
					$chaine = [
								"Le sandwich a été supprimé avec succés.",
								"liens" => $liens
							  ];
					return $this->responseJSON(200, $chaine);
				}else{
					return $this->responseJSON(400, ["erreur", "Une erreur est survenue lors de l'exécution de la requête."]);
				}

			}else{
				$chaine = ["error" => "Cette commande est ".$commande->etat.", elle n'est donc plus modifiable"];
				return $this->responseJSON(404, $chaine);
			}

		}catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $chaine = ["Erreur", "Ressource du sandwich $id_sandwich introuvable."];
            return $this->responseJSON(404, $chaine);
		}

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
                  /$id_commande/sandwichs/$id_sandwich/ingredients"
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

	  public function modifyIngredients($req, $resp, $args){

				try{
					$id_sandwich = $args['id_sandwich'];
					$sandwich = Sandwich::findOrFail($id_sandwich);
					$ingredients = $sandwich->ingredients()->get();

                    if(in_array($ingredients, $args['id_ingredient'])){

                    }else{

                    }

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
			}

}
