<?php
//exercice : 
// -vous créer un formulaire avec les champs ville , code postal et une zone de texte adresses.
//- Quand le formulaire est envoyé, vous en récupérer les données dans exercices_traitement.php et vous les afficher.
?>
<form method="post" action="exercice_traitement.php">
    <label for="ville"> La ville</label>
    <input type="text" name="ville" id="ville">
    <label for="codePostale"> Le code postale</label>
    <input type="text" name="codePostale" id="codePostale">
    <label for="adresse">Adresse</label>
    <textarea name="adresse" id="adresse"></textarea>
    <input type="submit" value="Envoyer">
</form>

