<?php
require_once 'inc/init.php';
$message = '';
// 2- Deconnexion de l'internaute : 
debug($_GET);
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){ // Si existe "action" dans l'url et que sa valeur est "deconnexion" c'est que le membre veut se deconnecter
    unset($_SESSION['membre']); // Ici on supprime l'indice "membre" de la session pour deconnecter le membre
    $message = '<div class="alert alert-info">Vous êtes deconnecté.</div>';
}
// 3- Vérification si membre connecté : 
    if (estConnecte()) { // Si membre déjà connecté alors on le renvoie vers son profil
        header('location:profil.php'); //("header"fonction prédéfinie) redirection vers la page profil.php
        exit(); // Pour quitter le script
    }
// 1- Traitement du formulaire
//debug($_POST);
if (!empty($_POST)) { // Si le formulaire a été envoyé
    // Validation du formulaire 
    if(empty($_POST['pseudo']) || empty($_POST['mdp'])){ // Si le champs est vide ou le champs mdp est vide.
        $contenu .= '<div class="alert alert-danger">Les identifiants sont obligatoires.</div>';
    }
    // S'il n'y a pas d'erreur sur le formulaire, on vérifie le pseudo et le mdp : 
        if(empty($contenu)) { // Si vide c'est qu'il n'y a pas d'erreur
            // Requête en BDD des informations membre pour le pseudo fourni par l'intenaute :
                $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' =>$_POST['pseudo']));
            if ($resultat->rowCount() == 1) { // Si il y a une ligne dans la requête, c'est que le pseudo est en BDD
                
                $membre = $resultat->fetch(PDO::FETCH_ASSOC); // On fetch() l'objet $resultat en un tableau associatif qui contient toutes les informations du membre.
                debug($membre);
                
                if(password_verify($_POST['mdp'], $membre['mdp'])){ // Si le hash du mdp de la BDD correspond au mdp du formualaire alors password_verfy retourne true.
                    $_SESSION['membre'] = $membre; // Nous créons une session avec les informations du membre provenant de la BDD.      
                    
                    // Redirection du membre vers son profil : 
                    header('location:profil.php'); // Redirection vers profil.php
                    exit(); // Et on quitte le script
                    
                    
                } else{// Si il y a erreur sur le mdp.
                $contenu .= '<div class="alert alert-danger"> Erreur sur les identifiants.</div>';
                }                
            } else { 
            $contenu .= '<div class="alert alert-danger"> Erreur sur les identifiants.</div>';
            }
        } // Fin du if (empty($contenu))
}// fin du if (!empty($_POST))
require_once 'inc/header.php';
?>
<h1 class="mt-4">Connexion</h1>
<?php
echo$message;   // Pour afficher le message de deconnexion
echo$contenu;   // Pour afficher les autres messages de deconnexion
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
        <input type="submit" value="Se connecter" class="btnn btn-info">
    </div>
</form>
<?php
require_once 'inc/footer.php';