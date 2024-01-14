# Documentation de l'API Météo

## Introduction

Cette API météo fournit des données météorologiques en fonction d'identifiants uniques de sonde. Elle utilise XAMPP/MAMP comme environnement de développement local, PHP pour la logique côté serveur, une base de données MySQL pour stocker les données météo, phpMyAdmin pour gérer la base de données, et un navigateur web pour accéder à l'API.

## Configuration requise

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre système :

- [XAMPP](https://www.apachefriends.org/index.html) ou [MAMP](https://www.mamp.info/)
- PHP (inclus dans XAMPP/MAMP)
- MySQL (inclus dans XAMPP/MAMP)
- [phpMyAdmin](https://www.phpmyadmin.net/)
- Un navigateur web (Chrome, Firefox, Safari, etc.)

## Instructions d'installation

### 1. Téléchargement et installation de XAMPP/MAMP

- Rendez-vous sur le site web de [XAMPP](https://www.apachefriends.org/index.html) ou [MAMP](https://www.mamp.info/) pour télécharger la version compatible avec votre système d'exploitation.
- Suivez les instructions d'installation fournies sur le site pour installer XAMPP/MAMP sur votre machine.

### 2. Configuration de l'environnement

- Lancez XAMPP/MAMP et démarrez les services Apache et MySQL.
- Configuration du server en intégrant ces lignes ci-dessous à la fin du fichier httpd.conf (dans dossier apache de MAMP/XAMPP)

//////
CODE => Listen 9530
<VirtualHost *:9530>
    DocumentRoot "/Applications/MAMP/htdocs/API/"
    ServerName api.local

    <Directory "/Applications/MAMP/htdocs/API/">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
/////

### 3. Téléchargement du code source

- Téléchargez le code source de l'API météo à partir du [lien GitHub](https://github.com/Yoann-Lgd/CUBEMeteo.git).

### 4. Configuration de la base de données

- Ouvrez phpMyAdmin depuis votre navigateur en accédant à `http://localhost/phpmyadmin`.
- Connectez-vous avec les identifiants par défaut (généralement : utilisateur `root` sans mot de passe).
- Créez une nouvelle base de données nommée `meteo_db`.

### 5. Importation des données

- Importez les données météo fournies dans le dossier `BDD` du code source dans la base de données `meteo_db` que vous venez de créer.
-   L'importation de données peut-être gérée si on le veut par un script rédigé par nos soins présent dans RelevesDAO.php et SondeDAO.php au lieu de relier un respberry physiquement ou de l'émuler.

### 6. Test de l'API

- Lancez XAMPP/MAMP si ce n'est pas déjà fait.
- Pour tester l'API : vous pouvez le faire directement via votre navigateur web en spécifiant dans la barre de recherche cet url : http://api.localhost:9530/apirest.php?resource=sondes par exemple. Vous allez alors obtenir toutes les sondes enregistrées dans la base de données. Vous pouvez également le faire depuis une plateforme / site qui teste les api comme PostMan.

## Utilisation de l'API

### Endpoints
- Quand il y a la présence du caractère ":" dans l'url il faut le remplacer par les     valeurs adéquates (ex: par l'id d'une sonde présente, les dates au formats YYYY-MM-DD)
- Endpoints GET 
    - http://api.localhost:9530/apirest.php?resource=sondes
    - http://api.localhost:9530/apirest.php?resource=releves&idSonde=:idSonde
    - http://api.localhost:9530/apirest.php?resource=releves_periode&idSonde=:idSonde&date_debut=:YYYY-MM-DD&date_fin=:YYYY-MM-DD

- Enpoints PUT / POST
    - http://api.localhost:9530/apirest.php?resource=sonde
    - http://api.localhost:9530/apirest.php?resource=releves

### Exemple d'appel

GET /v1/meteo?idSonde=123456

### Réponses possibles

- La réponse renverra les données météo au format JSON pour l'identifiant de sonde fourni.

```json
{
	"IdSonde": "Sonde 123456",
	"temperature": 22,
	"humidity": 60
}
```
