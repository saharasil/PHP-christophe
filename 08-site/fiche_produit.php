<?php
require_once 'inc/init.php';

debug($_GET);   // pour vérifier que l'on reçoit une info par l'URL.

if (isset($_GET['id_produit'])) {  // si existe l'indice "id_produit" dans $_GET, donc dans l'URL, c'est qu'on a demandé le détail d'un produit.

	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));  // on associe le marqueur vide à l'id_produit qui provient de l'URL.

	// On vérifie que le produit demandé existe bien en BDD :
	if ($resultat->rowCount() == 0) { // s'il y a 0 ligne dans $resultat c'est que le produit n'existe pas.
		header('location:admin/gestion_boutique.php'); // on redirige vers la gestion boutique.
		exit();
	} 	

	// On prépare le produit à afficher :
	$produit = $resultat->fetch(PDO::FETCH_ASSOC); // on ne fait pas de boucle car il n'y a qu'un seul produit demandé par id_produit.

	debug($produit); // on voit que $produit est un tableau avec tous les champs de la requête en indices.


} else { // sinon c'est que l'on n'a pas demandé un produit en particulier en arrivant sur cette page
	header('location:admin/gestion_boutique.php');	// on redirige alors le membre vers la gestion boutique
	exit(); // et on quitte le script.
}



require_once 'inc/header.php';





require_once 'inc/footer.php';