<?php
//-------------------------------
  echo ' <h2> La superglobal $_COOKIE </h2>' ;

// -------------------------------
/*
Un cookie est un petit fichier (4ko max) déposé par le serveur web sur le poste de l'internaute, est qui contient des informations.
Les coohies sont automatiquement envoyés au serveur web par le navigateur lorsque l'internaute navigue dans les pages concernées par les cookies.
PHP permet de récupérer très facilement les données contenues dans un cookies : ses informations sont stockées dans la superglobale $_COOKIE.
Un cookie étant sauvegardé sur le poste de l'internaute, il peut y être mofifié, volé ou détourné. On n'y met donc pas d'informations sensibles ( mot de passe, panier d'achat, références bancaires...).
*/

// Mise en pratique : stocker la lngue sélectionnée dans un cookies.

//2- On détermone la langue à afficher "fr" par défaut :

if(isset($_GET['langue'])){ // si une langue est dans l'URL, c'est que l'internaute a cliqué sur un des liens. on en verra donc cette langue dans le cookies:
    $langue = $_GET['langue'];
}elseif(isset($_COOKIE['langue'])){// sinon si on a reçu un cookie appelé "langue" alors la langue du site dera la valeur du cookies.
    $langue = $_COOKIE['langue'];

}else {
    $langue = 'fr';// sinon si l'internaute n'a pas choisi de langu, et qu'il arrive pour la première fois, on lui met "fr" par défaut.
}

//3- Envoi du cookies avec la langue :
echo time(); // donne le timestamp de maintenant : date exprimée en secondes écoulées entre le 01/01/1970 et maintenant.

$un_an = time() + 365*24*60*60; // on prend le timestamp de maintenant auquel on ajoute 1 an exprimé en secondes pour déterminer la date d'expiration du cookie.
setcookie('langue',$langue, $un_an); // On envoie notre cookie appelé "langue", avec pour contenu $langue, et pour date d'expiration $un_an.
// 4- affichage de la langue : 
echo '<h2> langue du site : ' . $langue . '</h2>'; 
// Il n'esxiste pas de fonction prédéfinies qui permette de supprimer un cookie. Pour rendre un cookie invalide, in utilise setcookie() avec le nom du cookieconcerné, et en mettant une date d'expiration à 0 ou antériere à aujourd'hui.

// Pour  visualiser le s cokkies dans le navigateur : onglet "stockage" dans Firefox, ou "application" dans chrome. 


// 1- Le HTML
?>
<h1>Votre langue</h1>
<ul>
    
      <li>  <a href="?langue=fr">Français</a></li><!-- On envoie la langue choisie par l'URL : la valeur "fr" est réceptionnée dans la superglobale $_GET-->
      <li> <a href="?langue=es">Espagnol</a></li>
      <li><a href="?langue=it">Italien</a></li>
      <li> <a href="?langue=en">Anglais</a></li>
</ul>