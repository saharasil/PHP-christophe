<?php
require_once '../inc/init.php'; // attention au ../

// 1- on vérifie que le membre est bien admin, sinon on le renvoie vers la page de connexion :
if (!estAdmin()) { // s'il n'est pas administrateur
	header('location:../connexion.php'); // on redirige le membre vers la page de connexion	
	exit();
}


// 3- affichage des produits dans une table HTML
$resultat = executeRequete("SELECT * FROM produit"); // on sélectionne tous les produits de la BDD. $resultat est un objet PDOStatement car il provient d'un SELECT.	

$contenu .= '<p>Nombre de produits dans la boutique : '. $resultat->rowCount() .'</p>';

$contenu .= '<div class="table-responsive">';
	$contenu .=  '<table class="table">';

	// Affichage des entêtes du tableau :
	$contenu .= '<tr>';
		$contenu .= '<th>id produit</th>';
		$contenu .= '<th>référence</th>';
		$contenu .= '<th>catégorie</th>';
		$contenu .= '<th>titre</th>';
		$contenu .= '<th>description</th>';
		$contenu .= '<th>couleur</th>';
		$contenu .= '<th>taille</th>';
		$contenu .= '<th>public</th>';
		$contenu .= '<th>photo</th>';
		$contenu .= '<th>prix</th>';
		$contenu .= '<th>stock</th>';
		$contenu .= '<th>voir</th>';
	$contenu .= '</tr>';

	// Affichage des lignes du tableau :
	while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)) {
		//debug($produit);
		$contenu .= '<tr>';
			$contenu .= '<td>' . $produit['id_produit'] . '</td>'; 
			$contenu .= '<td>' . $produit['reference'] . '</td>'; 
			$contenu .= '<td>' . $produit['categorie'] . '</td>'; 
			$contenu .= '<td>' . $produit['titre'] . '</td>'; 
			$contenu .= '<td>' . substr($produit['description'], 0, 10) . '...</td>'; // on coupe la description avec la fonction substr() à partir du caractère 0 et sur 10 caractères.
			$contenu .= '<td>' . $produit['couleur'] . '</td>';
			$contenu .= '<td>' . $produit['taille'] . '</td>';
			$contenu .= '<td>' . $produit['public'] . '</td>';
			$contenu .= '<td><img src="../'. $produit['photo'] .'" style="width:90px"></td>'; 
			$contenu .= '<td>' . $produit['prix'] . ' €</td>';
			$contenu .= '<td>' . $produit['stock'] . '</td>';
			$contenu .= '<td>
							<a href="../fiche_produit.php?id_produit='. $produit['id_produit'] .'">voir le produit</a>
						 </td>'; // à partir du "?" on envoie dans le tableau $_GET du fichier fiche_produit.php un indice "id_produit" et sa valeur correspondante. A chaque tour de boucle while, nous créons un tableau $produit qui contient toutes les infos de chaque produit, dont l'id_produit. Nous envoyons cette valeur dans $_GET de fiche_produit.php.
		$contenu .= '</tr>';
	}

	$contenu .= '</table>';
$contenu .= '</div>';



require_once '../inc/header.php';
// 2- onglets de navigation entre gestion_boutique et formulaire_produit :
?>
	<h1 class="mt-4">Gestion de la boutique</h1>

	<ul class="nav nav-tabs">
		<li><a href="gestion_boutique.php" class="nav-link active">Affichage des produits</a></li>
		<li><a href="formulaire_produit.php" class="nav-link">Formulaire produit</a></li>
	</ul>


<?php
echo $contenu;  // pour afficher la table HTML de tous les produits

require_once '../inc/footer.php';