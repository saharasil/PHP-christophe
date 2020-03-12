<?php
require_once 'inc/init.php';
$messages = '';

//2- Déconnexion de l'internaute :
debug($_GET);
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){// si existe "action" dans l'URL et que sa valeur est "deconnexion" c'est que le membre veut se déconnecter
    unset($_SESSION['membre']); // on supprime l'indice "membre " de la session pour déconnecter le membre
    $message = '<div class="alert alert-info">Vous êtes déconnecté . </div>';

}

//1-Traitement du formulaire :
    debug($_POST);
    if(!empty($_POST)){ // si le formulaire a été envoyé
        //Validation de formulaire:
            if(empty($_POST['pseudo']) || empty($_POST['mdp'])){ // si le champpseudo est vide ou le champ mdp est vide
                $contenu .= '<div class="alert alert-danger">Les ifdentifiants sont obligatoires.</div>';
            }
            //si il n'ya pas d'erreur sur le formulaire, on vérifie lepseudo et le mdp :
                if(empty($contenu)){ // si vide c'est qu'il n'ya pas d'erreur
                    //Requête en BDD des informations membre pour le pseudo fourni par l'internaute :
                        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));
                        if($resultat ->rowCount() == 1){ // s'il y a 1 ligne dans la requête c'est que le pseudo est en BDD
                            $membre = $resultat->fetch(PDO::FETCH_ASSOC); // on fetch l'objet $resultat en un tableau associatif qui contient touts les informations  du membre.
                            debug($membre);
                            if(password_verify($_POST['mdp'], $membre['mdp'])){// si le hash du mdp de la BDD correspond au mdp du formulaire, alors pasword_verify retourne true
                                $_SESSION['membre'] = $membre;//nous créons une session avec les information du membre provenant de la BDD.
                                //redirection du membre vers son profil :
                                header('location:profil.php');///redirection vers profil.php
                                exit(); // et on quitte le script

                            }else {//s'il y a erreur sur le mdp
                                $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants.</div>';
                            }
                            
                        }else {
                            $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants.</div>';
                        }

                }

    }



require_once 'inc/header.php';

?>
<h1 class="mtm4"> Connexion</h1>
<?php
echo $messages; //pour afficher le message de déconnexion 
echo $contenu; // pour afficher les autres messages

?>
<form action="" method="post">
        <div>
            <div><label for="pseudo">Pseudo</label></div>
            <div><input type="text" name="pseudo" id="pseudo" ></div>
        </div>
        <div>
        <div><label for="mdp">Mot de passe</label></div>
            <div><input type="password" name="mdp" id="mdp" value=""></div>
        </div>
        <div>
            <div>
                <input type="submit" value="Se connecter" class="btn btn-info">
            </div>







</form>


































<?php

require_once 'inc/footer.php';