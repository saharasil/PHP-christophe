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

/*
    La methode exec() est utilisée pour faire des requêtes qui ne retournent pas de jeu de résultats : INSERT, UPDATE, DELETE.

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
debug($resultat); // dans cette objet $resultat, nous ne voyons pas les données concernant Daniel . Pourtant elles  s'y trouvent. Pour y accéder nous devons utiliser une methodes de $resultat qui s'appelle fetch().
//On transforme l'objet de $résultat avec cette méthode fetch() :
    $employe =  $resultat ->fetch(PDO::FETCH_ASSOC);
    debug($employe); // fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $resultat en un ARRAY ASSOCIATIF appelé ici $employe . On y trouve en indices le nom des champs de la requête SQL (on y a mis une * pour avoir tous les champs).
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

//------------------------------------------------------------------------------
echo ' <h2> 02- Faire des requêtes avec query() avec plusieurs résultats </h2>' ;
//------------------------------------------------------------------------------

$resultat = $pdo ->query("SELECT * FROM employes");
debug($resultat);
echo 'Nombre d\'employés : ' . $resultat->rowCount() . '<br>'; // Cette methode rowCount() permet  de compter le nombre de ligne retourner par la requête (exemple : Nombre de produit sélectionner par l'internaute).
// Comme nous avons plusieurs lignes dans $resultat, nous devons faire une boucle pour les pacourir;
while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)){ // fetch()va chercher la ligne suivante du jeu de résultats à chaque tour de boucle, et le transforme en tableau associatif.La boucle while permet de faire avancer le curseur dans l'objet. Quand il arrive à la fin fetch() retourne false et la boucle s'arrête. 
    // debug($employe);// $employe est un array associatif qui contient les données de chaque employés(nous avons 1 employé par tour de boucle).

    echo '<div>';
        echo '<div> Id_employes  : ' .  $employe['id_employes']   . '</div>';
        echo '<div> Nom et prenom  : ' . $employe['nom']  . ' '  .   $employe['prenom'] .'</div>';
        echo '<div> Le service : ' .  $employe['service']   . '</div>';
        echo '<div> Le saliare : ' .  $employe['salaire']   . ' €</div>';
    echo '</div><hr>';
}

//Si votre requête ne donne qu'un seul résultat (par identifiant par exemple), alors on ne fait pas de boucle.
// Si votre requête donne un ou plusieurs résultats, alors on fait une boucle ( sinon on obtient que le premier résultat de la requête).

//-------------------------------------------------------
echo ' <h2> 05-  Exercice  </h2>' ;
//-------------------------------------------------------
// Vous affichez la liste des différents services dans une liste , en mettant un service par <li>



$resultat = $pdo->query("SELECT service FROM employes GROUP BY service");
 //autrement : SELECT DISTINCT service FORM employes 
debug($resultat);

echo '<p> Les services dans  employes sont  ' . $resultat->rowCount() . ' services : </p>';
echo '<ul>';
while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) {
    
    
    echo '<li>' . $employe['service'] . '</li>';
    
}
echo '</ul>';

//-------------------------------------------------------------------------------------
echo ' <h2> 06-  Afficher les résultats de la requête dans une table HTML  </h2>' ;
//-------------------------------------------------------------------------------------

?>
<style>
    table, tr, td, th {
        border : 1px solid black;
    }

    table {
        border-collapse : collapse ;
    }
</style>



<?php

$resultat = $pdo->query("SELECT * FROM employes");


echo'<table>';
    //La ligne des entêtes
    echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Prenom</th>';
        echo '<th>Nom</th>';
        echo '<th>Sexe</th>';
        echo '<th>Service</th>';
        echo '<th>Date d\'embauche</th>';
        echo '<th>Salaire</th>';
    echo '</tr>';
    
    // les lignes du tableau
    while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)){// la boucle while avec le fetch permet de parcourir l'objet $resultat. On crée un tableau associatif $employe à chaque tour de boucle .
    echo '<tr>';
           foreach ($employe as $info){ // $employe étant un tableau, on peut le parcourir avec une foreach. La variable $info prend les valeurs successivement à chaque tour de boucle.
               echo '<td>' . $info . '</td>';

           } 
    echo '</tr>';
    }
echo '</table>';
// Quand on fait 1 tour de while, on fait à l'intérieur 7 tour de foreach pour parcourir 1 employé. Quand la while a parcouru la totalité de $resultat, alors fetch() retourne false et le while s'arrête.
//----------------------------------------------
echo ' <h2> 07-  Requêtes préparées </h2>' ;
//----------------------------------------------
// Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phrases analyse/ interpretation / exécution de la requête (gain de performance).
// Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL (ce que nous verrons dans un chapitre ultérieur).
$nom = 'sennard';
//  Une requête préparée se réalise en trois étapes : 
// 1- On prépare la requête :
$resultat = $pdo->prepare("SELECT *  FROM employes  WHERE nom =:nom");//permet de préparer la requête sans l'exécuter. Elle contient un marqueur :nom qui est vide et attend une valeur. $resultat est à cette ligne  encore un objet PDOstatement .
// 2- On lie le marquer à la variable $nom : 
$resultat->bindParam(':nom', $nom); //bindParam() permet de lier le marqueur à la varible $nom .Notez que cette méthode ne reçoit qu'une variable. On ne peut pas y mettre une valeur fixe comme "sennard" par exemple. Si vous avez besoins de lier le marqueur à une valeur fixe, alors il faut utiliser la méthode binValue(). Exemple : $resultat -> binValue(':nom', 'sennard').
// 3- On exécute la requête : 
$resultat->execute(); // permet d'exécuter toute la requête préparée avec prepare().
debug($resultat);
$employe = $resultat->fetch(PDO::FETCH_ASSOC); // On ne fait pas de boucle ici car il n'ya qu'un seul Sennard
debug($employe);
echo $employe['prenom'] . ' ' . $employe['nom'] . ' ' . $employe['service'] . '<br>';

/*
    valeurs de retour :
    prepare() retourne toujours un objet PODStatement (jeu de résultat)
    execute() : 
        Succés : true
        Echec :  false 
*/
//------------------------------------------------------------
echo ' <h2> 07-  Requêtes préparées sans bindParam() </h2>' ;
//-----------------------------------------------------------
$resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom =:prenom AND nom=:nom" ); //préparation de la requête
$resultat->execute(array(
                        ':nom' => 'chevel',
                        ':prenom' => 'daniel'
                    )); // on peut se passer de bindParam() et associer les marqueurs à leur valeur directement dans un tableau passé en argument de execute()

debug($resultat);
$employe = $resultat->fetch(PDO::FETCH_ASSOC); // pas de boucle car nous n'avons qu'un seul Daniel chevel.
debug($employe);

echo $employe['prenom'] . ' ' . $employe['nom'] . ' est de service ' . $employe['service'];