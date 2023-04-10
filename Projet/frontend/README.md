## Fonctionnalités:
- Aliments stockés en base dans une table aliment
- Affichage d’un tableau CRUD afin d'interagir avec la table aliment
- Affichage d'un dashboard présentant les indicateurs choisis pour l'utilisateur
- Page profil permettant de renseigner et modifier les informations de l'utilisateur
- Page d'aceuil
- Page journal affichant les consomation d'un utilisateur avec possibilité d’ajouter une entrée
- Page login permettant de se connecter à son compte utilisateur ou créer un nouveau ( vous pouvez vous connecter à n'importe quel compte utilisateur de la base de données ou en créer un nouveau via le form )
voici les login et mot de passe sugérer pour le test (nouveau avons fait en sorte de remplir les données pour ce compte utilisateur)
- Login : 
- Mot De Passe :

## Architecture
L’architecture de l'application est conforme à l'architecture REST et donc découpée en 2 parties : le backend et le frontend. Le backend est écrit en PHP standard sans l'utilisation de framework ou bibliothèque externe. Le frontend utilise Bootstrap CSS, JQuery et Datatables.

### Le backend
Le backend est constitué du code PHP qui reçoit des requêtes HTTP et retourne des réponses HTTP contenant du JSON conformément à une API construite. Il est organisé dans le dossier `backend` et contient les fichiers suivants :

- `sql/database.sql` : script SQL de création des tables avec insertion des données.
un dossier API contenat : 
- `config.php` : contient des variables globales d'initialisation du backend.
- `aliments.php` : implémente les endpoints CRUD pour les aliments.
- `users.php` : implémente les endpoints CRUD pour les utilisateur.
- `consommation.php`:implémente les endpoints CRUD pour les consommation d'un utilisateur ( pour le journal)
- `dashboard.php`: implémente les endpoints CRUD pour le dashboard.
- `README.md` : description de l'API REST.


un dossier crud_functions : 
- `aliments.php` : implémente les fonctions CRUD pour les aliments.
- `users.php` : implémente les fonctions CRUD pour les utilisateurs.
- `consommation.php`:implémente les fonctions CRUD pour les consommation d'un utilisateur ( pour le journal).
- `consommation.php` : implémente les fonctions CRUD pour le dashboard

###  frontend
Le frontend est constitué du code HTML, CSS, JS et PHP qui permet d’envoyer la partie cliente de l’application au navigateur. Il est organisé dans le dossier `frontend` et contient les fichiers suivants :

- `aliments.php`: la page contenat tout les aliments avec la possibilités de rajouter des aliments en écrivant leurs nom dans le form et en leur assigant un id_type compris de 1 à 11
- `config.php` : contenat les variable globale c'est ici que vous pouvez modifiez les chemins pour les différent endpoints et autre URL enn fonction de votre machine
- `index.php` : la page d'aceuil
- `journal.php` :  la page de journal ou l'on peut ajouter , modifer ou suprimer des consommation
- `login.php` : la page de login et de signup 
- `profil.php`: la page contenat les informations de l'tilisateur actuel, les données de l'utilisateur sont modifiables via cet page.

un dossier templates:
- `template_header.php` : la template pour le header
- `template_menu.php` : la template pour le menu
- `footer_template.php` : la template pour le footer
