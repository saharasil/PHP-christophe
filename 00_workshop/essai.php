<!DOCTYPE html>
<?php
// Ce fichier sera inclus au début de tous les scripts du site.

//connexion à la BDD
$pdo = new PDO('mysql: host=localhost;dbname=site', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
        'root',//pseudo de la BDD
        '', //mdp de la BDD
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
        ));

// Créer une session ou l'ouvrir si elle existe
session_start();

//Définir le chemin du site :
define('RACINE_SITE', '/PHP/08_site/'); //constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partie de localhost. Ainsi nous écrions tous les chemins des src ou des href en absolu avec cette constante. Chez un hébergeur vous mettriez '/' si votre site se trouve à la racine de votre hébergement.

// Variable pour afficher du HTML :
$contenu =''; // on se sert de cette varoable partout sur le site.

//Fonction debug
function debug($var){
    echo '<pre>';
    print_r($var); 
    echo '</pre>';

  }

// Fonction liée au membre



// vérifier si le membre est connecté
function estConnecte(){
    if(isset($_SESSION['membre'])){// Si la session contient un indice "membre", c'est que l'internaute est passé par la pagede connection avec les pseudo/mdp.
        return true;// il est connecté
    }else {
        return false;// il n'est pas connécte
    }
}

//Vérifier si le membre est admin et connecté :
function estAdmin(){
    if(estConnecte() && $_SESSION['membre']['statut']== 1){ // si le membre est connécté ET que dans le même temps son statut est 1 (pour admin) nous retournons true :
        return true;
    }else {
        return false; // sinon dans le cas contraire nous retournons false.
    }
}


//Fonction pour exécuter toute les requêtes préparées
function executeRequete($requete, $parametres= array()){
    //Assainissement des données avec htmlspecialchars : on parle d'echapper les données(échappement) : 
    foreach($parametres as $indice => $valeur){
        $parametres[$indice] = htmlspecialchars($valeur); 
    }// on parcours le tableau $parametres qui contient les marqueres et leur valeur . ON prend chaque valeur que l'on passa dans htmlspecialchars() pour transformer les chevreons en entilté html. Cette  valeur une fois assainnie, On la remet dans son emplacement qui est $paramètres[$indice].
    global $pdo; // global permet d'accédre à la variable $pdo qui est définie dans l'espace globale du fichier init.php.
    $resultat = $pdo->prepare($requete);// On preparela requête qui est contenu dans la variable $requete
    $succes = $resultat->execute($parametres);// Puis on l'exécute en donnant le tableau $parametres qui associe les marquers à leur valeur. Execute retourne true si la requête a marché sinon salse, et on affecte ce résultat à la variable $succes.
    if($succes === false){
        return false; // si la requête n'a pas marché, on retourne false.

    }else{
        return $resultat; //en cas de succés on retourne l'objet PDOStatement qui contient le jeu de résultats.
    }
}




