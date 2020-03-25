<?php
require_once 'inc/init.php';
$message = '';


// 2- Déconnexion de l'internaute :
debug($_GET);

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { // si existe "action" dans l'URL et que sa valeur est "deconnexion" c'est que le membre veut se déconnercter

	unset($_SESSION['membre']); // on supprime l'indice "membre" de la session pour déconnecter le membre
	$message = '<div class="alert alert-info">Vous êtes déconnecté.</div>';

}


// 3- Vérification si membre déjà connecté :
if (estConnecte()) { // si membre déjà connecté alors on le renvoie vers son profil
	header('location:profil.php'); // redirection vers la page profil.php
	exit(); // pour quitter le script
}




// 1- Traitement du formulaire :
// debug($_POST);

if (!empty($_POST)) {   // si le formulaire a été envoyé

	// Validation du formulaire :
	if (empty($_POST['pseudo']) || empty($_POST['mdp'])) { // si le champ pseudo est vide ou le champ mdp est vide
		$contenu .= '<div class="alert alert-danger">Les identifiants sont obligatoires.</div>';
	}

	// S'il n'y a pas d'erreur sur le formulaire, on vérifie le pseudo et le mdp :
	if (empty($contenu)) {  // si vide c'est qu'il n'y a pas d'erreur

		// Requête en BDD des informations du membre pour le pseudo fourni par l'internaute :
		$resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

		if ($resultat->rowCount() == 1) { // s'il y a 1 ligne dans la requête c'est que le pseudo est en BDD

			$membre = $resultat->fetch(PDO::FETCH_ASSOC);  // on fetch l'objet $resultat en un tableau associatif qui contient toutes les informations du membre.

			debug($membre);
			debug(password_verify($_POST['mdp'], $membre['mdp']));
			if (password_verify($_POST['mdp'], $membre['mdp'])) { // si le hash du mdp de la BDD correspond au mdp du formulaire, alors password_verify retourne true
				$_SESSION['membre'] = $membre; // nous créons une session avec les infos du membre provenant de la BDD.  

				// redirection du membre vers son profil :
				//header('location:profil.php');	// redirection vers profil.php
				//exit(); // et on quitte le script

			} else { // s'il y a erreur sur le mdp
				$contenu .= '<div class="alert alert-danger">Erreur sur les identifiants.</div>';
			}



		} else {
			$contenu .= '<div class="alert alert-danger">Erreur sur les identifiants.</div>';
		} 


	} // fin du if (empty($contenu))


} // fin du if (!empty($_POST))



require_once 'inc/header.php';
?>
<h1 class="mt-4">Connexion</h1>
<?php
echo $message;    // pour afficher le message de déconnexion
echo $contenu;    // pour afficher les autres messages
?>
<form method="post" action="">
	
	<div>
		<div><label for="pseudo">Pseudo</label></div>
		<div><input type="text" name="pseudo" id="pseudo"></div>
	</div>

	<div>
		<div><label for="mdp">Mot de passe</label></div>
		<div><input type="password" name="mdp" id="mdp"></div>
	</div>

	<div>
		<input type="submit" value="Se connecter" class="btn btn-info mt-4">
	</div>

</form>

<?php
require_once 'inc/footer.php';
