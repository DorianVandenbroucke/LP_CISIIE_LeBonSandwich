/** apidoc -i input/ -o doc/ -t template/
* @apiGroup Categories
* @apiName listCategories
* @apiVersion 0.1.0
*
* @api {get} /categories[/]  Afficher
*
* @apiDescription On affiche une collection des catégories
*
* Retourne une représentation json des ressources
*
* Le résultat inclut un lien pour accéder à la catégorie.
*
*
*
* @apiSuccess (Succès : 200) {Number} nombre_de_categories Nombre de catégories dans la base
* @apiSuccess (Succès : 200) {Array} categories Tableau contenant les informations de chaque catégories
* @apiSuccess (Succès : 200) {String} nom Nom de la catégorie
* @apiSuccess (Succès : 200) {Link}   links Lien vers la catégorie
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "nombre_de_categories": 2,
*      "categories": [
*        {
*          "nom": "crudités",
*          "lien": "/categories/2/"
*        },
*        {
*            ...
*        }
*      ]
*    }
*/

/**
* @apiGroup Categories
* @apiName detailCategory
* @apiVersion 0.1.0
*
* @api {get} /categories/{id}[/]  Détail
*
* @apiDescription On affiche le détail d'une catégorie
*
* Retourne une représentation json de la ressource
*
* Le résultat inclut un lien pour accéder à la liste des ingrédients de cette catégorie.
*
* @apiParam {Number} id Identifiant unique de la catégorie
*
*
* @apiSuccess (Succès : 200) {Number} id Identifiant de la catégorie
* @apiSuccess (Succès : 200) {String} nom Nom de la catégorie
* @apiSuccess (Succès : 200) {String} description Description de la catégorie
* @apiSuccess (Succès : 200) {Link}   links Lien vers la liste des ingrédients de la catégorie
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "id": 1,
*      "nom": "salades",
*      "description": "Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux",
*      "links": {
*        "ingredients": "/categories/1/ingredients/"
*      }
*    }
*
* @apiError (Erreur : 404) CategorieNotFound Categorie inexistante
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 404 Not Found
*
*    {
*      "error": "Categorie d'ingrédients 56 introuvable."
*    }
*/

/**
* @apiGroup Categories
* @apiName ingredientsByCategorie
* @apiVersion 0.1.0
*
* @api {get} /categories/{id}/ingredients[/]  Ingredients
*
* @apiDescription On affiche une collection d'ingredients
* appartenant à une catégorie donnée
*
* Retourne une représentation json de la ressource
*
* Le résultat inclut un lien pour accéder à l'ingrédient que l'on souhaite
*
* @apiParam {Number} id Identifiant unique de la catégorie
*
*
* @apiSuccess (Succès : 200) {Number} nombre_d_ingredient Nombre d'ingrédients dans la catégorie
* @apiSuccess (Succès : 200) {Array} ingredients Tableau contenant les informations de l'ingrédient
* @apiSuccess (Succès : 200) {Number} id Id de l'ingrédient
* @apiSuccess (Succès : 200) {String} nom Nom de la catégorie
* @apiSuccess (Succès : 200) {Number} cat_id Id de la catégorie
* @apiSuccess (Succès : 200) {String} description Description de l'ingrédient
* @apiSuccess (Succès : 200) {String} fournisseur Nom du fournisseur de l'ingrédient
* @apiSuccess (Succès : 200) {Link}   links Lien vers le détail de l'ingrédient
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "nombre_d_ingredient": 2,
*      "ingredients": [
*        {
*          "id": 1,
*          "nom": "laitue",
*          "cat_id": 1,
*          "description": "belle laitue verte",
*          "fournisseur": "ferme \"la bonne salade\"",
*          "img": null,
*          "link": {
*            "detail": "/ingredients/1/"
*          }
*        },
*        {
*            ...
*        }
*    }
*
* @apiError (Erreur : 404) CategorieNotFound Categorie inexistante
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 404 Not Found
*
*    {
*      "error": "Categorie d'ingrédients 456 introuvable."
*    }
*/

