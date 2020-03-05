<?php
require_once '../01_bases/fonctions.php';
//--------------------------
// La superglobale $_POST
//---------------------------

/*
$_POST est une superglobale qui permet de récupéter les données saisie dns un formulaire.
Comme il s'agit d'une superglobale, $_POST est donc un tableau ( array), et il est disponible dans tous les contextes du script, y cimpris au sein des fonctions (pas besoin de faire "global "$_POST").
Le tableau $_POST se remplit de la manière suivante :
$_POST = array(
    'name1' => 'valeur1',
    'nameN => 'valeurN'
);
où Les name1  et nameN correspondent aux attributs "name" du formulaire, et où valeur1 et valeurN correspondent aux valeurs saisies par l'internaute.
*/
debug($_POST);// pour vérifier que l'on reçoit les données.
if(!empty($_POST)){ // si $_POST n'est pas vide , c'est que $_POST est rempli, donc que le formulaire a été envoyé. Notez que l'état, on peut l'envoyer avec des champs vides, les valeurs de $_POST étant alors des strings vides.
    echo '<p> Prénom : ' . $_POST['prenom'] . '</p>';
    echo '<p> Description : ' . $_POST['description'] . '</p>';
}

?>
<h1>Formulaire</h1>
<form method ="post" action=""> <!--un formulaire doit toujours étre dans une balise <form> pour fonctionner. L'attribut methode indique comment les données vont circuler vers le PHP. L'attribut action indique l'URL de destitantion des données (vide elles vont vers le même script-->
    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom"><!-- il ne faut pas oublier les "name" sur les formulaire : ils constituent les indics de $_POST qui récéptionne les données.-->
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" ></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer">
    </div>