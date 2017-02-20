<?php

namespace src\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use src\models\Ingredient;
use src\models\Categorie;
use src\models\Taille as Taille;


class DashBoardController extends AbstractController
{
    public function ListIngredients(Request $req, Response $resp, $args)
    {
        $categories = Categorie::with('getIngredients')->get();
        return $this->request->view->render($resp, 'commandes.html', ["categories"=>$categories]);
    }

    public function modifierTaille(Request $req, Response $resp, $args, $requestbody){
        
        $id_taille = $args["id"];
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
        var_dump($requestbody);
        $taille->save();
        

        return $this->request->view->render($resp, 'modifierTaille.html', ["taille"=>$taille]);

      
    }
}
