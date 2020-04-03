<?php

/* 1- Créer une base de données "repertoire" avec une table "contact" :
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

require_once 'functions.php';

$contenu = '';



$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// $pdo = new PDO('mysql:host=sql313.epizy.com;dbname=epiz_24774743_repertoire', 'epiz_24774743', '0etBIHMKQR', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

var_dump($_POST);

if ($_POST) {  
	// 3- Effectuer les vérifications nécessaires :
	if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) {
		$contenu .= '<div>Le nom doit comporter au moins 2 caractères</div>';
	}

	if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 50) {
		$contenu .= '<div>Le prénom doit comporter au moins 2 caractères</div>';
	}

	if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
			$contenu .= '<div>Le téléphone doit comporter 10 chiffres</div>';
	} 
	
	if (!isset($_POST['type_contact']) || ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre')) {
		$contenu .= '<div>Le type de contact n\'est pas valide</div>';
	}

	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$contenu .= '<div>L\'email n\'est pas valide</div>';
	}


	// 4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.
	if (empty($contenu)) {

		// on upload la photo :
		$photo = '';

		if(!empty($_FILES['photo']['name']))  // si il y a une photo
		{	
			$photo = 'image/' .$_FILES['photo']['name'];  // $photo est le chemin relatif de la photo enregistré dans la base 
			
			copy($_FILES['photo']['tmp_name'], $photo);		// copie du fichier photo, qui est dans $_FILES['photo']['tmp_name']
		
		}

		// on échappe les données de $_POST
		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars($valeur);
		}

		// on prépare la requête et l'exécute
		$query = $pdo->prepare('INSERT INTO contact (nom, prenom, telephone, email, type_contact, photo) VALUES(:nom, :prenom, :telephone, :email, :type_contact, :photo)');

		$succes = $query->execute(array(
				':nom'          => $_POST['nom'],
				':prenom'       => $_POST['prenom'],
				':telephone'    => $_POST['telephone'],
				':email'        => $_POST['email'],
				':type_contact' => $_POST['type_contact'],
				':photo'        => $photo,
		));

		// on met un message de réussite ou d'échec
		if ($succes) {
			$contenu .= '<div>Le contact a été enregistré avec succès<div>';
		} else {
			$contenu .= '<div>Erreur lors de l\'enregistrement<div>';
		}

	}

}


// 2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd.
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un contact</title>
	<style>
		label{
			display: inline-block;
			width: 150px;
			vertical-align: top;
		}
	</style>
</head>
<body>

	<h1>Ajouter un contact</h1>

	<?php echo $contenu; ?>

	<form method="post" action="" enctype="multipart/form-data">
		
		<div class="input-group">
			<label for="nom">Nom</label>
			<input type="text" name="nom" id="nom">
		</div>

		<div class="input-group">
			<label for="prenom ">Prénom</label>
			<input type="text" name="prenom" id="prenom">
		</div>

		<div class="input-group">
			<label for="telephone">Téléphone</label>
			<input type="text" name="telephone" id="telephone">
		</div>

		<div class="input-group">
			<label for="type_contact">Type de contact</label>
			<select name="type_contact" id="type_contact">
				<option>ami</option>
				<option>famille</option>
				<option>professionnel</option>
				<option>autre</option>
			</select>
		</div>

		<div class="input-group">
			<label for="email">Email</label>
			<input type="text" name="email" id="email">
		</div>

		<div class="input-group">
			<label for="photo">photo</label>
			<input type="file" name="photo" id="photo">
		</div>


		<div>
			<input type="submit">
		</div>

	</form>


</body>
</html>