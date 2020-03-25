<?php

// Fonction de debug

function debug($var) {
	echo '<pre>';
		print_r($var);
	echo '</pre>';
}

// Fonctions liées au membre
// Vérifier si le membre est connecté
function estConnecte() {

	if (isset($_SESSION['membre'])) { // si la session contient un indice "membre", c'est que l'internaute est passé par la page de connexion avec les bons pseudo/mdp
		return true; // il est connecté
	} else {
		return false; // il n'est pas connecté
	}	
}

// Vérifier si le membre est admin et connecté :
function estAdmin() {

	if (estConnecte() && $_SESSION['membre']['statut'] == 1) { // si le membre est connecté ET que dans le même temps son statut est 1 (pour admin), nous retournons true : 
		return true;
	} else {
		return false; // sinon dans le cas contraire nous retournons false.
	}
}


// Fonction pour exécuter toutes les requêtes préparées :
function executeRequete($requete, $parametres = array()) {

	// Assainissement des données avec htmlspecialchars : on parle d'échapper les données (échappement) :
	foreach ($parametres as $indice => $valeur) {
				$parametres[$indice] = htmlspecialchars($valeur);	
	} // on parcourt le tableau $parametres qui contient les marqueurs et leur valeur. On prend chaque valeur que l'on passe dans htmlspecialchars() pour transformer les chevrons en entité HTML. Cette valeur une fois assainnie, on la remet dans son emplacement qui est $parametres[$indice]. 

	global $pdo; // global permet d'accéder à la variable $pdo qui est définie dans l'espace global du fichier init.php.

	$resultat = $pdo->prepare($requete);  // on prépare la requête qui est contenue dans la variable $requete.
	$succes = $resultat->execute($parametres); // puis on l'exécute en donnant le tableau $parametres qui associe les marqueurs à leur valeur. execute() retourne true si la requête a marché sinon false, et on affecte ce résultat à la variable succes.

	if ($succes === false) {
		return false; // si la requête n'a pas marché, on retourne false.
	} else {
		return $resultat;  // en cas de succès on retourne l'objet PDOStatement qui contient le jeu de résultats.
	}

}








