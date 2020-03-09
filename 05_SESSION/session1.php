<?php
//----------------------------------
// La superglobale $_SESSION
//--------------------------------
/*
    Principe des sessions : un fichier temporaire appeléé "session" est crée sur le serveur, avec un identifiant unique . Cette session est liée à un internaute car, dans le même temps , un cookie est déposé sur k=le poste de l'internaute avec l'identifiant (au nom de PHPSESSID). Ce kookie se détruit lorsqu'on quitte le navigateur.
    Le fichier de sesssion peut contenir des informations sensibles , car il n'est pas accessibles par l'internaute .
    Les données du fichier de session sont accessibles et manipulables à partir de la superglobale $_SESSION.
*/

// Création ou ouverture d'une session :
session_start();  // Permet de créer un fichier de session avec son identifiant ou de l'ouvrire si il existe déjà et que l'on a reçu un cookie avec l'ID dedans.

// Remplir la session avec des données :
$_SESSION['pseudo'] = 'tintin';
$_SESSION['mdp'] = 'milou'; // $_SESSION étant une superglobale, c'est un tableau . On accéde donc à ses valeurs en mettant des indices entre [].

echo '1- La session rempli : ';
print_r($_SESSION);
//Les session se trouvent dans le dissier /tmp/ du serveur.

// Vider une partie de la session : 
unset($_SESSION['mdp']); // supprime le "mdp" de la session. 
echo '<br> 2 - La session après supprission du mdp : ';
print_r($_SESSION);

//Supprimer entièrement une session :
// session_destroy(); // Suppression totale  du fichier de session  .
echo '<br> 3- La session après suppression : ';
print_r($_SESSION); // nous avons effectué un session_destroy() mais il n'est exécuté qu'à la fin de notre script. Nous voyons donc encore ici le contenu de la session . Pour vérifier sa suppression : voir que le dossier /tmp/ est bien vide.

// Les session ont l'avantage d'être disponible partout sur le site, et donc dans session2.php.