<?php

// Ce fichier sera inclus au début de tous les scripts du site.


// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 
			   'root', 
			   '',     
			   array(
			       PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
			       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			  ));
?>