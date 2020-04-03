<?php
// Fonction pour débugé
function debug($var){
    echo '<pre class="border border-dark bg-light text-primary">';
    print_r($var); 
    echo '</pre>';

  }

  // Fonction pour effectuer les requêtes
  // function executeRequete($requete, $parametres = array()) {
  //   foreach ($parametres as $indice => $valeur) {
  //         $parametres[$indice] = htmlspecialchars($valeur);	
  //   } 
  //   global $pdo; 
  //   $resultat = $pdo->prepare($requete);  
  //   $succes = $resultat->execute($parametres); 
  //   if ($succes === false) {
  //     return false;
  //   } else {
  //     return $resultat;  
  //   }
  
  // }