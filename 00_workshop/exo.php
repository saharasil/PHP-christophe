<?php


//connection à la bdd
$pdo = new PDO('mysql: host=localhost;dbname=exo_contacts', //driver mysql (IBM, oracle, ODBC ...), nom du serveur (host), nomde la BDD(dbname)
              'root',//pseudo de la BDD
              '', //mdp de la BDD
              array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
              )            
);
//ce fichier sera inclu au tout début de tous les fichiers du site
require_once 'fonction.php';
debug($pdo);
debug(get_class_methods($pdo));

//1er EXO afficher dans la page les données de la t_contacts PUIS afficher les données dans le TABLE
$resultat = $pdo->query("SELECT * FROM  t_contacts");
debug($resultat);
echo 'Nombre de contactes: ' . $resultat->rowCount();


// while($contacts = $resultat->fetch(PDO::FETCH_ASSOC)){
//     debug($contacts);
// }


?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Exo Workshop</title>


  </head>
  <body>
    <div class="container">
        
        <div class="jumbotron">
            <h1 class="display-4">Exo Workshop</h1>
            <p class="lead"></p>
            <hr class="my-4">
            
            <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- <form method="Post" action="">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="password" class="form-control" id="nom" name="nom">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="email">E_mail</label>
                        <input type="email" class="form-control" id="email"  name="email">
                    </div>
                    <div class="form-group row">
                        <label for="mdp" class="col-sm-2 col-form-label">Mot de passe</label>
                        <div class="col-sm-4">
                        <input type="password" class="form-control" id="mdp" name="mdp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Address</label>
                        <input type="text" class="form-control" id="adresse"  name="adresse" placeholder="Appartement, studio, ou RDC">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="code_postal">Code_postal</label>
                        <input type="text" class="form-control" id="cod_postal" name="cod_postal">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                        <label for="pays">Pays</label>
                        <input type="text" id="pays" name="pays" class="form-control">
                        </div>  
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telephone">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="notes">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form> -->
            </div><!--fermeture de la première col-->
        
        </div><!--fermeture de la prmière row-->
        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2> <?php echo 'Nombre de contacts: ' . $resultat->rowCount() . ' .';?></h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col" class=" text-center">ID_contacts</th>
                        <th scope="col" class=" text-center">Civilité</th>
                        <th scope="col" class=" text-center">Prenom</th>
                        <th scope="col" class=" text-center">Nom</th>
                        <th scope="col" class="text-center">Age</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class=" text-center">Mot de passe</th>
                        <th scope="col" class=" text-center">Adresse</th>
                        <th scope="col" class=" text-center">Code_postal</th>
                        <th scope="col" class=" text-center">Ville</th>
                        <th scope="col" class=" text-center">Pays</th>
                        <th scope="col" class=" text-center">Telephone</th>
                        <th scope="col" class=" text-center">Photos</th>
                        <th scope="col" class=" text-center">Notes</th>
                        
                        </tr>
                    </thead>
        
                    <tbody>
                        <?php
                    while ($contacts = $resultat->fetch(PDO::FETCH_ASSOC)){
                         echo'<tr>';
                         foreach($contacts as $infos){
                            echo '<td>' . $infos .'</td>';
                         }
                         echo '</tr>';
                    }
                    ?>
                       
                    </tbody>
                </table>
            </div><!--fermeture de la deuxième col-->
        </div><!--fermeture de la deuxième row-->

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>