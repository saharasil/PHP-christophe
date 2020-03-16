<?php
//Fonction debug
function debug($var){
    echo '<pre>';
    print_r($var); 
    echo '</pre>';

  }

// Fonction liée au membre



// vérifier si le membre est connecté
function estConnecte(){
    if(isset($_SESSION['membre'])){// Si la session contient un indice "membre", c'est que l'internaute est passé par la page de connecxion avec les pseudo/mdp.
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