/**
* @apiGroup Ingredients
* @apiName listIngredients
* @apiVersion 0.1.0
*
* @api {get} /ingredients[/]  Afficher
*
* @apiDescription On affiche les ingrédients
*
* Retourne une représentation json de la ressource
*
* Le résultat inclut un lien pour accéder à l'ingrédient que l'on souhaite
*
*
* @apiSuccess (Succès : 200) {Array} ingredients Tableau contenant les informations de l'ingrédient
* @apiSuccess (Succès : 200) {Number} id Id de l'ingrédient
* @apiSuccess (Succès : 200) {String} nom Nom de la catégorie
* @apiSuccess (Succès : 200) {Number} cat_id Id de la catégorie
* @apiSuccess (Succès : 200) {String} description Description de l'ingrédient
* @apiSuccess (Succès : 200) {String} fournisseur Nom du fournisseur de l'ingrédient
* @apiSuccess (Succès : 200) {Link}   links Lien vers le détail de l'ingrédient
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "ingredients": [
*        {
*          "id": 1,
*          "nom": "laitue",
*          "cat_id": 1,
*          "description": "belle laitue verte",
*          "fournisseur": "ferme \"la bonne salade\"",
*          "img": null,
*          "link": {
*            "detail": "/ingredients/1/"
*          }
*        },
*        {
*            ...
*        }
*    }
*
* @apiError (Erreur : 403) Forbidden Accès interdit
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "Access denied"
*    }
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "No username or password"
*    }
*/

/**
* @apiGroup Ingredients
* @apiName addIngredient
* @apiVersion 0.1.0
*
* @api {post} /ingredients[/]  Ajouter
*
* @apiDescription On ajoute un ingrédient
*
* Retourne une représentation json de la ressource
*
* @apiParam (Paramètres requis) {String} nom Nom de la catégorie
* @apiParam (Paramètres requis) {Number} cat_id Id de la catégorie
* @apiParam (Paramètres requis) {String} description Description de l'ingrédient
* @apiParam (Paramètres requis) {String} fournisseur Nom du fournisseur de l'ingrédient
*
* @apiError (Erreur : 403) Forbidden Accès interdit
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "Access denied"
*    }
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "No username or password"
*    }
*/

/**
* @apiGroup Ingredients
* @apiName getIngredient
* @apiVersion 0.1.0
*
* @api {get} /ingredients/{id}[/]  Détail
*
* @apiDescription On affiche le détail d'un ingrédient
*
* Retourne une représentation json de la ressource
*
* Le résultat inclut un lien pour accéder à la catégorie dans laquelle se trouve l'ingrédient
*
* @apiParam {Number} id Id de l'ingrédient
*
* @apiSuccess (Succès : 200) {Array} ingredients Tableau contenant les informations de l'ingrédient
* @apiSuccess (Succès : 200) {String} nom Nom de l'ingrédient
* @apiSuccess (Succès : 200) {String} description Description de l'ingrédient
* @apiSuccess (Succès : 200) {String} fournisseur Nom du fournisseur de l'ingrédient
* @apiSuccess (Succès : 200) {Array} categorie Tableau contenant les informations de la catégorie de l'ingrédient
* @apiSuccess (Succès : 200) {Link} categorie_link Lien vers la catégorie
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "ingredient": {
*        "nom": "laitue",
*        "description": "belle laitue verte",
*        "fournisseur": "ferme \"la bonne salade\"",
*        "img": null,
*        "categorie": [
*          {
*            "nom": "salades",
*            "description": "Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux"
*          }
*        ]
*      },
*      "categorie_link": "/ingredients/1/categorie/"
*    }
*
* @apiError (Erreur : 404) NotFound Ingrédient inexistant
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 404 Not Found
*
*    {
*      "Error": "Ingredient 56 introuvable"
*    }
*
*/

/**
* @apiGroup Ingredients
* @apiName deleteIngredient
* @apiVersion 0.1.0
*
* @api {delete} /ingredients/{id}[/]  Supprimer
*
* @apiDescription On supprime un ingrédient
*
* @apiParam {Number} id Id de l'ingrédient
*
* @apiError (Erreur : 403) Forbidden Accès interdit
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "Access denied"
*    }
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "No username or password"
*    }
*
*/

/**
* @apiGroup Ingredients
* @apiName updateIngredient
* @apiVersion 0.1.0
*
* @api {put} /ingredients/{id}[/]  Modifier
*
* @apiDescription On modifie un ingrédient
*
* Retourne une représentation json de la ressource modifiée
*
* @apiParam (Paramètres possible) {String} nom Nom de la catégorie
* @apiParam (Paramètres possible) {Number} cat_id Id de la catégorie
* @apiParam (Paramètres possible) {String} description Description de l'ingrédient
* @apiParam (Paramètres possible) {String} fournisseur Nom du fournisseur de l'ingrédient
*
* @apiError (Erreur : 403) Forbidden Accès interdit
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "Access denied"
*    }
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "No username or password"
*    }
*
*/

