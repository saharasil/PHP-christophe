<?php
require_once 'inc/init.php';
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



require_once 'inc/header.php';
?>
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
require_once 'inc/footer.php';

