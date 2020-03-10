<?php
$pdo = new PDO('mysql: host=localhost;dbname=entreprise', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
'root',//pseudo de la BDD
'', //mdp de la BDD
array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
)            
);