<?php
//Fonction debug
function debug($var){
    echo '<pre>';
    print_r($var); 
    echo '<pre>';

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