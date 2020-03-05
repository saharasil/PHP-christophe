<?php
require_once '../01_bases/fonctions.php';
//Exercice : 
/* 
1- Vous afficher dans cette page un titre "Mon compte", un nom et un mrenom.
2- VOus y ajouter un lien " modifier mon compte" . Ce lien envoie dans l'URL à la même page exercice.php que l'action demandés est "modification" quand on clique sur le lein .
3- Si vous avez reçu une action "modification" par l'URL, alors vous afficher "vous avez demandé la modification de votre compte".
*/
echo '<h1> Mon compte </h1>';
echo '<p> Sahar </p>';
echo '<p> MH </p>';
echo '<a href="exercice.php?action=modification"> Modifier mon cpmte </a>';
echo '<a href="exercice.php?action=suppression"> Supprimer mon cpmte </a>';


debug($_GET);


if(isset($_GET['action']) && $_GET['action'] == 'modification'){// si existe "action" dans $_GET, donc dans l'URL, et que dans le même temps sa valeur est égale à "modification" alors on affiche la phrase suivante :
    echo '<p> vous avez demandé la modification de votre compte </p>';

}
if(isset($_GET['action']) && $_GET['action'] == 'suppression'){ // si on a cliqué sur "suppression" alors on affiche la phrase suivante :
    echo '<p> vous avez demandé la suppression de votre compte </p>';

}





