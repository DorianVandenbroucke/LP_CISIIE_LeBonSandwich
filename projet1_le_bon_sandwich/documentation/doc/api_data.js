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
          "content": " HTTP/1.1 200 OK\n\n{\n  \"nombre_d_ingredient\": 2,\n  \"ingredients\": [\n    {\n      \"id\": 1,\n      \"nom\": \"laitue\",\n      \"cat_id\": 1,\n      \"description\": \"belle laitue verte\",\n      \"fournisseur\": \"ferme \\\"la bonne salade\\\"\",\n      \"img\": null,\n      \"link\": {\n        \"detail\": \"/ingredients/1/\"\n      }\n    },\n    {\n        ...\n    }\n}",
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
          "content": " HTTP/1.1 200 OK\n\n{\n  \"nombre_de_categories\": 2,\n  \"categories\": [\n    {\n      \"nom\": \"crudités\",\n      \"lien\": \"/categories/2/\"\n    },\n    {\n        ...\n    }\n  ]\n}",
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
    "description": "<p>On crée une commande</p>",
    "success": {
      "fields": {
        "Succès : 201": [
          {
            "group": "Succès : 201",
            "type": "Number",
            "optional": false,
            "field": "montant",
            "description": "<p>Montant de la commande</p>"
          },
          {
            "group": "Succès : 201",
            "type": "String",
            "optional": false,
            "field": "date_de_livraison",
            "description": "<p>Date de livraison de la commande</p>"
          },
          {
            "group": "Succès : 201",
            "type": "Number",
            "optional": false,
            "field": "etat",
            "description": "<p>Etat de la commande</p>"
          },
          {
            "group": "Succès : 201",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token lié à la commande</p>"
          },
          {
            "group": "Succès : 201",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de la commande</p>"
          },
          {
            "group": "Succès : 201",
            "type": "Link",
            "optional": false,
            "field": "links",
            "description": "<p>Lien pour accèder à la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 201 Created\n{\n  \"montant\": 0,\n  \"date_de_livraison\": \"2017-02-21\",\n  \"etat\": 1,\n  \"token\": \"tc8LzKxNHaPcQEukS+4go9ChXK8X4HZX\",\n  \"id\": 4,\n  \"link\": {\n    \"self\": \"/commandes/4/\"\n  }\n}",
          "type": "json"
        }
      ]
    },
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
    "description": "<p>On supprime une commande si celle-ci n'est pas encore payée</p>",
    "success": {
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n{\n  \"Success\": \"La commande a été correctement supprimée\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de la commande</p>"
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
            "description": "<p>Date de livraison de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "montant",
            "description": "<p>Montant de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "date_de_livraison",
            "description": "<p>Date de livraison de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "etat",
            "description": "<p>Etat de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "links",
            "description": "<p>Tableau contenant les liens de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "sandwichs",
            "description": "<p>Lien pour accèder aux sandwichs de la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"id\": 1,\n  \"montant\": 58,\n  \"date_de_livraison\": \"2003-02-02\",\n  \"etat\": \"1\",\n  \"links\": {\n    \"sandwichs\": \"/commandes/1/sandwichs\"\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 403": [
          {
            "group": "Erreur : 403",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>Accès interdit</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"No token\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"Invalid token\"\n}",
          "type": "json"
        }
      ]
    },
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
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "montant",
            "description": "<p>Montant de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "date_de_livraison",
            "description": "<p>Date de livraison de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "nombre_de_sandwichs",
            "description": "<p>Nombre de sandwichs dans la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "sandwich",
            "description": "<p>Tableau contenant les sandwichs de la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n{\n  \"montant\": 58,\n  \"date_de_livraison\": \"2016-12-27\",\n  \"nombre_de_sandwichs\": 2,\n  \"sandwich\": [\n    {\n      \"type_de_pain\": \"blanc\",\n      \"taille\": \"456cm\",\n      \"ingredients\": []\n    },\n    {\n      ...\n    }\n  ]\n}",
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
            "field": "NotFound",
            "description": "<p>Ressource inconnue</p>"
          }
        ],
        "Erreur : 400": [
          {
            "group": "Erreur : 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Requete invalide</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 NotFound\n\n{\n  \"Erreur\": \"La commande est introuvable ou n'existe pas\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 400 BadRequest\n\n{\n  \"Erreur\": \"Impossible d'obtenir une facture, la commande n'a pas encore été livrée\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "payCommande",
    "version": "0.1.0",
    "type": "post",
    "url": "/commandes/{id}/paiement[/]",
    "title": "Payer",
    "description": "<p>On paye une commande si celle-ci n'est pas encore payée</p> <p>Retourne une représentation json de la ressource</p>",
    "parameter": {
      "fields": {
        "Paramètres requis": [
          {
            "group": "Paramètres requis",
            "type": "Number",
            "optional": false,
            "field": "num_carte",
            "description": "<p>Numéro de la carte</p>"
          },
          {
            "group": "Paramètres requis",
            "type": "Number",
            "optional": false,
            "field": "date_validite",
            "description": "<p>Validité de la carte</p>"
          },
          {
            "group": "Paramètres requis",
            "type": "Number",
            "optional": false,
            "field": "key",
            "description": "<p>Cryptogramme de la carte</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n{\n  \"Success\": \"La commande a été payée\"\n}",
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
            "field": "NotFound",
            "description": "<p>Ressource inconnue</p>"
          }
        ],
        "Erreur : 400": [
          {
            "group": "Erreur : 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Requete invalide</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 NotFound\n\n{\n  \"Erreur\": \"La commande est introuvable ou n'existe pas\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 400 BadRequest\n\n{\n  \"Erreur\": \"La commande a déjà été payée ou livrée\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/doc.php",
    "groupTitle": "Commande"
  },
  {
    "group": "Commande",
    "name": "sandwichsByCommande",
    "version": "0.1.0",
    "type": "get",
    "url": "/commandes/{id}/sandwichs[/]",
    "title": "Sandwichs",
    "description": "<p>On affiche les sandwichs d'une commande</p> <p>Retourne une représentation json de la ressource</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "nb_sandwichs",
            "description": "<p>Nombre de sandwichs contenus dans la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "liens",
            "description": "<p>Tableau contenant les liens liés à la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "paiement",
            "description": "<p>Lien vers le paiement de la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n{\n  \"id_commande\": 2,\n  \"nb_sandwichs\": 2,\n  \"sandwichs\": [\n    {\n      \"taille\": \"456cm\",\n      \"type_de_pain\": \"blanc\"\n    },\n    {\n       ...\n    }\n  ],\n  \"liens\": {\n    \"paiement\": \"/commandes/2/paiement/\"\n  }\n}",
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
            "field": "NotFound",
            "description": "<p>Ressource inconnue</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 NotFound\n\n{\n  \"Erreur\": \"Ressource de la commande 12 introuvable.\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Paramètre requis": [
          {
            "group": "Paramètre requis",
            "type": "String",
            "optional": false,
            "field": "date_de_livraison",
            "description": "<p>Date de livraison de la commande</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"id\": 1,\n  \"montant\": 58,\n  \"date_de_livraison\": \"2015-11-11\",\n  \"etat\": \"créée\"\n}",
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
            "field": "NotFound",
            "description": "<p>Ressource inconnue</p>"
          }
        ],
        "Erreur : 400": [
          {
            "group": "Erreur : 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Requete invalide</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 NotFound\n\n{\n  \"Erreur\": \"La commande est introuvable ou n'existe pas\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 400 BadRequest\n\n{\n  \"Erreur\": \"La commande a déjà été payée ou livrée\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Paramètres requis": [
          {
            "group": "Paramètres requis",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Paramètres requis",
            "type": "Number",
            "optional": false,
            "field": "cat_id",
            "description": "<p>Id de la catégorie</p>"
          },
          {
            "group": "Paramètres requis",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de l'ingrédient</p>"
          },
          {
            "group": "Paramètres requis",
            "type": "String",
            "optional": false,
            "field": "fournisseur",
            "description": "<p>Nom du fournisseur de l'ingrédient</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Erreur : 403": [
          {
            "group": "Erreur : 403",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>Accès interdit</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"Access denied\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"No username or password\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de l'ingrédient</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Erreur : 403": [
          {
            "group": "Erreur : 403",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>Accès interdit</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"Access denied\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"No username or password\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de l'ingrédient</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
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
            "description": "<p>Description de l'ingrédient</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"nom\": \"salades\",\n  \"description\": \"Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id de l'ingrédient</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "ingredients",
            "description": "<p>Tableau contenant les informations de l'ingrédient</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de l'ingrédient</p>"
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
            "type": "Array",
            "optional": false,
            "field": "categorie",
            "description": "<p>Tableau contenant les informations de la catégorie de l'ingrédient</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "categorie_link",
            "description": "<p>Lien vers la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n\n{\n  \"ingredient\": {\n    \"nom\": \"laitue\",\n    \"description\": \"belle laitue verte\",\n    \"fournisseur\": \"ferme \\\"la bonne salade\\\"\",\n    \"img\": null,\n    \"categorie\": [\n      {\n        \"nom\": \"salades\",\n        \"description\": \"Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux\"\n      }\n    ]\n  },\n  \"categorie_link\": \"/ingredients/1/categorie/\"\n}",
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
            "field": "NotFound",
            "description": "<p>Ingrédient inexistant</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 Not Found\n\n{\n  \"Error\": \"Ingredient 56 introuvable\"\n}",
          "type": "json"
        }
      ]
    },
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
    "success": {
      "fields": {
        "Succès : 200": [
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
          "content": " HTTP/1.1 200 OK\n\n{\n  \"ingredients\": [\n    {\n      \"id\": 1,\n      \"nom\": \"laitue\",\n      \"cat_id\": 1,\n      \"description\": \"belle laitue verte\",\n      \"fournisseur\": \"ferme \\\"la bonne salade\\\"\",\n      \"img\": null,\n      \"link\": {\n        \"detail\": \"/ingredients/1/\"\n      }\n    },\n    {\n        ...\n    }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 403": [
          {
            "group": "Erreur : 403",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>Accès interdit</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"Access denied\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"No username or password\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Paramètres possible": [
          {
            "group": "Paramètres possible",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Paramètres possible",
            "type": "Number",
            "optional": false,
            "field": "cat_id",
            "description": "<p>Id de la catégorie</p>"
          },
          {
            "group": "Paramètres possible",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de l'ingrédient</p>"
          },
          {
            "group": "Paramètres possible",
            "type": "String",
            "optional": false,
            "field": "fournisseur",
            "description": "<p>Nom du fournisseur de l'ingrédient</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Erreur : 403": [
          {
            "group": "Erreur : 403",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>Accès interdit</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"Access denied\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 403 Forbidden\n\n{\n  \"Error\": \"No username or password\"\n}",
          "type": "json"
        }
      ]
    },
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
    "parameter": {
      "fields": {
        "Paramètres requis": [
          {
            "group": "Paramètres requis",
            "type": "String",
            "optional": false,
            "field": "taille",
            "description": "<p>Taille du sandwich</p>"
          },
          {
            "group": "Paramètres requis",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>Type de pain du sandwich</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "taille",
            "description": "<p>Taille du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type_de_pain",
            "description": "<p>Type de pain du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "links",
            "description": "<p>Tableau contenant les liens liés à la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "commande",
            "description": "<p>Lien vers la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "ingredients",
            "description": "<p>Lien vers les ingrédients du sandwich</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n{\n  \"taille\": \"grosse faim\",\n  \"type_de_pain\": \"blanc\",\n  \"links\": {\n    \"commande\": \"/commandes/2/\",\n    \"ingredients\": \"/commandes/2/sandwichs/7/ingredients/\"\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 400": [
          {
            "group": "Erreur : 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Requete invalide</p>"
          }
        ],
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Ressource inconnue</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 400 BadRequest\n\n{\n  \"erreur\": \"Le type ou la taille entré n'est pas valide\"\n}",
          "type": "json"
        },
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 NotFound\n\n{\n  \"Erreur\": \"Ressource de la commande 12 introuvable.\"\n}",
          "type": "json"
        }
      ]
    },
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
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "cle",
            "description": "<p>Message</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Array",
            "optional": false,
            "field": "liens",
            "description": "<p>Tableau contenant les liens liés au sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "commande",
            "description": "<p>Lien vers la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas de succès",
          "content": " HTTP/1.1 200 OK\n{\n  \"0\": \"Le sandwich a été supprimé avec succés.\",\n  \"liens\": {\n    \"commande\": \"/commandes/2\"\n  }\n}",
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
            "field": "NotFound",
            "description": "<p>Ressource inconnue</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Exemple de réponse en cas d'erreur",
          "content": " HTTP/1.1 404 NotFound\n\n{\n  \"Erreur\": \"Ressource du sandwich 9 introuvable.\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/doc.php",
    "groupTitle": "Sandwichs"
  },
  {
    "group": "Sandwichs",
    "name": "modifyIngredient",
    "version": "0.1.0",
    "type": "put",
    "url": "/commandes/sandwichs/{id_sandwich}/ingredients/{id_ingredient}[/]",
    "title": "Modifier ingrédients",
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
    "title": "Modifier sandwich",
    "description": "<p>On modifie un sandwich</p> <p>Retourne une représentation json de la ressource</p>",
    "filename": "input/doc.php",
    "groupTitle": "Sandwichs"
  }
] });
