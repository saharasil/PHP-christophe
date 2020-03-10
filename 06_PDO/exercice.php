<h1>Les commerciaux et leur salaire</h1>
<?php
//vous affichez dans une liste le prenom le nom et le salaire des employés appartenent au service commerciale (un <li< par commerciale). vous utiliser une requête préparée.
// Vous affichez le nombre de commerciaux
require_once '../01_bases/fonctions.php';
//connexion à la BDD : 2 méthode : avec require_once ou directement avec $pdo
require_once '../01_bases/connexion.php'; 
// $pdo = new PDO('mysql: host=localhost;dbname=entreprise', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
//               'root',//pseudo de la BDD
//               '', //mdp de la BDD
//               array(
//                     PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
//                     PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
//               )            
// );

//la requête :
$service = 'commercial';
$resultat = $pdo->prepare("SELECT prenom, nom, salaire  FROM employes  WHERE service = :service");
debug($resultat);
$resultat->bindParam(':service', $service);
$resultat->execute();
// debug($resultat->rowCount());
// la boucle et le fetch :
    echo '<ul>';
while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { // on fait une boucle car il y a plusieurs commerciaux
    echo '<li>';
   foreach($employe as $indice => $info){ 
     echo 'Le ' . $indice  .' : ' . $info . '<br>  ' ;
 
    } 
  echo'</li>';
}
  
echo'</ul>';

// nombre de commerciaux :
echo '<p> le nombre de commerciaux est : ' . $resultat->rowCount() . '</p>'; //permet de compter le nombre de ligne dans le jeu de résultat qui provient de la requête de selection.

