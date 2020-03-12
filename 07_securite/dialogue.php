<?php
//----------------------------
// Cas pratique : un formulaire pour poster des commentaires 
// --------------------------

//Objectif : protéger la requête SQL dont les données proviennent de l'internaute.
/*
 1- Modélisation de la BDD : 
    message de la BDD : dialogue
    message de la table : commentaire
    Champs           : id_commentaire    INT PK AI
                        pseudo           VARCHAR(20)
                        message          TEXT
                        date_enregistrement DATETIME
*/

// 2- Connexion de la BDD et traitement du formulaire
$pdo = new PDO('mysql: host=localhost;dbname=dialogue', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
        'root',//pseudo de la BDD
        '', //mdp de la BDD
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
        ));

    if(!empty($_POST)){// si $_POST n'est pas vide c'est que le formulaire a été envoyé
        // print_r($_POST);
        //5- Traitement contre les failles JS(XSS) ou les failles CSS:
        // Nous faisons l'injection CSS suivante : <style>body{display:none;}</style>
        //  Pour se prèmunir de ces failles nous faisons :
        $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
        $_POST['message'] = htmlspecialchars($_POST['message']);// cette fonction prédéfinie transforme les caractères spéciaux en entités HTML : 
            // le < devient &lt;
            // le > devient &gt;
            // le & devient &amp;
            // les caractères spéciaux étant transformés, les balises <script> et <style> devienne inoffensives car non exécutables.
        // Nous fesons d'abord une requête qui n'est pas protégée contre les injiction
        // $_resultat = $pdo->query("INSERT INTO commentaires (pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]')"); //NOW() est une fonction SQL qui retourne la date de l'instant présent.

        //4- Nous faisons l'injection SQL suivante dans le champ message : ');DELETE FROM commentaires; #
        // Pour s'en prémunir, nous faison une requête préparée qui neutralise les injections de type SQL :
        $resultat = $pdo->prepare("INSERT INTO commentaires (pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message)");
        $resultat->execute(array(
                            ':pseudo' => $_POST['pseudo'],
                            ':message' => $_POST['message']
                                 ));
            //comment ça marche? le fait de mettre  des marqueurs dans la requête permet de ne pas concaténer les instructions SQL d'origine et celle qui serait injectée. Ainsi elles ne peuvent plus s'exécuter successivement. De plus en liant les marqueures à leur valeur dans execute(), PDO les  automatiquement, les transformant en strings neutres inoffensifs.

    }//fin du if(!empty($_POST))
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Dialogue</title>
  </head>
  <body>
    <div class="container">
        
        <div class="jumbotron">
            <h1 class="display-4">Votre message</h1>
            <p class="lead"></p>
            <hr class="my-4">
        </div>

        <div class="row">
            <div class="col-md-12">
                <form method="Post" action="">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo']?? '' ;?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="message">Message</label>
                        <textarea type="password" class="form-control" id="message" name="message"><?php echo $_POST['message'] ?? '' ;?></textarea>
                    </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary">
                </form>
            </div><!--fermeture de la première col-->
        
        </div><!--fermeture de la prmière row-->
        <hr>
   <?php

// 3- Affichage des commentaires
$resultat= $pdo->query("SELECT pseudo, message, date_enregistrement FROM commentaires ORDER BY date_enregistrement DESC");
echo '<h2> Nombre de commentaire : ' . $resultat->rowCount() .'</h2>';
while ($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)){
    // echo'<pre>';
    // print_r($commentaire);
    // echo'</pre>';
    echo '<div> par ' .$commentaire['pseudo'] . ' le ' . $commentaire['date_enregistrement'] . '</div>';
    echo '<div>' . $commentaire['message'] . '</div><hr>';


}

?>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

