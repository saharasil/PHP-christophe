<?php
require_once 'inc/init.php';


// 1- vérification de la session :
debug($_SESSION);



require_once 'inc/header.php';
?>
	<h1 class="mt-4">Profil</h1>

	<h2>Bonjour <?php echo $_SESSION['membre']['pseudo']; ?> !</h2><!-- pour afficher le pseudo, il faut aller dans le tableau $_SESSION puis à l'indice ['membre'] puis à l'intérieur à l'indice ['pseudo'] pour accéder à la valeur du pseudo. voir le debug précédent. -->

	<?php 
	if (estAdmin()) {
		echo '<p>Vous êtes un administrateur.</p>';
	}
	?>

	<hr>

	<h3>Informations de profil</h3>
	<p>Email :  <?php echo $_SESSION['membre']['email'];  ?></p>
	<p>Adresse :  <?php echo $_SESSION['membre']['adresse'];  ?></p>
	<p>Code postal :  <?php echo $_SESSION['membre']['code_postal'];  ?></p>
	<p>Ville :  <?php echo $_SESSION['membre']['ville'];  ?></p>


<?php
require_once 'inc/footer.php';
