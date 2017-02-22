<?php
namespace src\controllers;


const TYPES = ["blanc", "complet", "céréales"];
const SIZES = ["petite faim", "moyenne faim", "grosse faim", "ogre"];
const PRICES = ["petite faim" => 1.00, "moyenne faim" => 1.75, "grosse faim" => 2.30, "ogre" => 2.65];
const CREATED = 1;
const PAID = 2;
const HANDLED = 3;
const READ = 4;
const DELIVRED = 5;


use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;
use src\models\Ingredient as Ingredient;
use src\models\Taille as Taille;

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
					  "ingredients" => DIR."/commandes/$id_commande/sandwichs/$id_sandwich/ingredients/"
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
            $chaine = ["Erreur" => "Ressource de la commande $id_commande introuvable."];
            return $this->responseJSON(404, $chaine);
      }
  }


	public function delete($req, $resp, $id_sandwich){

		try{

			$sandwich = Sandwich::findOrFail($id_sandwich);
			$commande = Commande::findOrFail($sandwich->id_commande);

			$status_commande = [CREATED, PAID];

			if(!in_array($commande->etat, $status_commande)){

				if($sandwich->delete()){
					$liens = ["commande" => DIR."/commandes/".$commande->id];
					$chaine = [
								"Le sandwich a été supprimé avec succés.",
								"liens" => $liens
							  ];
					return $this->responseJSON(200, $chaine);
				}else{
                    $chaine = ["erreur" => "Une erreur est survenue lors de l'exécution de la requête."];
					return $this->responseJSON(400, $chaine);
				}

			}else{
				$chaine = ["error" => "Cette commande est ".$commande->etat.", elle n'est donc plus modifiable"];
				return $this->responseJSON(404, $chaine);
			}

		}catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $chaine = ["Erreur" => "Ressource du sandwich $id_sandwich introuvable."];
            return $this->responseJSON(404, $chaine);
		}

	}


      public function modifySandwich($req, $resp, $args){
        try{
            $id_sandwich = $args['id_sandwich'];
            $sandwich = Sandwich::findOrFail($id_sandwich);
            $id_commande = $sandwich->id_commande;
            $commande = Commande::findOrfail($id_commande);

          if($commande->etat == CREATED){
              $taille = $req->getParams()['taille'];
              $type_de_pain = $req->getParams()['type'];
              $sandwich->type_de_pain = $type_de_pain;
              $sandwich->taille = $taille;
              $sandwich->save();
              $chaine = [
                  "taille"=> $taille,
                  "type"=> $type_de_pain,
                  "lien_modification_ingredients"=> DIR."/commandes/$id_commande/sandwichs/$id_sandwich/ingredients"
              ];
              return $this->responseJSON(200, $chaine);
          }
          else{
            $chaine = ["Erreur" => "Impossible de modifier le sandwich car la commande à déjà été payée ou livrée"];
            return $this->responseJSON(400, $chaine);

          }
      } catch(ModelNotFoundExceptionn $e){
            $chaine = ["Erreur" => "La sandwich est introuvable"];
            return $this->responseJSON(404, $chaine);


      }
	}

    public function listIngredients($req, $resp, $args){

        try{
            $sandwich = Sandwich::findOrFail($args['id_sandwich']);
            $ingredients = $sandwich->ingredients()->get();
            $nb_ingredients = $ingredients->count();

            $ingredients_tab = [];

            foreach($ingredients as $ingredient){
                $elm = [
                        "nom" => $ingredient->nom,
                        "links" => ["self" => DIR."/ingredients/".$ingredient->id]
                       ];
                array_push($ingredients_tab, $elm);
            }

            $chaine = [
                        "nb_ingredients" => $nb_ingredients,
                        "ingredients" => $ingredients_tab
                      ];

            return $this->responseJSON(200, $chaine);

        }catch(ModelNotFoundExceptionn $e){
            return $this->responseJSON(404, ["erreur" => "Le sandwich est introuvable"]);
        }

    }

	  public function modifyIngredients($req, $resp, $args){

				try{
					$id_sandwich = $args['id_sandwich'];
					$sandwich = Sandwich::findOrFail($id_sandwich);
					$ingredients = $sandwich->ingredients()->get();

                    $ingredients_id_tab = [];

                    foreach($ingredients as $ingredient){
                        array_push($ingredients_id_tab, $ingredient->id);
                    }

                    if(in_array($args['id_ingredient'], $ingredients_id_tab)){
                        $sandwich->ingredients()->detach($args['id_ingredient']);
                        $message = "Ingrédient supprimé avec succès.";
                    }else{
                        $sandwich->ingredients()->attach($args['id_ingredient']);
                        $message = "Ingrédient ajouté avec succès.";
                    }

                    return $this->responseJSON(200, ["Succès" => $message]);

				}catch(ModelNotFoundExceptionn $e){
					$chaine = ["Erreur" => "La sandwich est introuvable"];
                    return $this->responseJSON(404, $chaine);

				}
			}


			public function modifierTailleSandwich($req, $resp, $args, $requestbody){
			$data = [];
			try{
				$id_taille = $args["id_taille"];
				$taille = Taille::findOrFail($id_taille);

				foreach ($requestbody as $key => $value) {
					if(in_array($key,$taille->getFillable()))
					{
						$taille->$key = filter_var($value, FILTER_SANITIZE_STRING);
					}
					else
					{
						$data[] =  ["Warning" => "Il manque une valeur à l'attribut $key"];
					}
				}
				$taille->save();
				if(!empty($data))
				return $this->responseJSON(200, $data);
				return $this->responseJSON(204, NULL);

			}catch(ModelNotFoundException $e){
				$data =  ["Error" => "La taille que vous demandez est introuvable"];
				return $this->responseJSON(404, $data);
			}
		}
}
