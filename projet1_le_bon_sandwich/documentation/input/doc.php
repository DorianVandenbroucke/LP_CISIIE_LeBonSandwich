/**
* @apiGroup Categories
* @apiName detailCategory
* @apiVersion 0.1.0
*
* @api {get} /categories/{id}[/]  Accès à une catégorie
*
* @apiDescription Accès à une ressource de type catégorie
* permet d'accéder à la représentation de la ressource categorie désignée.
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
* @apiSuccess (Succès : 200) {Link}   links lien vers la liste des ingrédients de la catégorie
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
