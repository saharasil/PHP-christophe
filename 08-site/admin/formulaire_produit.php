<?php
require_once '../inc/init.php'; // attention au ../

// 1- on vérifie que le membre est bien admin, sinon on le renvoie vers la page de connexion :
if (!estAdmin()) { // s'il n'est pas administrateur
	header('location:../connexion.php'); // on redirige le membre vers la page de connexion	
	exit();
}


// 4- Insertion du produit en BDD :
// debug($_POST);

if (!empty($_POST)) {  // si le formulaire a été envoyé

	// Ici il faudrait faire 9 conditions pour vérifier que les 9 champs du formulaire sont bien remplis.

	$photo_bdd = '';  // par défaut le champ photo sera vide en BDD

	// 5- Traitement de la photo :
	debug($_FILES); // la superglobale $_FILES a un indice "photo" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.

	if (!empty($_FILES['photo']['name'])) { // si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est en train de télécharger une photo

		$photo_bdd = 'photos/' . $_FILES['photo']['name'];  // $photo_bdd contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.

		copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // on enregistre le fichier photo qui se trouve à l'adresse contenue dans $_FILES['photo']['tmp_name'] vers la destination qui est le dossier "photos" à l'adresse "../photos/nom_du_fichier.jpg".

	}


	// Requête d'insertion en BDD :
	$requete = executeRequete("INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)", array(
											':reference'    => $_POST['reference'],	
											':categorie'    => $_POST['categorie'],	
											':titre'        => $_POST['titre'],	
											':description'  => $_POST['description'],	
											':couleur'      => $_POST['couleur'],	
											':taille'       => $_POST['taille'],	
											':public'       => $_POST['public'],	
											':photo'        => $photo_bdd,  // attention la photo ne vient de $_POST mais de $_FILES	
											':prix'         => $_POST['prix'],	
											':stock'        => $_POST['stock'],	
										  ));

	if ($requete) { // si executeRequete retourne un objet PDOStatement (donc évalué à true implicitement), alors c'est la requête a marché
		$contenu .= '<div class="alert alert-success">Le produit a été enregistré.</div>';
	} else { // sinon c'est qu'on a reçu false parce que la requête n'a pas marché
		$contenu .= '<div class="alert alert-danger">Erreur lors de l\'enregistrement...</div>';
	}
	    

} // fin du if (!empty($_POST))





require_once '../inc/header.php';
// 2- onglets de navigation entre gestion_boutique et formulaire_produit :
?>
	<h1 class="mt-4">Gestion de la boutique</h1>

	<ul class="nav nav-tabs">
		<li><a href="gestion_boutique.php" class="nav-link">Affichage des produits</a></li>
		<li><a href="formulaire_produit.php" class="nav-link active">Formulaire produit</a></li>
	</ul>


<?php
	echo $contenu; 

// 3- Formulaire HTML :	
?>
	<h2 class="mt-4">Ajout d'un produit</h2>

	<form method="post" action="" enctype="multipart/form-data"><!-- l'attribut enctype spécifie que le formulaire envoie des fichiers en plus des données "text" : permet de télécharger un fichier (photo). -->
			
		<div>
			<div><label for="reference">Référence</label></div>
			<div><input type="text" name="reference" id="reference"></div>
		</div>

		<div>
			<div><label for="categorie">Catégorie</label></div>
			<div><input type="text" name="categorie" id="categorie"></div>
		</div>

		<div>
			<div><label for="titre">Titre</label></div>
			<div><input type="text" name="titre" id="titre"></div>
		</div>

		<div>
			<div><label for="description">Description</label></div>
			<div><textarea name="description" id="description"></textarea></div>
		</div>

		<div>
			<div><label for="couleur">Couleur</label></div>
			<div><input type="text" name="couleur" id="couleur"></div>
		</div>
		
		<div>
			<div><label>Taille</label></div>
			<div>
				<select name="taille">
					<option>S</option> <!-- en l'absence d'attribut value, on envoie la valeur entre les <option> dans $_POST -->
					<option>M</option>
					<option>L</option>
					<option>XL</option>
				</select>
			</div>
		</div>

		<div>
			<div><label>Public</label></div>
			<div>
				<input type="radio" name="public" value="m" checked> Masculin
				<input type="radio" name="public" value="f"> Féminin <!-- attention les valeurs des attributs "value" sont les mêmes que celles des enum() du champ correspondant en BDD. -->
				<input type="radio" name="public" value="mixte"> Mixte
			</div>
		</div>

		<div>
			<div><label for="photo">Photo</label></div>
			<div><input type="file" name="photo" id="photo"></div><!-- attention pour pouvoir utiliser le type="file" il ne faut pas oublier l'attribut enctype="multipart/form-data" sur la balise <form>. -->
		</div>

		<div>
			<div><label for="prix">Prix</label></div>
			<div><input type="text" name="prix" id="prix"></div>
		</div>

		<div>
			<div><label for="stock">Stock</label></div>
			<div><input type="text" name="stock" id="stock"></div>
		</div>

		<div><input type="submit" value="Enregistrer" class="btn btn-info mt-4"></div>

	</form>

<?php
require_once '../inc/footer.php';