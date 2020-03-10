<?php
//----------------------------
//                PDO
///----------------------------

// L'extension PDO pour PHP Data Objects définit une interface qui permet d'exécuter des requêtes SQL dans du PHP.

require_once '../01_bases/fonctions.php';


//-------------------------------------------------------
echo ' <h2> 01- Connexion à la BDD </h2>' ;
//-------------------------------------------------------

$pdo = new PDO('mysql: host=localhost;dbname=entreprise', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
              'root',//pseudo de la BDD
              '', //mdp de la BDD
              array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
              )            
);

//$pdo ci-dessus est un objet qui représente la connexion à la BDD entreprise
debug($pdo);
debug(get_class_methods($pdo)); // permet d'afficher la liste des méthodes présentes dans l'objet $pdo.

//-------------------------------------------------------
echo ' <h2> 02- Faire des requêtes avec exec() </h2>' ;
//-------------------------------------------------------

// on va insérer un employé en BDD : 
$resultat =  $pdo -> exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUE ('John', 'Doe', 'm', 'informatisue','2020-03-09',2000)");
/*La methode exec() est utilisée pour faire des requêtes qui ne retournent pas de jeu de résultats : INSERT, UPDATE, DELETE.

    valeur de retour : 
        Succés : indique le nombre de lignes affectées par la requête
        Echec : false
*/
echo 'Nombre d\'enregistrements affectés par la  requête : ' . $resultat . '<br>';
echo 'Denier id généré en BDD : ' . $pdo ->lastInsertId();
//Supprimer les John Doe de la BDD :
$resultat =  $pdo -> exec("DELETE FROM employes WHERE prenom ='John' AND nom = 'Doe'");


//-------------------------------------------------------
echo ' <h2> 02- Faire des requêtes avec query() </h2>' ;
//-------------------------------------------------------

// on va selectionner les information de l'employé Daniel : 

    $resultat = $pdo -> query("SELECT * FROM employes WHERE prenom = 'Daniel'") ;

/* 
Au contraire d'exec(), query() est utilisé pour faire des requêtes qui retournent un ou plusieurs  résultat : SELECT. On peut aussi l'utiliser avec DELETE, UPDATE et INSERT.

valeur de retour :
    succés : query() retourne un nouvel objet qui provient de la classe PDOStatement
    Echec : False
*/
debug($resultat); // dans cette objet $ resultat, nous ne voyons pas les données concernant Daniel . Pourtant elles  s'y trouvent. Pour y accéder nous devons utiliser une methodes de $resultat qui s'appelle fetch().
//On transforme l'objet de $résultat avec cette méthode fetch() :
    $employe =  $resultat -> fetch(PDO::FETCH_ASSOC);
    debug($employe); // fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $resultat en un ARRAy ASSOCIATIF appelé ici $employe . On y trouve en indices le nom des champs de la requête SQL (on y a mis une * pour avoir tous les champs).
    echo 'Je suis ' . $employe['prenom'] .' ' . $employe['nom'] . 'du service ' . $employe['service'] . '<br>' ;
/* 
Pour l'information , on peut mettre dans les parnthéses de fetch() : 
    PDO::FETCH_NUM   pour obtenir un tableau aux indices numériques 
    PDO:: FETCH_OBJ  pour obtenir un dernier objet
    ou encore des () vides  pour obtenir un mélange de tableau associatif et numérique

*/
//---------------
//Exercice : afficher le service de l'employé dont l'id_employé est  417 .

$resultat = $pdo -> query("SELECT service FROM employes WHERE id_employes = 417") ;
debug($resultat);
$employe =  $resultat -> fetch(PDO::FETCH_ASSOC);
debug($employe);
echo 'Le service de l\'employe dont id_employes est 417  : ' . $employe['service'] .'<br>'; 