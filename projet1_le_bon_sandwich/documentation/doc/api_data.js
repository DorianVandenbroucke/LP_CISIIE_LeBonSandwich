define({ "api": [
  {
    "group": "Categories",
    "name": "detailCategory",
    "version": "0.1.0",
    "type": "get",
    "url": "/categories/{id}[/]",
    "title": "Accès à une catégorie",
    "description": "<p>Accès à une ressource de type catégorie permet d'accéder à la représentation de la ressource categorie désignée. Retourne une représentation json de la ressource, incluant son nom et sa description.</p> <p>Le résultat inclut un lien pour accéder à la liste des ingrédients de cette catégorie.</p>",
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
            "description": "<p>lien vers la liste des ingrédients de la catégorie</p>"
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
  }
] });
