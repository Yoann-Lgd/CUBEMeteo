# Cubemeteo

## Description

Cubemeteo est un projet d'application météo qui propose une API météo et une interface utilisateur pour consulter les données météorologiques.

## Structure du Projet

## Dossiers Principaux

### API

Le dossier API contient les fichiers relatifs à l'API météo.

- `Api.php`: Fichier principal pour l'API.

### BDD

Ce répertoire contient les fichiers liés à la gestion de la base de données.

- `api.php`: Fichier pour les requêtes API.
- `DbConnect.php`: Script de connexion à la base de données.
- `scriptBddCubeMeteo`: Scripts pour la base de données.
- `SondeDAO.php`: Gestionnaire des données des sondes.

### Templates

Contient les fichiers de templates pour l'interface utilisateur.

### CSS

Ce dossier héberge les fichiers de style pour l'interface.

### scrypt

Répertoire pour un script spécifique.

### images

Contient les images utilisées dans l'application.

## Comment Contribuer

Si vous souhaitez contribuer à ce projet, veuillez suivre ces étapes :

1. Cloner le repository.
2. Créer une branche pour votre contribution.
3. Faire les modifications nécessaires.
4. Soumettre une demande de fusion.

## License

Ce projet est sous licence MIT. Veuillez consulter le fichier `LICENSE` pour plus d'informations.

# Documentation pour Api.php

Le fichier `Api.php` se trouve dans le dossier `API`. Ce fichier contient les fonctionnalités pour interagir avec l'API météo.

## Description

Ce fichier contient des fonctionnalités pour l'API météo, notamment la création de sondes, l'insertion de relevés météorologiques et la récupération de relevés entre des dates spécifiques.

# Documentation pour api.php

Le fichier `api.php` est situé dans le dossier `BDD`. Il contient des fonctionnalités liées à la manipulation des données pour la base de données de l'application météo.

## Description

Ce fichier contient des fonctions pour l'insertion de sondes, la manipulation de relevés météorologiques, et la récupération de données depuis un dispositif Raspberry.

# Documentation pour DbConnect.php

Le fichier `DbConnect.php` est situé dans le dossier `BDD`. Il contient des configurations de connexion à la base de données pour l'application météo.

## Description

Ce fichier est responsable de l'établissement de la connexion à la base de données MySQL utilisée par l'application météo.

# Documentation pour RelevesDAO.php

Le fichier `RelevesDAO.php` contient des fonctions pour interagir avec la table "Releves" de la base de données de l'application météo.

## Description

Ce fichier offre des fonctionnalités pour insérer des relevés météorologiques dans la base de données, récupérer des relevés entre des dates spécifiques pour une sonde donnée, et traiter ces relevés.

# Documentation pour scriptBddCubeMeteo.sql

Le fichier `scriptBddCubeMeteo.sql` contient un script SQL pour la création des tables `Sonde` et `Releves` dans la base de données de l'application météo.

## Description

Ce script crée deux tables, `Sonde` et `Releves`, dans la base de données pour stocker les informations relatives aux sondes et aux relevés météorologiques.

## Contenu du Fichier

```sql
# Contenu du fichier scriptBddCubeMeteo.sql
# ... (Le script SQL a été tronqué pour des raisons de concision) ...

# Table Sonde
CREATE TABLE Sonde(
        ID  Int  Auto_increment  NOT NULL ,
        nom Varchar (50) NOT NULL
        ,CONSTRAINT Sonde_PK PRIMARY KEY (ID)
)ENGINE=InnoDB;

# Table Releves
CREATE TABLE Releves(
        ID          Int  Auto_increment  NOT NULL ,
        Date        Datetime NOT NULL ,
        Temperature Float NOT NULL ,
        Humidite    Float NOT NULL ,
        ID_Sonde    Int NOT NULL
        ,CONSTRAINT Releves_PK PRIMARY KEY (ID)
        ,CONSTRAINT Releves_Sonde_FK FOREIGN KEY (ID_Sonde) REFERENCES Sonde(ID)
)ENGINE=InnoDB;

```

# Documentation pour SondeDAO.php

Le fichier `SondeDAO.php` comprend des fonctions permettant d'interagir avec la table "Sonde" de la base de données de l'application météo.

## Description

Ce fichier offre des fonctionnalités pour insérer, récupérer et mettre à jour les données relatives aux sondes dans la base de données.

# Documentation pour connect.php (dans le dossier templates)

Le fichier `connect.php` gère la connexion à la base de données utilisée par l'application météo.

## Description

Ce fichier crée une connexion à la base de données MySQL et fournit une fonction pour établir une connexion à une base de données spécifique.

# Documentation pour erreur.html (dans le dossier templates)

Le fichier `erreur.html` est une page HTML qui affiche un message d'erreur en cas de dysfonctionnement dans l'application météo.

## Description

Cette page HTML est conçue pour être affichée en cas de rencontre d'une erreur imprévue dans l'application. Elle informe l'utilisateur de l'erreur survenue et lui recommande de réessayer ultérieurement.

# Documentation pour humidite.php (dans le dossier templates)

Le fichier `humidite.php` est une page PHP qui affiche les données sur l'humidité relevée au cours des derniers jours.

## Description

