define({ "api": [
  {
    "group": "Categories",
    "name": "detailCategory",
    "version": "0.1.0",
    "type": "get",
    "url": "/categories/{id}[/]",
    "title": "Détail",
    "description": "<p>On affiche le détail d'une catégorie</p> <p>Retourne une représentation json de la ressource</p> <p>Le résultat inclut un lien pour accéder à la liste des ingrédients de cette catégorie.</p>",
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
    "description": "<p>On affiche une collection d'ingredients appartenant à une catégorie donnée</p> <p>Retourne une représentation json de la ressource</p> <p>Le résultat inclut un lien pour accéder à l'ingrédient que l'on souhaite</p>",
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
    "description": "<p>On affiche une collection des catégories</p> <p>Retourne une représentation json des ressources</p> <p>Le résultat inclut un lien pour accéder à la catégorie.</p>",
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
  },
  {
    "group": "Commande",
    "name": "add",
    "version": "0.1.0",
    "type": "post",
    "url": "/commandes[/]",
    "title": "Ajouter",
    "description": "<p>On crée une commande</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "deleteCommande",
    "version": "0.1.0",
    "type": "delete",
    "url": "/commandes/{id}[/]",
    "title": "Supprimer",
    "description": "<p>On supprime une commande si celle-ci n'est pas encore payée</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "detailCommande",
    "version": "0.1.0",
    "type": "get",
    "url": "/commandes/{id}[/]",
    "title": "Détail",
    "description": "<p>On obtient le détail de la commande</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "factureCommande",
    "version": "0.1.0",
    "type": "get",
    "url": "/commandes/{id}/facture[/]",
    "title": "Facture",
    "description": "<p>On paye une commande si celle-ci n'est pas encore payée</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "payCommande",
    "version": "0.1.0",
    "type": "post",
    "url": "/commandes/{id}[/]",
    "title": "Payer",
    "description": "<p>On paye une commande si celle-ci n'est pas encore payée</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "sandwichsByCommande",
    "version": "0.1.0",
    "type": "get",
    "url": "/commandes/{id}/sandwichs[/]",
    "title": "Sandwich",
    "description": "<p>On affiche les sandwichs d'une commande</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "updateCommande",
    "version": "0.1.0",
    "type": "put",
    "url": "/commandes/{id}[/]",
    "title": "Modifier",
    "description": "<p>On modifie la date de livraison d'une commande si celle-ci n'est pas encore payée</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Ingredients",
    "name": "addIngredient",
    "version": "0.1.0",
    "type": "post",
    "url": "/ingredients[/]",
    "title": "Ajouter",
    "description": "<p>On ajoute un ingrédient</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Ingredients"
  },
  {
    "group": "Ingredients",
    "name": "deleteIngredient",
    "version": "0.1.0",
    "type": "delete",
    "url": "/ingredients/{id}[/]",
    "title": "Supprimer",
    "description": "<p>On supprime un ingrédient</p>",
    "filename": "input/doc.php",
    "groupTitle": "Ingredients"
  },
  {
    "group": "Ingredients",
    "name": "getCategorie",
    "version": "0.1.0",
    "type": "get",
    "url": "/ingredients/{id}/categorie[/]",
    "title": "Catégorie",
    "description": "<p>On obtient la catégorie de l'ingrédient</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Ingredients"
  },
  {
    "group": "Ingredients",
    "name": "getIngredient",
    "version": "0.1.0",
    "type": "get",
    "url": "/ingredients/{id}[/]",
    "title": "Détail",
    "description": "<p>On affiche le détail d'un ingrédient</p> <p>Retourne une représentation json de la ressource</p> <p>Le résultat inclut un lien pour accéder à la catégorie dans laquelle se trouve l'ingrédient</p>",
    "filename": "input/doc.php",
    "groupTitle": "Ingredients"
  },
  {
    "group": "Ingredients",
    "name": "listIngredients",
    "version": "0.1.0",
    "type": "get",
    "url": "/ingredients[/]",
    "title": "Afficher",
    "description": "<p>On affiche les ingrédients</p> <p>Retourne une représentation json de la ressource</p> <p>Le résultat inclut un lien pour accéder à l'ingrédient que l'on souhaite</p>",
    "filename": "input/doc.php",
    "groupTitle": "Ingredients"
  },
  {
    "group": "Ingredients",
    "name": "updateIngredient",
    "version": "0.1.0",
    "type": "put",
    "url": "/ingredients/{id}[/]",
    "title": "Modifier",
    "description": "<p>On modifie un ingrédient</p> <p>Retourne une représentation json de la ressource modifiée</p>",
    "filename": "input/doc.php",
    "groupTitle": "Ingredients"
  },
  {
    "group": "Sandwichs",
    "name": "add",
    "version": "0.1.0",
    "type": "post",
    "url": "/commandes/{id}/sandwichs[/]",
    "title": "Ajouter",
    "description": "<p>On ajoute un sandwich à une commande</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Sandwichs"
  },
  {
    "group": "Sandwichs",
    "name": "delete",
    "version": "0.1.0",
    "type": "delete",
    "url": "/commandes/{id}/sandwichs[/]",
    "title": "Supprimer",
    "description": "<p>On ajoute un sandwich à une commande</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Sandwichs"
  },
  {
    "group": "Sandwichs",
    "name": "modifyIngredient",
    "version": "0.1.0",
    "type": "put",
    "url": "/commandes/sandwichs/{id_sandwich}/ingredients/{id_ingredient}[/]",
    "title": "Modifier",
    "description": "<p>On ajoute ou supprime un ingrédient dans un sandwich si celui-ci existe déjà</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Sandwichs"
  },
  {
    "group": "Sandwichs",
    "name": "modifySandwich",
    "version": "0.1.0",
    "type": "put",
    "url": "/commandes/{id_commande}/sandwichs/{id_sandwich}[/]",
    "title": "Modifier",
    "description": "<p>On fait quelque chose mais c'est pas encore défini parce que c'est pas fini</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Sandwichs"
  }
] });
