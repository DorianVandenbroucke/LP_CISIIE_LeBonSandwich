define({ "api": [
  {
    "group": "Categories",
    "name": "detailCategory",
    "version": "0.1.0",
    "type": "get",
    "url": "/categories/{id}[/]",
    "title": "Détail",
    "description": "<p>On affiche le détail d'une catégorie</p> <p>Retourne une représentation json de la ressource, incluant son nom et sa description.</p> <p>Le résultat inclut un lien pour accéder à la liste des ingrédients de cette catégorie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links",
            "description": "<p>Lien vers la liste des ingrédients de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"id\": 1,\n  \"nom\": \"salades\",\n  \"description\": \"Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux\",\n  \"links\": {\n    \"ingredients\": \"/categories/1/ingredients/\"\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "CategorieNotFound",
            "description": "<p>Categorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 Not Found\n\n{\n  \"error\": \"Categorie d'ingrédients 56 introuvable.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/doc.php",
    "groupTitle": "Categories"
  },
  {
    "group": "Categories",
    "name": "ingredientsByCategorie",
    "version": "0.1.0",
    "type": "get",
    "url": "/categories/{id}/ingredients[/]",
    "title": "Ingredients",
    "description": "<p>On affiche une collection d'ingredients appartenant à une catégorie donnée</p> <p>Retourne une représentation json de la ressource, incluant le nombre d'ingrédients présent dans la base, leur id, nom, cat_id, description, fournisseur et image associée</p> <p>Le résultat inclut un lien pour accéder à l'ingrédient que l'on souhaite</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "nombre_d_ingredient",
            "description": "<p>Nombre d'ingrédients dans la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "ingredients",
            "description": "<p>Tableau contenant les informations de l'ingrédient</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de l'ingrédient</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "cat_id",
            "description": "<p>Id de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de l'ingrédient</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "fournisseur",
            "description": "<p>Nom du fournisseur de l'ingrédient</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links",
            "description": "<p>Lien vers le détail de l'ingrédient</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"nombre_d_ingredient\": 2,\n  \"ingredients\": [\n    {\n      \"id\": 1,\n      \"nom\": \"laitue\",\n      \"cat_id\": 1,\n      \"description\": \"belle laitue verte\",\n      \"fournisseur\": \"ferme \\\"la bonne salade\\\"\",\n      \"img\": null,\n      \"link\": {\n        \"detail\": \"/LP/Prog_Web-Serveur/Projet/LeBonSandwich/projet1_le_bon_sandwich/api/api.php/ingredients/1/\"\n      }\n    },\n    {\n        ...\n    }\n{",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "CategorieNotFound",
            "description": "<p>Categorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 Not Found\n\n{\n  \"error\": \"Categorie d'ingrédients 456 introuvable.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/doc.php",
    "groupTitle": "Categories"
  },
  {
    "group": "Categories",
    "name": "listCategories",
    "version": "0.1.0",
    "type": "get",
    "url": "/categories[/]",
    "title": "Afficher",
    "description": "<p>On affiche une collection des catégories</p> <p>Retourne une représentation json des ressources, incluant le nombre de catégories leur noms.</p> <p>Le résultat inclut un lien pour accéder à la catégorie.</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "nombre_de_categories",
            "description": "<p>Nombre de catégories dans la base</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "categories",
            "description": "<p>Tableau contenant les informations de chaque catégories</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links",
            "description": "<p>Lien vers la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"nombre_de_categories\": 2,\n  \"categories\": [\n    {\n      \"nom\": \"crudités\",\n      \"lien\": \"/LP/Prog_Web-Serveur/Projet/LeBonSandwich/projet1_le_bon_sandwich/api/api.php/categories/2/\"\n    },\n    {\n        ...\n    }\n  ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/doc.php",
    "groupTitle": "Categories"
  }
] });