//Inclusions des fonctions :
// require_once 'functions.php';
//Traitement du formulaire :
    // debug($_POST);
    if(!empty($_POST)){ // si le formulaire a été envoyé, $post n'est pas vide
        //Validation du formulaire :
            if(!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo'] > 20 )){ //n'existe pas l'indice "pseudo" dans $_Postc'est que le formulaire a été modifié. si la langueur du pseudo est inférieur à 4 ou supérieur à 20, on affiche un message d'erreur à l'internaute.
                $contenu .='<div class="alert alert-danger">Le pseudo doit contenir entre 4 et 20 caractère.</div>';
                
            }
            if(!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp'] > 20 )){ //n'existe pas l'indice "pseudo" dans $_Postc'est que le formulaire a été modifié. si la langueur du pseudo est inférieur à 4 ou supérieur à 20, on affiche un message d'erreur à l'internaute.
                $contenu .='<div class="alert alert-danger">LeMot de passe doit contenir entre 4 et 20 caractère.</div>';
                
            }
            if(!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom'] > 20 )){ //n'existe pas l'indice "pseudo" dans $_Postc'est que le formulaire a été modifié. si la langueur du pseudo est inférieur à 4 ou supérieur à 20, on affiche un message d'erreur à l'internaute.
                $contenu .='<div class="alert alert-danger">Le nom doit contenir entre 2 et 20 caractère.</div>';
                
            }
            if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom'] > 20 )){ //n'existe pas l'indice "pseudo" dans $_Postc'est que le formulaire a été modifié. si la langueur du pseudo est inférieur à 4 ou supérieur à 20, on affiche un message d'erreur à l'internaute.
                $contenu .='<div class="alert alert-danger">Le prenom doit contenir entre 2 et 20 caractère.</div>';
                
            }
            if(!isset($_POST['email']) || strlen($_POST['email'] > 50) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){ //la fonction filter_var() retourne true si $_POST['email] est bien de format email, sinon elle retourne false( ici on met un "!" pour NOT car on veut vérifier qu'il NE s'agit PAS d'un email).
                $contenu .='<div class="alert alert-danger">L\'email n\'est pas valide .</div>';
                
            }
            if(!isset($_POST['civilite']) || ($_POST['civilite']!= 'm' && $_POST['civilite']!= 'f')){
                $contenu .= '<div class="alert alert-danger">La civilité n\'est pas valide.</div>';

            }
            if(!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville'] > 20 )){ //n'existe pas l'indice "pseudo" dans $_Postc'est que le formulaire a été modifié. si la langueur du pseudo est inférieur à 4 ou supérieur à 20, on affiche un message d'erreur à l'internaute.
                $contenu .='<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractère.</div>';
                
            }

            if(!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])){ //preg_match() vérifier si le code postal correspond à l'expression régilière précisee.
                $contenu .='<div class="alert alert-danger">Le code postal n\'est pas valide .</div>';
                /* LA regex s'écrit entre #
                le ^ définit le début de l'expression
                le  $ définit la fin de l'expression
                [0-9]  définit l'intervalle des chiffres autorisés
                {5} définit que l'on en veut 5 précisément 
                */
            }

            if(!isset($_POST['adresse']) || strlen($_POST['adresse']) < 1 || strlen($_POST['adresse'] > 50 )){ //n'existe pas l'indice "pseudo" dans $_Postc'est que le formulaire a été modifié. si la langueur du pseudo est inférieur à 4 ou supérieur à 20, on affiche un message d'erreur à l'internaute.
                $contenu .='<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';  
            }


            // S'il n'ya pas d'erreur sue le formulaire, on vérifie que le pseudo est disponible puis on insère le membre en BDD

            if(empty($contenu)){ // si la variable est vide, c'est qu'il n'y a pas d'erreur sur le formulaire 
                    //on sélectionne le pseudo en BDD :
                    $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));
                  if($membre->rowCount() > 0){ // si la reqrête retourne des lignes c'est que le pseudo existe déjà
                    $contenu .= '<div class="alert alert-danger">Le pseudo est indisponible. Veuillez en choisir un autre.</div>'; 

                  }else {//si non on inscrit le membre en BDD
                    $mdp = password_hash($_POST['mdp'],PASSWORD_DEFAULT); //cette fonction prédéfinie permet de hasher le mot de passe selon l'algorithme actuel"bcrypt". Il faudra lors de la connexion comparer le hash de la BDD avec celui du mot de passe de l'internaute.
                    $succes = executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) 
                    VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)",
                     array(
                         ':pseudo'         => $_POST['pseudo'],
                         ':mdp'            => $mdp, //On prend le mdp hashé
                         ':nom'            => $_POST['nom'],
                         ':prenom'         =>$_POST['prenom'],
                         ':email'          =>$_POST['email'],
                         ':civilite'       =>$_POST['civilite'],
                         ':ville'          =>$_POST['ville'],
                         ':code_postal'   =>$_POST['code_postal'],
                         ':adresse'         =>$_POST['adresse'],
                    ));
                    if($succes){
                        $contenu .= '<div class="alert alert-succes">Vous êtes inscrit.<a href="connexion.php">Cliquez ici pour vous connecter.</a></div>';
                    }else {
                        $contenu .='<div class="alert alert-danger">Erreur lors de l\'enregistrement. Veuillez essayer ultérieurement.</div>';  
                    }

                  }


            }// fin du if (!empty($contenu))
        
    }// fin du if (!empty($_POST))

?>

    
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
            <a class="navbar-brand" href="<?php echo RACINE_SITE . 'index.php'; ?>">MA BOUTIQUE</a><!-- on utilise la constante RACINE_SITE pour faire unchemin absolu vers l'index.php-->
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
    
    
    
    
    
    
     



    <h1 class="mt-4">Inscription</h1>
<?php
   echo $contenu; //pour afficher les messages
?>
    <form action="" method="post">
        <div>
            <div><label for="pseudo">Pseudo</label></div>
            <div><input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo']?? '' ;?>"></div>
        </div>
        <div>
            <div><label for="mdp">Mot de passe</label></div>
            <div><input type="password" name="mdp" id="mdp" value=""></div>
        </div>
        <div>
            <div><label for="nom">Nom</label></div>
            <div><input type="text" name="nom" id="nom" value="<?php echo $_POST['nom']?? '' ;?>"></div>
        </div>
        <div>
            <div><label for="prenom">Prenom</label></div>
            <div><input type="text" name="prenom" id="prenom" value="<?php echo $_POST['prenom']?? '' ;?>"></div>
        </div>
        <div>
            <div><label for="email">Email</label></div>
            <div><input type="text" name="email" id="email" value="<?php echo $_POST['email']?? '' ;?>"></div>
        <div>
            <div><label>Civilité</label></div>
            <div><input type="radio" name="civilite" value="m" checked>Homme</div>
            <div><input type="radio" name="civilite" value="f" <?php if(isset($_POST['civilite']) && $_POST['civilite']=='f') echo 'checked'  ;?> >Femme</div>
        </div>
        <div>
            <div><label for="ville">Ville</label></div>
            <div><input type="text" name="ville" id="ville" value="<?php echo $_POST['ville']?? '' ;?>"></div>
        </div>
        <div>
            <div><label for="code_postal">Code postal</label></div>
            <div><input type="text" name="code_postal" id="code_postal" value="<?php echo $_POST['code_postal']?? '' ;?>"></div>
        </div>
        <div>
            <div><label for="adresse">Adresse</label></div>
            <div><textarea type="text" name="adresse" id="adresse" value=""><?php echo $_POST['adresse']?? '' ;?></textarea></div>
        </div>
        <div><input type="submit" value="S'inscrire" class="btn btn-info"></div>

    </form>

<?php
    // echo RACINE_SITE . 'index.php';
// require_once 'inc/footer.php';

