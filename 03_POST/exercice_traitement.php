<?php
if(!empty($_POST)){
    echo '<p> La ville: ' . $_POST['ville'] . '</p>';
    echo '<p> Le code postale : ' . $_POST['codePostale'] . '</p>';
    echo '<p> Adresse : ' . $_POST['adresse'] . '</p>';
    //-------
    // On va écrire les adresse dans un fichier texte sue le serveur en l'absence de base de données :
    $file = fopen('adresses.txt', 'a'); //fopen() en mode "a" permet de crééer un fichier s'il existe pas encore si non de l'ouvrir.
    $adresse = $_POST['adresse'] .'-' . $_POST['codePostale'] . '-' . $_POST['ville'] . "\n"; // "\n" pour faire des sauts de lignes dans le fichier txt.
    fwrite($file, $adresse); // permet d'ecrire l'adresse de l'internaute dans le fichier ouvert et représenté par $file.

}
