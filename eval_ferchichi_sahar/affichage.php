<?php // ouverture passage php
require_once 'connexion.php';// pour la connexion à la BDD
require_once 'function.php';// pour la fonction debug

$contenu = '';
// debug($_POST);

$resultat = $pdo->query("SELECT * FROM logement"); // on select tout de la  table  avec simle requ^éte car on interroge la BDD 
$contenu .= '<p>Nombre de logements disponible : '. $resultat->rowCount() .'</p>';
 

// le tableau d'affichage 
$contenu .= '<table class="table">';          
        $contenu .= '<thead class="thead-dark">';            
            $contenu .= '<tr>';                        
                $contenu .= '<th scope="col">Titre</th>';                  
                $contenu .= '<th scope="col">Adresse</th>';                 
                $contenu .= '<th scope="col">Surface</th>';
                $contenu .= '<th scope="col">Prix</th>';
                $contenu .= '<th scope="col">Photos</th>';  
                $contenu .= '<th scope="col">Type</th>'; 
                $contenu .= '<th scope="col">Description</th>';     
                $contenu .= '<th scope="col">Voir détails</th>';  
            $contenu .= '</tr>' ;           
        $contenu .= '</thead>';
    $contenu .= '<tbody>';                
        while ($logement = $resultat->fetch(PDO::FETCH_ASSOC)){ // on realise une boucle while parceque notre  afin d'afficher les multiples données dans les champs 
            $contenu .= '<tr>';
                $contenu .= '<td>' . $logement['titre'] . '</td>'; 
                $contenu .= '<td>' . substr($logement['adresse'] . ' ' . $logement['ville']. ' ' . $logement['cp'],0, 35). '....</td>'; // substr() pour découper l'adresse si elle est longue' 
                $contenu .= '<td>' . $logement['surface'] . '</td>'; 
                $contenu .= '<td>' . $logement['prix'] . '</td>'; 
                $contenu .= '<td><img src="'. $logement['photo'] .'" style="width:100px"></td>'; 
                $contenu .= '<td>' . $logement['type'] . '</td>';
                $contenu .= '<td>' . substr($logement['description'], 0, 15 ). '....</td>'; // substr() pour découper le description  
                $contenu .= '<th> <a href="detail_logement.php?id_logement=' . $logement['id_logement'].'">Voir plus de détails</a></th>';
            $contenu .= '</tr>';
            } // fin de la boucle while

    $contenu .= '</tbody>';
$contenu .= '</table>';

?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Immobilier</title>
  </head>
  <body>
    <div class="container"><!--  div .container -->
        <div class="jumbotron">
            <h1 class="display-4 text-center">Votre logement</h1>
            <p class="lead"></p>
            <hr class="my-4">
            <hr class="my-4">
        </div>
        <main class="row"><!-- main contenu de la page -->
            <div class="col-md-12">
                <?php
                    echo $contenu; // pour afficher le tableau sur la page 
                ?>



            </div>
        </main><!-- fermeture main -->
    
</div><!-- fermeture div .container -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>





