<?php
// Ce fichier sera inclus au début de tous les scripts du site.


// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=site', 
			   'root', 
			   '',     
			   array(
			       PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
			       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	          ));


// Créer une session ou l'ouvrir si elle existe
session_start();


// Définir le chemin du site :
define('RACINE_SITE', '/PHP/08-site/'); // constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partir de localhost. Ainsi nous écrions tous les chemins des src ou des href en absolu avec cette constante. Chez un hébergeur vous mettriez '/' si votre site se trouve à la racine de votre hébergement.

// Variable pour afficher du HTML :
$contenu = ''; // on se sert de cette variable partout sur le site.

// Inclusion des fonctions :
require_once 'functions.php';