/**
* @apiGroup Ingredients
* @apiName getCategorie
* @apiVersion 0.1.0
*
* @api {get} /ingredients/{id}/categorie[/]  Catégorie
*
* @apiDescription On obtient la catégorie de l'ingrédient
*
* Retourne une représentation json de la ressource
*
* @apiParam {Number} id Id de l'ingrédient
*
* @apiSuccess (Succès : 200) {String} nom Nom de la catégorie
* @apiSuccess (Succès : 200) {String} description Description de l'ingrédient
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "nom": "salades",
*      "description": "Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux"
*    }
*
*/

/**
* @apiGroup Commande
* @apiName detailCommande
* @apiVersion 0.1.0
*
* @api {get} /commandes/{id}[/]  Détail
*
* @apiDescription On obtient le détail de la commande
*
* Retourne une représentation json de la ressource
*
* @apiParam {Number} id Id de la commande
*
* @apiSuccess (Succès : 200) {Number} id Date de livraison de la commande
* @apiSuccess (Succès : 200) {Number} montant Montant de la commande
* @apiSuccess (Succès : 200) {String} date_de_livraison Date de livraison de la commande
* @apiSuccess (Succès : 200) {Number} etat Etat de la commande
* @apiSuccess (Succès : 200) {Array} links Tableau contenant les liens de la commande
* @apiSuccess (Succès : 200) {Link} sandwichs Lien pour accèder aux sandwichs de la commande
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "id": 1,
*      "montant": 58,
*      "date_de_livraison": "2003-02-02",
*      "etat": "1",
*      "links": {
*        "sandwichs": "/commandes/1/sandwichs"
*      }
*    }
*
* @apiError (Erreur : 403) Forbidden Accès interdit
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "No token"
*    }
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 403 Forbidden
*
*    {
*      "Error": "Invalid token"
*    }
*
*/

/**
* @apiGroup Commande
* @apiName add
* @apiVersion 0.1.0
*
* @api {post} /commandes[/]  Ajouter
*
* @apiDescription On crée une commande
*
* @apiSuccess (Succès : 201) {Number} montant Montant de la commande
* @apiSuccess (Succès : 201) {String} date_de_livraison Date de livraison de la commande
* @apiSuccess (Succès : 201) {Number} etat Etat de la commande
* @apiSuccess (Succès : 201) {String} token Token lié à la commande
* @apiSuccess (Succès : 201) {Number} id Id de la commande
* @apiSuccess (Succès : 201) {Link} links Lien pour accèder à la commande
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 201 Created
*    {
*      "montant": 0,
*      "date_de_livraison": "2017-02-21",
*      "etat": 1,
*      "token": "tc8LzKxNHaPcQEukS+4go9ChXK8X4HZX",
*      "id": 4,
*      "link": {
*        "self": "/commandes/4/"
*      }
*    }
*
*/

/**
* @apiGroup Commande
* @apiName updateCommande
* @apiVersion 0.1.0
*
* @api {put} /commandes/{id}[/]  Modifier
*
* @apiDescription On modifie la date de livraison d'une commande si celle-ci n'est pas encore payée
*
* Retourne une représentation json de la ressource
*
* @apiParam (Paramètre requis) {String} date_de_livraison Date de livraison de la commande
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*
*    {
*      "id": 1,
*      "montant": 58,
*      "date_de_livraison": "2015-11-11",
*      "etat": "créée"
*    }
*
* @apiError (Erreur : 404) NotFound Ressource inconnue
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 404 NotFound
*
*    {
*      "Erreur": "La commande est introuvable ou n'existe pas"
*    }
*
* @apiError (Erreur : 400) BadRequest Requete invalide
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 400 BadRequest
*
*    {
*      "Erreur": "La commande a déjà été payée ou livrée"
*    }
*
*
*/

/**
* @apiGroup Commande
* @apiName deleteCommande
* @apiVersion 0.1.0
*
* @api {delete} /commandes/{id}[/]  Supprimer
*
* @apiDescription On supprime une commande si celle-ci n'est pas encore payée
*
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*    {
*      "Success": "La commande a été correctement supprimée"
*    }
*
*/

