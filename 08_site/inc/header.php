<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ma boutique</title>
</head>
<body>
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- La marque  -->
        <a class="navbar-brand" href="<?php echo RACINE_SITE . 'index.php'; ?>">MA BOUTIQUE</a><!-- on utilise la constante RACINE_SITE pour faire un chemin absolu vers l'index.php-->
        <!-- Le burger -->
        <!-- Le menu  -->
        <div class="collapse navbar-collapse" id="nav1">
            <ul class="navbar-nav ml-auto">
                <?php 
                echo '<li><a class="nav-link" href="'. RACINE_SITE .'index.php">Boutique</a></li>';
                if(estConnecte()){ // Si le membre est connecté
                echo '<li><a class="nav-link" href="' . RACINE_SITE . 'profil.php">Profil</a></li>';
                echo '<li><a class="nav-link" href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se deconnecter</a></li>';
                }else { // Si le membre non connecté
                echo '<li><a class="nav-link" href="' . RACINE_SITE . 'inscription.php">Inscription</a></li>';
                echo '<li><a class="nav-link" href="' . RACINE_SITE . 'connexion.php">Connexion</a></li>';
                } // Fin du if (estConnecte())
                echo '<li><a class="nav-link" href="' . RACINE_SITE . 'panier.php">Panier</a></li>';
                if (estAdmin()){ // Si le membre est connecté et admin
                    echo '<li><a class="nav-link" href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a></li>';
                }
                
                
            ?>
            </ul>
        </div>
    </div> <!--.container-->
</nav>

<!-- Début du contenu de la page  -->
<div class="container" style="min-height: 80vh;">
    <div class="row">
        <div class="col-12"><!--ces balises sont ouvertes dans le header.php mais fermées dans le footer.php-->






