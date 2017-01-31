/**
* @apiGroup Categories
* @apiName listCategories
* @apiVersion 0.1.0
*
* @api {get} /categories[/]  Afficher
*
* @apiDescription On affiche une collection des catégories
*
* Retourne une représentation json des ressources, incluant le nombre de catégories
* leur noms.
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
* Retourne une représentation json de la ressource, incluant son nom et
* sa description.
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
* Retourne une représentation json de la ressource, incluant le nombre d'ingrédients
* présent dans la base, leur id, nom, cat_id, description, fournisseur et image associée
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
