<?php

namespace src\controllers;

const CREATED = 1;
const PAID = 2;
const HANDLED = 3;
const READ = 4;
const DELIVRED = 5;

use src\models\Commande as Commande;
use src\models\Sandwich as Sandwich;
use src\models\Ingredient as Ingredient;
use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use src\utils\Authentification ;

class CommandeController extends AbstractController{

  public function add($req, $resp, $args, $parsedBody){

    $commande = new Commande();
    $commande->montant = 0;
    $commande->date_de_livraison = date('Y-m-d', strtotime($parsedBody['date_de_livraison']));
    $commande->etat = CREATED;
    $commande->token = (new \RandomLib\Factory)->getMediumStrengthGenerator()->generateString(32);

    $commande->save();
    $commande->self = $this->request->router->PathFor('commande', ['id' => $commande->id]);
    return $this->responseJSON(201, $commande);

  }

  public function detailCommande($resp, $id){
      try{
          $commande = Commande::findOrFail($id);

          if($commande->etat != "livrée"){
              $nom_lien = "lien_de_suppression";
              $lien = DIR."/commandes/$commande->id/delete";
          }else{
              $nom_lien = "lien_de_la_facture";
              $lien = DIR."/commandes/$commande->id/facture";
          }

          $links = [
                    "sandwichs" => DIR."/commandes/$commande->id/sandwichs",
                    $nom_lien => $lien
                   ];

          $chaine = [
                    "id" => $commande->id,
                    "montant" => $commande->montant,
                    "date_de_livraison" => $commande->date_de_livraison,
                    "etat" => $commande->etat,
                    "links" => $links
                  ];
        return $this->responseJSON(200, $chaine);
      }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $chaine = ["Erreur", "Ressource de la commande $id introuvable."];
            return $this->responseJSON(404, $chaine);
      }
  }

  public function sandwichsByCommande($resp, $id){
      try{
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
            return $this->responseJSON(200, $chaine);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $chaine = ["Erreur", "Ressource de la commande $id introuvable."];
            return $this->responseJSON(400, $chaine);
        }
  }



public function listCommandes()
  {
      $commandes = Commande::orderBy('date_de_livraison','desc')
                            ->orderBy('date_de_creation','desc')
                            ->get();
      $result = $this->request->response->withStatus(200)->withHeader('Content-Type','application/json');
      $result->getBody()->write(json_encode($commandes));
      return $result;
  }

  public function filtrageCommandes($req, $res, $etat, $date)
  {
      if(!Authentification::checkTOKEN($req)){
            return $this->responseJSON(401, ["error" => "acces dined"]);
      }

      if(!isset($etat))
      {
          if(!isset($date))
              return $this->responseJSON(200, $this->listCommandes());
          else
              return $this->responseJSON(200, Commande::where('date_de_livraison','=',$date)->get());
      }
      else
      {
          if(!isset($date))
              return $this->responseJSON(200,Commande::where('etat','=',$etat)->get());

          $date = date('Y-m-d', strtotime($date));
          return $this->responseJSON(200, Commande::where('etat','=',$etat)->where('date_de_livraison','=',$date)->get());
      }

  }

    public function updateCommande($req, $resp, $args){
        if(!Authentification::checkTOKEN($req)){
            return $this->responseJSON(401, ["Erreur" => "Acces Refusé"]);
        }

        try{
            $id = $args['id'];
            $commande = Commande::findOrFail($id);
            $new_date = $req->getParams()['date_de_livraison'];
            if ($commande->etat == CREATED) {
                $commande->date_de_livraison = $new_date;
                if ($commande->save()) {
                    $chaine = ["id" => $commande->id,
                        "montant" => $commande->montant,
                        "date_de_livraison" => $commande->date_de_livraison,
                        "etat" => "créée"
                    ];
                    $status = 200;
                } else {
                    $chaine = ["Erreur" => "Il y a eu une erreur dans l'execution de la requête"];
                    $status = 400;
                }
            } else {
                $chaine = ["Erreur" => "La commande a déjà été payée ou livrée"];
                $status = 400;
            }
        }catch(ModelNotFoundException $e){
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $status = 404;
        }
        return $this->responseJSON($status, $chaine);
    }

    public function deleteCommande($req, $resp, $args){
        if(!Authentification::checkTOKEN($req)){
            return $this->responseJSON(401, ["Erreur" => "Acces Refusé"]);
        }
        try {
            $id = $args['id'];
            $commande = Commande::findOrFail($id);
            if ($commande->etat == CREATED) {
                if ($commande->delete()) {
                    $chaine = ["Executé" => "La commande a été correctement supprimée"];
                    $status = 200;
                } else {
                    $chaine = ["Erreur" => "Il y a eu une erreur dans l'execution de la requête"];
                    $status = 400;
                }
            }else{
                $chaine = ["Erreur" => "La commande a déjà été payée ou livrée"];
                $status = 400;
            }
        } catch (ModelNotFoundException $e) {
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $status = 404;
        }
        return $this->responseJSON($status, $chaine);
    }

    public function payCommande($req, $resp, $args){
        if(!Authentification::checkTOKEN($req)){
            return $this->responseJSON(401, ["Erreur" => "Acces Refusé"]);
        }

        try {
            $id = $args['id'];
            $params = $req->getParams();
            $commande = Commande::findOrFail($id);

            if ($commande->etat == CREATED) {
                $num_carte = $params['num_carte'];
                $date_validite = $params['date_validite'];
                $key = $params['key'];
                $commande->etat = PAID;
                if ($commande->save()) {
                    $chaine = ["Executé" => "La commande a été payée"];
                    $status = 200;
                }else {
                    $chaine = ["Erreur" => "Le paiement à échoué"];
                    $status = 400;
                }
            } else{
                $chaine = ["Erreur" => "La commande est déjà été payée ou livrée"];
                $status = 400;
            }
        } catch (ModelNotFoundException $e) {
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $status = 404;
        }
        return $this->responseJSON($status, $chaine);
    }

    public function factureCommande($req, $resp, $args){
        if(!Authentification::checkTOKEN($req)){
            return $this->responseJSON(401, ["Erreur" => "Acces Refusé"]);
        }

        try {
            $sandwichs_tab = [];
            $id = $args['id'];
            $commande = Commande::findOrFail($id);
            $sandwichs = Sandwich::where('id_commande', $id)->with('ingredients')->get();
            $nb_sandwichs = $sandwichs->count();
            foreach ($sandwichs as $sandwich) {
                $ingredients_tab = [];
                $ingredients = $sandwich->ingredient;
                foreach ($ingredients as $ingredient) {
                    array_push($ingredients_tab, $ingredient->nom);
                }
                array_push($sandwichs_tab, [
                    "type_de_pain" => $sandwich->type_de_pain,
                    "taille" => $sandwich->taille,
                    "ingredients" => $ingredients_tab
                ]);
            }

            // TODO: MONTANT POUR 1 SANDWICH

            if ($commande->etat == DELIVRED) {
                $chaine = [
                    "montant" => $commande->montant,
                    "date_de_livraison" => $commande->date_de_livraison,
                    "nombre_de_sandwichs" => $nb_sandwichs,
                    "sandwich" => $sandwichs_tab
                ];
                $status = 200;
            } else{
                $chaine = ["Erreur" => "Impossible d'obtenir une facture, la commande n'a pas encore été livrée"];
                $status = 400;
            }
        } catch (ModelNotFoundException $e) {
            $chaine = ["Erreur" => "La commande est introuvable ou n'existe pas"];
            $status = 404;
        }
        return $this->responseJSON($status, $chaine);
    }
}
