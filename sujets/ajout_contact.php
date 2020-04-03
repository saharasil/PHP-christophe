<?php
/*  
********************************************************************************
                  Créer un répertoire de contacts avec photo
********************************************************************************

	
	1- Créer une base de données "repertoire" avec une table "contact" :
	  id_contact PK AI INT
	  nom VARCHAR(50)
	  prenom VARCHAR(50)
	  telephone VARCHAR(10)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')
	  photo VARCHAR(255)

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. 
	   Le champ type_contact doit être géré via un "select option".
	   On doit pouvoir uploader une photo par le formulaire. 
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   Si une photo est uploadée, le type du fichier doit être png ou jpg ou jpeg.
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.

	5- Ajouter la photo du contact en BDD et uploader le fichier sur le serveur de votre site. Son nom est contact_155555555.jpg où 155555555 correspond au timestamp.

*/


//connexion avec la  base donné
$pdo = new PDO('mysql: host=localhost;dbname=repertoire', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
              'root',//pseudo de la BDD
              '', //mdp de la BDD
              array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
              )            
);
require_once 'fonction.php';
$contenu = '';
$message ='';

debug($contenu);
debug($_POST);
// debug($_FILES);


if(!empty($_POST)){

	if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) { 
		$contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 20 caractères.</div>';
	}
	if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 50) { 
		$contenu .= '<div class="alert alert-danger">Le prenom doit contenir entre 2 et 20 caractères.</div>';
	}
	if (!isset($_POST['telephone']) || !preg_match( '#^[0-9]{10}$#', $_POST['telephone'])) { 
		$contenu .= '<div class="alert alert-danger">Le telephone doit contenir 10 caractères.</div>';
	}
	if(!isset($_POST['type_contact'])|| ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' &&  $_POST['type_contact']!= 'professionnel' && $_POST['type_contact'] != 'autre')){
		$contenu .= '<div class="alert alert-danger">Choisissez un type de contact.</div>';

	}
	if (!isset($_POST['email']) || strlen($_POST['email']) > 255 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
		$contenu .= '<div class="alert alert-danger">L\'email n\'est pas valide.</div>';
	}
	// if (!isset($_FILES['photo']['name']) { 
	// 	$contenu .= '<div class="alert alert-danger">Image n\'est pas télecharger.</div>';

	// }


		if (empty($contenu)){
			$photo_bdd = '';
			if(!empty($_FILES['photo']['name'])){
				$photo_bdd = 'image/' . $_FILES['photo']['name'];  
				copy($_FILES['photo']['tmp_name'],  $photo_bdd);
			}
				
			foreach($_POST as $indice => $valeur) {
				$_POST[$indice] = htmlspecialchars($valeur);
			}

			$resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, email, type_contact, photo) 
			VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo)");
			$succes = $resultat->execute(array(
				':nom'          => $_POST['nom'],	
				':prenom'       => $_POST['prenom'],
				':telephone'    => $_POST['telephone'],
				':email'        => $_POST['email'],
				':type_contact' => $_POST['type_contact'],		
				':photo'     => $photo_bdd,	
			));
			if ($succes){
				$message .= '<div class="alert alert-success">Votre contact est ajouté <a href="liste_contact.php">Click pour parcourir la liste</a></div> ';
			}else {
				$message .= '<div class="alert alert-danger">Votre contact n\'est pas ajouté</div> ';
			}
		}// fin if(empty($contenu))
}// fin if(!empty($_POST))

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sujet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php 
echo $contenu ;
echo $message;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form method="post" action="" enctype="multipart/form-data">
			
				<div>
					<div><label for="nom">Nom</label></div>
					<div><input type="text" name="nom" id="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"></div>
				</div>
			
				<div>
					<div><label for="prenom">Prénom</label></div>
					<div><input type="text" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"></div>
				</div>
			
				
				<div>
					<div><label for="telephone">Telephone</label></div>
					<div><input type="text" name="telephone" id="telephone" value="<?php echo $_POST['telephone'] ?? ''; ?>"></div>
				</div>
				<div>
					<div><label for="email">Email</label></div>
					<div><input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>"></div>
				</div>
				
				<div>
					<div><label for="type_contact">Type_contact</label></div>
					<select name="type_contact" id="type_contact">
						<option>ami</option>
						<option>famille</option>
						<option>professionnel</option>
						<option>autre</option>
					</select>
				</div>
				<div>
					<div><label for="photo">Photo</label></div>
					<div><input type="file" name="photo" id="photo" value="<?php echo $_POST['photo'] ?? ''; ?>"></div>
				</div>
				<div><input type="submit" value="Enregistrer" ></div>
			</form>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>