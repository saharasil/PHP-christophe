<?php
require_once 'connexion.php'; // pour la connexion à la BDD
require_once 'function.php'; // pour la fonction debug


// debug($_POST);
// debug($_FILES);
$contenu= '';

if(!empty($_POST)){ // on vérifie si $_POST est remplie
    // si true on valide le formulaire
    if (!isset($_POST['titre']) || strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 100) {
		$contenu .= '<div class="alert alert-danger">Le champ Titre est obligatoire.</div>';
    }
    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2 || strlen($_POST['adresse']) > 255) {
		$contenu .= '<div class="alert alert-danger">Le champ adresse est obligatoire. </div>';
    }
    if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 50) {
		$contenu .= '<div class="alert alert-danger">Le champ ville est obligatoire;</div>';
    }
    if (!isset($_POST['cp']) || !preg_match( '#^[0-9]{5}$#', $_POST['cp'])) {
		$contenu .= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
    }
    if (!isset($_POST['surface']) || !is_numeric($_POST['surface'])) {
		$contenu .= '<div class="alert alert-danger">Le champ surface n\'est pas valide. </div>';
    } 
    if (!isset($_POST['prix']) || !is_numeric($_POST['prix'])){
		$contenu .= '<div class="alert alert-danger">Le champ prix n\'est pas valide. </div>';
    } 
    if (!isset($_POST['type']) || ($_POST['type'] != 'location' && $_POST['type'] != 'vente')) {
		$contenu .= '<div class="alert alert-danger">La civilité n\'est pas valide.</div>';
    }
    if (empty($_FILES['photo']['name']) || 
    ($_FILES['photo']['error'] == 0 && $_FILES['photo']['size'] != 0  && !isset($_FILES['photo']['type']))
    ) { 
		$contenu .= '<div class="alert alert-danger">Image n\'est pas télecharger.</div>';

    }
    if ( !isset($_POST['description']) || strlen($_POST['description']) < 5 ) {
		$contenu .= '<div class="alert alert-danger">Le champ description n\'est pas valide. </div>';
    } 
    


    if (empty($contenu)) { // si $contenue est vide donc pas d'erreur  alors
		// on upload la photo :
        $photo = '';
		if(!empty($_FILES['photo']['name']))  {	
			$photo = 'images/' .$_FILES['photo']['name'];  
            copy($_FILES['photo']['tmp_name'], $photo);		
        }

        
        foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars($valeur); 
        }
        // on prépare la requête et on l'exécute
		$query = $pdo->prepare("INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description) VALUES(:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)");

		$succes = $query->execute(array(
				':titre'          => $_POST['titre'],
				':adresse'        => $_POST['adresse'],
				':ville'          => $_POST['ville'],
				':cp'             => $_POST['cp'],
                ':surface'        => $_POST['surface'],
                ':prix'           => $_POST['prix'],
                ':photo'          => $photo,
                ':type'           => $_POST['type'],
                ':description'    => $_POST['description'],
		));

		// on met un message de réussite ou d'échec
		if ($succes) {
			$contenu .= '<div class="alert alert-success">Votre recherche est envoyée avec succès</div>';
		} else {
			$contenu .= '<div class="alert alert-success">Erreur lors du recherche!!</div>';
		}
    }//fermeture if (empty($contenu))
}//fermeture if (!empty($_POST))

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
    <div class="container"> <!--div .container-->
        <div class="jumbotron">
            <h1 class="display-4 text-center">Votre logement</h1>
            <p class="lead"></p>
            <hr class="my-4">
            <hr class="my-4">
        </div>
        <?php echo $contenu;  ?> <!-- on affiche les message -->

        <main class="row"> <!--main contenue de la page-->
            <div class="col-md-12">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $_POST['titre']?? '' ;?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $_POST['adresse']?? '' ;?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="ville">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $_POST['ville']?? '' ;?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cp">Code_postale</label>
                            <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $_POST['cp']?? '' ;?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="surface">Surface : m<sup>2</sup></label>
                            <input type="text" class="form-control" id="surface" name="surface" value="<?php echo $_POST['surface']  ?? '' ;?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prix">Prix : €</label>
                            <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $_POST['prix']?? '' ;?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" value="<?php echo $_FILES['photo']['name']?? '' ;?>">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="type">Type</label>
                            <div class="row">
                                <div class="col-md-2"><input type="radio" name="type" value="location" checked></div>Location
                                <div class="col-md-2">   <input type="radio" name="type" value="vente" <?php if (isset($_POST['type']) && $_POST['type'] == 'vente') echo 'checked'; ?>></div>Vente
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description"><?php echo $_POST['description'] ?? '' ;?></textarea>
                    </div>
                    </div>
                    
                    
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        
        </main><!--fermeture de la main-->
        <hr>
    </div><!--fermeture de la div .container-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>