<?php
// Ce fichier sera inclus au début de tous les scripts du site.

//connexion à la BDD
$pdo = new PDO('mysql: host=localhost;dbname=site', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
        'root',//pseudo de la BDD
        '', //mdp de la BDD
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
        ));

// Créer une session ou l'ouvrir si elle existe
session_start();

//Définir le chemin du site :
define('RACINE_SITE', '/PHP/08-site/'); //constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partie de localhost. Ainsi nous écrions tous les chemins des src ou des href en absolu avec cette constante. Chez un hébergeur vous mettriez '/' si votre site se trouve à la racine de votre hébergement.

// Variable pour afficher du HTML :
$contenu =''; // on se sert de cette varoable partout sur le site.

//Inclusions des fonctions :
require_once 'functions.php';


