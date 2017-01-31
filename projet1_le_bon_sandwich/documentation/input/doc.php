/**
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
*          "lien": "/LP/Prog_Web-Serveur/Projet/LeBonSandwich/projet1_le_bon_sandwich/api/api.php/categories/2/"
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
*            "detail": "/LP/Prog_Web-Serveur/Projet/LeBonSandwich/projet1_le_bon_sandwich/api/api.php/ingredients/1/"
*          }
*        },
*        {
*            ...
*        }
*    {
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
* Retourne une représentation json de la ressource
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
* Retourne une représentation json de la ressource
*
*/

/**
* @apiGroup Commande
* @apiName payCommande
* @apiVersion 0.1.0
*
* @api {post} /commandes/{id}[/]  Payer
*
* @apiDescription On paye une commande si celle-ci n'est pas encore payée
*
* Retourne une représentation json de la ressource
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
