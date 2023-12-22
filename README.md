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

### 3. Téléchargement du code source

- Téléchargez le code source de l'API météo à partir du [lien GitHub](https://github.com/Yoann-Lgd/CUBEMeteo.git).

### 4. Configuration de la base de données

- Ouvrez phpMyAdmin depuis votre navigateur en accédant à `http://localhost/phpmyadmin`.
- Connectez-vous avec les identifiants par défaut (généralement : utilisateur `root` sans mot de passe).
- Créez une nouvelle base de données nommée `meteo_db`.

### 5. Importation des données

- Importez les données météo fournies dans le dossier `BDD` du code source dans la base de données `meteo_db` que vous venez de créer.

### 6. Test de l'API

- Lancez XAMPP/MAMP si ce n'est pas déjà fait.
- Utilisez un navigateur web pour accéder à l'URL de l'API, par exemple : `http://localhost/votreapi/v1/meteo?id=unique_id` en remplaçant `unique_id` par l'identifiant unique de la sonde pour obtenir les données météo associées.

## Utilisation de l'API

### Endpoint

- L'endpoint de l'API est `/v1/meteo`.
- Le paramètre `id` est obligatoire et correspond à l'identifiant unique de la sonde.

### Exemple d'appel

GET /v1/meteo?id=123456

### Réponses possibles

- La réponse renverra les données météo au format JSON pour l'identifiant de sonde fourni.

```json
{
	"ID": "Sonde 123456",
	"temperature": 22,
	"humidity": 60
}
```
