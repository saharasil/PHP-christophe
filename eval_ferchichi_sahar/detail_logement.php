<?php
require_once 'connexion.php'; // pour la connexion à la BDD
require_once 'function.php';// pour la fonction debug

// debug($_GET);
$contenu = '';


if(isset($_GET['id_logement'])){  // si $_GET['id_logement'] existe donc un détail sur un logement est demandé
    $_GET['id_logement'] = htmlspecialchars($_GET['id_logement']); // protéction de donnée arrivés de l'URL
    // on prépare la requête et on l'éxecute 
	$detail = $pdo->prepare("SELECT * FROM logement WHERE id_logement = :id_logement");
    $detail->execute(array(':id_logement' => $_GET['id_logement']));
    // debug($detail);
    if ($detail->rowCount() == 0) { // si y'a pas de ligne dans notre PDOStatement donc l'id_logement demandé n'existe pas
		$contenu .= '<p>Ce logement n\'existe pas...</p>';
	} else { // si non 
		
        $logement = $detail->fetch(PDO::FETCH_ASSOC); // on fetch pour obtenir notre tableau $logement
        // debug($logement);
        // on affiche les données demandés spécifiqque au id_logement demandé
        $contenu .= '<div><h2>Vous chercher une / un : ' . $logement['titre'] .' : </h2></div>';
        $contenu .= '<figure>';
        $contenu .= '<img src="'. $logement['photo'] .'" alt="'. $logement['titre'].'">';
        $contenu .= '<div><figcaption>'.$logement['description'] . '<figcaption></div>';
        $contenu .= '</figure>';
        $contenu .= '<ul>';
		$contenu .= '<li><span> Adresse : </span>'. $logement['adresse'] . ' ' . $logement['ville'] .' ' . $logement['cp'] .'</li>';
		$contenu .= '<li><span> La surface : </span>'. $logement['surface'] .' m<sup>2</sup></li>';
		$contenu .= '<li><span>Le prix : </span>  '. $logement['prix'] .' €</li>';
		$contenu .= '<li><span> Le type de recherche : </span> '. $logement['type'] .'</li>';
	}
    


}
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- lien vers feuille de style personnel -->
    <link rel="stylesheet" href="css/style.css">

    <title>Immobilier</title>
  </head>
  <body>
    <div class="container"><!--div .container-->
        <div class="jumbotron">
            <h1 class="display-4 text-center">Détails de votre logement</h1>
            <p class="lead"></p>
            <hr class="my-4">
            <hr class="my-4">
        </div>
        <main class="row"> <!-- main  contenu principale-->
            <div class="col-md-12">
                <?php
                    echo $contenu; // Pour afficher les donnés dur le navigateur
                ?>

            </div>
        </main><!-- fermeture main-->
    
</div><!-- fermeture div .container -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
