# README de l'API
Il s'agit d'une API RESTful simple construite avec PHP et PDO pour la gestion des aliments dans une base de données.

# Points d'accès de l'API
Les points d'accès suivants sont disponibles :

# GET /aliments
Retourne une liste de tous les aliments dans la base de données.

## Réponse
La réponse sera un objet JSON contenant un tableau d'aliments.

Exemple :
{
  "data": [
    {
      "id": 1,
      "nom": "Pommes",
      "id_type": 1
    },
    {
      "id": 2,
      "nom": "Carottes",
      "id_type": 2
    }
  ]
}

# POST /aliments
Ajoute un nouvel aliment à la base de données.

## Requête
La requête doit contenir les paramètres suivants dans le corps :

nom : Le nom de l'aliment à ajouter.
id_type : L'ID du type d'aliment.
Exemple :

{
  "nom": "Tomates",
  "id_type": 2
}
## Réponse
Si la requête est réussie, le code d'état HTTP 201 Created sera retourné.

# PUT /aliments
Met à jour un aliment existant dans la base de données.

## Requête
La requête doit contenir les paramètres suivants dans le corps :

id : L'ID de l'aliment à mettre à jour.
nom : Le nouveau nom de l'aliment.
id_type : Le nouvel ID du type d'aliment.

Exemple :
{
  "id": 1,
  "nom": "Pommes Golden",
  "id_type": 1
}
## Réponse
Si la requête est réussie, l'aliment mis à jour sera retourné dans un objet JSON :
{
  "data": {
    "id": 1,
    "nom": "Pommes Golden",
    "id_type": 1
  }
}

# DELETE /aliments
Supprime un aliment existant de la base de données.

## Requête
La requête doit contenir l'ID de l'aliment à supprimer dans la chaîne de requête.

Exemple :
/aliments?id=1

## Réponse
Si la requête est réussie, le code d'état HTTP 204 No Content sera retourné.

## Gestion des erreurs
En cas d'erreurs, l'API retournera un code d'état HTTP approprié et un message d'erreur dans le corps de la réponse.

Les codes d'erreur suivants sont actuellement supportés :

* 400 Bad Request : La requête est mal formée ou manque de paramètres requis.
* 404 Not Found : La ressource demandée n'a pas pu être trouvée.
* 500 Internal Server Error : Une erreur serveur s'est produite.

## Dépendances
Cette API nécessite une base de données MySQL et les fichiers PHP suivants :

config.php : Fichier de configuration contenant les paramètres de connexion à la base de données.
aliments.php : Fichier contenant les fonctions CRUD pour les aliments dans la base de données.


# GET /users
Pour récupérer des informations sur un utilisateur, utilisez une requête GET avec les paramètres "id_user" pour l'ID de l'utilisateur ou "login" et "mdp" pour le nom d'utilisateur et le mot de passe de l'utilisateur.

Exemple : http://example.com/api/users/?id_user=1

# POST /users
Pour créer un nouvel utilisateur, envoyez une requête POST avec les paramètres suivants : "nom", "prenom", "login", "sexe", "age", "mdp" et "poids".

# DELETE /users
Pour supprimer un utilisateur, envoyez une requête DELETE avec le paramètre "id_user" pour l'ID de l'utilisateur à supprimer.

Exemple : http://example.com/api/users/?id_user=1

# PUT /users
Pour mettre à jour un utilisateur existant, envoyez une requête PUT avec un corps JSON contenant les paramètres suivants : "id_user", "nom", "prenom", "login", "sexe", "age", "mdp" et "poids".

## Erreurs
En cas d'erreur, l'API renvoie une réponse avec le code HTTP 400 (Bad Request) ou 500 (Internal Server Error) et un message d'erreur détaillé dans le corps de la réponse.

# Endpoints
voici les endpoint de l'api : 
# GET /consommation?user_id={user_id}
Récupère la liste des consommations pour l'utilisateur ayant l'identifiant user_id.

## Paramètres de requête
user_id : L'identifiant de l'utilisateur pour lequel récupérer les consommations.
## Réponse
La réponse est un objet JSON contenant un tableau de consommations pour l'utilisateur spécifié :
 {
  "data": [
    {
      "id_consomme": 1,
      "id_utilisateur": 1,
      "id_aliment": 2,
      "quantite": 100,
      "date_consommation": "2023-04-10 12:34:56"
    },
    {
      "id_consomme": 2,
      "id_utilisateur": 1,
      "id_aliment": 3,
      "quantite": 50,
      "date_consommation": "2023-04-09 09:00:00"
    }
  ]
}
# POST /consommation
Ajoute une nouvelle consommation pour un utilisateur.

## Corps de la requête
Le corps de la requête doit être un objet JSON contenant les informations de la consommation :
{
  "user_id": 1,
  "aliment_id": 2,
  "quantite": 100,
  "date_consommation": "2023-04-10 12:34:56"
}
user_id : L'identifiant de l'utilisateur pour lequel ajouter une consommation.
aliment_id : L'identifiant de l'aliment consommé.
quantite : La quantité consommée.
date_consommation : La date et l'heure de la consommation au format YYYY-MM-DD HH:mm:ss.

## Réponse
La réponse est un objet JSON contenant les informations de la consommation ajoutée :
{
  "data": {
    "id_consomme": 1,
    "id_utilisateur": 1,
    "id_aliment": 2,
    "quantite": 100,
    "date_consommation": "2023-04-10 12:34:56"
  }
}
# DELETE /consommation?id_consomme={id_consomme}
Supprime la consommation ayant l'identifiant id_consomme.

## Paramètres de requête
id_consomme : L'identifiant de la consommation à supprimer.
Réponse
La réponse est vide avec un code de statut 200 en cas de succès.

# PUT /consommation
Met à jour les informations d'une consommation existante.

## Corps de la requête
Le corps de la requête doit être un objet JSON contenant les informations de la consommation à mettre à jour :
{
  "id_consomme": 1,
  "quantite": 50,
  "date_consommation": "2023-04-10 12:34:56"
}
id_consomme : L'identifiant de la consommation à mettre à jour.
quantite : La quantité consommée.
date_consommation : la date de la consommation mise à jour au format Y-m-d
La réponse renvoie un objet JSON contenant les informations de la consommation mise à jour.

## Réponses
Les réponses de l'API sont renvoyées en format JSON. Les réponses renvoyées par l'API contiennent toujours un objet JSON avec la clé data, contenant les données renvoyées par l'API.

En cas d'erreur, l'API renvoie un code HTTP approprié et un message d'erreur en format JSON.