/**
* @apiGroup Commande
* @apiName payCommande
* @apiVersion 0.1.0
*
* @api {post} /commandes/{id}/paiement[/]  Payer
*
* @apiDescription On paye une commande si celle-ci n'est pas encore payée
*
* Retourne une représentation json de la ressource
*
* @apiParam (Paramètres requis) {Number} num_carte Numéro de la carte
* @apiParam (Paramètres requis) {Number} date_validite Validité de la carte
* @apiParam (Paramètres requis) {Number} key Cryptogramme de la carte
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*    {
*      "Success": "La commande a été payée"
*    }
*
* @apiError (Erreur : 404) NotFound Ressource inconnue
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 404 NotFound
*
*    {
*      "Erreur": "La commande est introuvable ou n'existe pas"
*    }
*
* @apiError (Erreur : 400) BadRequest Requete invalide
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 400 BadRequest
*
*    {
*      "Erreur": "La commande a déjà été payée ou livrée"
*    }
*
*/

/**
* @apiGroup Commande
* @apiName factureCommande
* @apiVersion 0.1.0
*
* @api {get} /commandes/{id}/facture[/]  Facture
*
* @apiDescription On paye une commande si celle-ci n'est pas encore payée
*
* Retourne une représentation json de la ressource
*
* @apiSuccess (Succès : 200) {Number} montant Montant de la commande
* @apiSuccess (Succès : 200) {String} date_de_livraison Date de livraison de la commande
* @apiSuccess (Succès : 200) {Number} nombre_de_sandwichs Nombre de sandwichs dans la commande
* @apiSuccess (Succès : 200) {Array} sandwich Tableau contenant les sandwichs de la commande
*
* @apiSuccessExample {json} Exemple de réponse en cas de succès
*     HTTP/1.1 200 OK
*    {
*      "montant": 58,
*      "date_de_livraison": "2016-12-27",
*      "nombre_de_sandwichs": 2,
*      "sandwich": [
*        {
*          "type_de_pain": "blanc",
*          "taille": "456cm",
*          "ingredients": []
*        },
*        {
*          ...
*        }
*      ]
*    }
*
* @apiError (Erreur : 404) NotFound Ressource inconnue
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 404 NotFound
*
*    {
*      "Erreur": "La commande est introuvable ou n'existe pas"
*    }
*
* @apiError (Erreur : 400) BadRequest Requete invalide
*
* @apiErrorExample {json} Exemple de réponse en cas d'erreur
*     HTTP/1.1 400 BadRequest
*
*    {
*      "Erreur": "Impossible d'obtenir une facture, la commande n'a pas encore été livrée"
*    }
*
*/

/**
* @apiGroup Commande
* @apiName sandwichsByCommande
* @apiVersion 0.1.0
*
* @api {get} /commandes/{id}/sandwichs[/]  Sandwich
*
* @apiDescription On affiche les sandwichs d'une commande
*
* Retourne une représentation json de la ressource
*
*/

/**
* @apiGroup Sandwichs
* @apiName add
* @apiVersion 0.1.0
*
* @api {post} /commandes/{id}/sandwichs[/]  Ajouter
*
* @apiDescription On ajoute un sandwich à une commande
*
* Retourne une représentation json de la ressource
*
*/

/**
* @apiGroup Sandwichs
* @apiName delete
* @apiVersion 0.1.0
*
* @api {delete} /commandes/{id}/sandwichs[/]  Supprimer
*
* @apiDescription On ajoute un sandwich à une commande
*
* Retourne une représentation json de la ressource
*
*/

/**
* @apiGroup Sandwichs
* @apiName modifyIngredient
* @apiVersion 0.1.0
*
* @api {put} /commandes/sandwichs/{id_sandwich}/ingredients/{id_ingredient}[/]  Modifier
*
* @apiDescription On ajoute ou supprime un ingrédient dans un sandwich si celui-ci existe déjà
*
* Retourne une représentation json de la ressource
*
*/

/**
* @apiGroup Sandwichs
* @apiName modifySandwich
* @apiVersion 0.1.0
*
* @api {put} /commandes/{id_commande}/sandwichs/{id_sandwich}[/]  Modifier
*
* @apiDescription On fait quelque chose mais c'est pas encore défini parce que c'est pas fini
*
* Retourne une représentation json de la ressource
*
*/