Cette page récupère les données d'humidité des cinq derniers jours depuis la base de données, calcule l'humidité moyenne pour chaque jour, puis affiche ces informations sous forme de tableau HTML et de graphiques.

## Contenu du Fichier

Le fichier contient à la fois du code PHP et HTML. Il récupère les données d'humidité des cinq derniers jours, les traite pour obtenir l'humidité moyenne de chaque jour et les présente visuellement à l'utilisateur.

Le fichier utilise des boucles PHP pour générer un tableau HTML et afficher les informations d'humidité pour chaque jour. Il calcule également l'humidité moyenne sur les cinq jours.

## Fonctionnalités Principales

### Affichage des Données d'Humidité

La page affiche les données d'humidité relevées pour chacun des cinq derniers jours sous forme de tableau HTML.

### Calcul de l'Humidité Moyenne

Elle calcule et affiche l'humidité moyenne sur les cinq derniers jours, fournissant ainsi une moyenne globale de l'humidité relevée sur cette période.

### Utilisation d'Images

Elle utilise des images pour rendre la page plus attrayante visuellement.

# Documentation pour index.html

Le fichier `index.html` est la page d'accueil de l'application météo. Elle présente des options pour afficher les données de température et d'humidité.

## Description

Cette page HTML propose une interface pour sélectionner et afficher les données de température et d'humidité de l'application météo. Elle est conçue de manière simple et conviviale.

## Contenu de la Page

### Introduction

La page commence par une brève introduction expliquant l'objectif de l'application et indiquant la fréquence de mise à jour des données.

### Options de Sélection

Elle offre deux boutons distincts pour l'affichage des données de température et d'humidité. Chaque bouton est associé à un formulaire qui, lorsqu'il est soumis, redirige vers la page respective (`temperature.php` ou `humidite.php`) pour afficher les données sélectionnées.

### Images

Chaque bouton est accompagné d'une icône correspondante (température ou humidité) pour une visualisation rapide.

### Footer

La page se termine par un pied de page indiquant l'année de l'application.

# Documentation pour temperature.php

Le fichier `temperature.php` est destiné à afficher les données de température sur les derniers jours, fournissant également une option pour sélectionner une heure spécifique et obtenir la température à cette heure précise.

## Description

Cette page HTML est dédiée à l'affichage de la température moyenne sur les cinq derniers jours. Elle propose une interface permettant de sélectionner une heure précise et d'afficher la température à cette heure. Les données sont présentées dans un tableau et sont visuellement représentées par une barre de progression.

## Contenu de la Page

### Sélection d'Heure

Un formulaire avec une liste déroulante permet à l'utilisateur de sélectionner une heure spécifique pour afficher la température à cet instant.

### Affichage des Données

La page présente un tableau affichant les températures moyennes sur les cinq derniers jours, avec une barre de progression représentant visuellement chaque valeur. Les températures moyennes sont également affichées en dessous de chaque date.

### Footer

Comme sur les autres pages, il y a un lien de retour vers la page d'accueil.

# Documentation pour toolbox.php

Ce fichier contient trois fonctions principales destinées à être utilisées pour les calculs de moyennes et la récupération de données spécifiques de la base de données.

## Fonctions

### `averageFromArray($Array)`

- **Description** : Calcule la moyenne des valeurs dans un tableau.
- **Paramètre** : `$Array` - Le tableau d'entrée pour lequel la moyenne est calculée.
- **Retour** : La moyenne des valeurs dans le tableau.

### `fiveDayBefore()`

- **Description** : Renvoie un tableau des cinq derniers jours à partir de la date actuelle.
- **Retour** : Un tableau contenant les cinq derniers jours sous forme de chaînes de caractères au format 'YYYY-MM-DD'.

### `averageTemp($BDD, $Table, $day)`

- **Description** : Calcule la température moyenne pour une journée spécifique à partir de la base de données.
- **Paramètres** :
  - `$BDD` - La connexion PDO à la base de données.
  - `$Table` - La table de la base de données à interroger.
  - `$day` - La journée pour laquelle la température moyenne est calculée.
- **Retour** : La température moyenne pour la journée spécifique.

### `averageHumidity($BDD, $Table, $day)`

- **Description** : Calcule l'humidité moyenne pour une journée spécifique à partir de la base de données.
- **Paramètres** :
  - `$BDD` - La connexion PDO à la base de données.
  - `$Table` - La table de la base de données à interroger.
  - `$day` - La journée pour laquelle l'humidité moyenne est calculée.
- **Retour** : L'humidité moyenne pour la journée spécifique.

### Fonctions de génération de données

#### `generateRaspberryData()`

- Génère des données de température et d'humidité simulées pour aujourd'hui.
- Utilise la date et l'heure actuelles.

#### `generateRaspberryData1()`, `generateRaspberryData2()`, `generateRaspberryData3()`, `generateRaspberryData4()`

- Génèrent des données de jours antérieurs, chaque fonction recule d'un jour supplémentaire par rapport à la date actuelle pour simuler les données des jours précédents.

Chaque fonction retourne un objet JSON avec les données simulées, notamment l'identifiant, le nom de l'appareil, la température, la date et l'humidité.

Il y a également des parties de code commentées pour exécuter périodiquement la génération de données, mais elles ne sont pas utilisées actuellement.
