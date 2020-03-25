

<?php
require_once 'inc/init.php';

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$contenu = '';
require_once 'inc/header.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>

<body>

    <div class="row">
        <div class="col-12">
            <h1><?php echo $produit['titre']; ?>    
            </h1>
        </div>
        <div class="col-md-8">
            <img src="<?php echo $produit['photo']; ?>" class="img-fluid" alt="<?php echo $produit['titre']; ?>">
        </div>
        <div class="col-md-4">
            <h3>Description</h3>
            <p>
                <?php echo $produit['description']; ?>
            </p>
            <h3>Détails</h3>
            <ul>
                <li>Catégorie :
                    <?php echo $produit['categorie']; ?>
                </li>
                <li>Couleur :
                    <?php echo $produit['couleur']; ?>
                </li>
                <li>Taille :
                    <?php echo $produit['taille']; ?>
                </li>
            </ul>
            <h4>Prix :
                <?php echo $produit['prix']; ?> €</h4>
        </div>
    </div>
    <!-- .row -->
    <?php
require_once 'inc/footer.php';
?>
</body>

</html>