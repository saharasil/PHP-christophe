<style>
    h2 {
        border-top : 1px solid navy;
        border-bottom : 1px solid navy;
        color : navy;
    }
table, td{
        border : 1px solid black; 
        border-collapse: collapse;
        padding : 50px;
        background : #ffc0d0;
        color : black;
    }
  

</style>

<?php 
require_once 'fonctions.php'; // pour inclure la fonction debug() dans le fichier
//-------------------------------
echo ' <h2>1- Les balises PHP </h2>' ;
//-------------------------------

?>
<?php 
// Pour ouvrir un passage en PHP on utilise  la balise  précédente
// Pour fermer un passage en PHP on utilise la balise suivante :
?>

<p><a href="#bas">Bonjour</a></p> <!-- en dehors des balises du PHP nous pouvons écrire du HTML dans fichier ayant l'extention .php ( ce n'est pas possible dans un fichier .html) -->


<?php 
// vous n'ête pas obligé de fermer un pasage en PHP en fin de script.
// pour faire un commentaire su 1 seule ligne
# pour faire un commentaire sur une seule ligne 
/*
pour faire 
des comentaires
surr plusieurs 
lignes
*/

//-------------------------------
echo ' <h2> 2- Affichage </h2>' ;
//-------------------------------

echo ' Bonjour <br> '; // echo est une instruction qui permet d'effecuter un affichage. Nous pouvons y mettre du HTML. Toutes les instructions se terminent par un ";"  en PHP .
print ' Nous sommes lundi <br>'; // print est une autre instruction d'affichage
var_dump('code ') ;
echo '<br>';
print_r('code'); // ces deux fonctions d'affichage permettent d'analyer dans le navigateur le contenu d'une variable par exemple (nous en verrons l'utilisation plus tard).

//-------------------------------
echo ' <h2> 3- Les variables </h2>' ;
//-------------------------------

// Une variable est un espace mémoir qui porte un nom et qui permet de conserver une valeur . Cette valeur peut être de n'importe quel type .
// En PHP on représente une variable avec le signe "$".

$a = 127; // on déclare la variable $a et lui affecte la valeur 127.

// echo gettype($a); //gettype() est une fonction prédifine qui permet de voir le type d'une variable ici il s'agit d'un integer (entier).
echo'<br>';

$a = 1.5;
echo gettype($a); /// ici il s'agit d'un double (nombre à virgule) 
echo'<br>';

$a = 'une chaine de caractéres';
echo gettype($a); /// ici il s'agit d'un string (chaine de caractére)
echo'<br>';

$a = '127'; 
echo gettype($a); /// un nombre écrit en quotes  ou guillemets est interpréter comme un string.
echo'<br>';

$a = true ; // ou false 
echo gettype($a); // ici il s'agit d'un boolean ( booléen).
echo'<br>';

// Par convention un nom de variable commence par un miniscule puis on met une majusscule à chaque mot .Il peut contenir des chiffres (jamais au début) ou un "_" (pas au début ni à la fin).
// Exemple : $maVAriable1

//-------------------------------
echo ' <h2>4- Concaténation  </h2>' ;
//-------------------------------

// En PHP on cacatène avec le "."
$x = 'Bonjour';
$y = ' tout le monde ';


echo  $x . $y . '<br>' ;  // on concaténe les deux variables et le string avec le point que l'ont peut traduire par "suivi de " .

//------------------
// concaténation et affectation  combinées avec l'opérateur " .= "
$prenom = 'Nicolas';
$prenom .= '- Marie'; // on ajoute la valeur "-Marie" à la valeur "Nicolas" SANS la remplacer gràce à l'operateur  ".="
echo $prenom . '<br>'; // affiche " Nicolas - Marie"

//-------------------------------
echo ' <h2>5- Guillemets et quotes  </h2>' ;
//-------------------------------

$message = "aujourd'hui";
$message = 'aujourd\'hui'; //on échappe les apostrophes quand on écrit dans les quotes simples avec "\"
$txt = 'Bonjour';
echo " $txt tout le monde <br>"; // dans les guillemets la variabe est évaluée  : c'est sont contenu qui est affiché
echo ' $txt tout le monde <br>'; // dans des quotes simples , $txt est considéré comme une chaine de caractères brute : on affiche littéralement .

//-------------------------------
echo ' <h2>6- Les constantes </h2>' ;
//-------------------------------

// une constante permet de conserver une valeur sauf que celle-ci ne peut pas changer. C'est à dire  qu'on ne pourra pas la modifier durant l'exécution du script . Utile par exemple pour conserver les paramtres de connexion à la BDD de façon certaine .
define('CAPITALE_FRANCE', 'paris'); // par convention une constante  s'écrit toujours en MAJUSCULE . Ici on déclare la constante CAPITALE_FRANCE à laquelle on affecte 'paris'
echo CAPITALE_FRANCE . '<br>' ; // affiche Paris 
// Autre syntaxe pour déclarer une constante : 
const TAUX_CONVERSION = 6.55957; // on peut aussi déclarer une constante avec le mot clé const.
echo TAUX_CONVERSION . '<br>'; // affiche 6.55957
//---------
//Exercice : Vous afficher Bleu-Blab-Rouge  en mettant le texte de chaque couleur dans des variables 
$couleur1 = 'Bleu-';
$couleur2 = 'Blanc-';
$couleur3 = 'Rouge';
echo $couleur1 . $couleur2 . $couleur3 . '<br>' ;
echo "$couleur1$couleur2$couleur3 <br>"; 

$couleur = 'Bleu-';
$couleur .= 'Blanc-';
$couleur .= 'Rouge';
echo $couleur . '<br>';
//-------------------------------
echo ' <h2>7- Opérateurs arithmétiques </h2>' ;
//-------------------------------
$a = 10;
$b = 2;
echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // afffiche 8
echo $a * $b . '<br>'; // afffiche 20
echo $a / $b . '<br>'; // afffiche 5
echo $a % $b .'<br>' ; // affiche 0 modulo = reste de la division entière.

// Operation et affectation combinées :
 $a = 10;
 $b = 2;
 $a += $b; // équivaut à $a = $a + $b soit $a = 10 + 2, $a vaut donc 12 au final 
  
 $a -= $b ; //équivaut à $a = $a - $b soit $a = 10 - 2, $a vaut donc 10 au final
 // on utilise ces opérateurs dans les paniers d'achat par exemple .
 // ilexiste aussi les opérateur *= /= et %= 
 //------
 // Inctrémenter et décrémenter 
$i = 0; 
$i++; // on augmente $i de 1
$i--; // on diminue  $i de 1($i vaut donc 0 ici)



//-------------------------------
echo ' <h2> 8- Structures conditionnelles </h2>' ;
//-------------------------------
$a = 10;
$b = 5;
$c = 2;
// if ..... else :
    if ($a > $b){ // si la condition est vrai , c'est-à-dire $a est supérieur à $b alors on exécute les acolades qui suivent:
        echo '$a est supérier à $b <br>';

    } else { // si la condition est fausse on exécute le else :
        echo 'Non c\'est $b qui est supérieur ou égal à $a <br>';
    }

// l'opérateur AND qui s'écrit  && 
    if ($a > $b && $b> $c){ // si $a est supérieur à $b et que dans le même temps $b est spérieur à $c, alors on entre dans les accoloades :
        echo 'OK pour les deux conditions <br>';

    }

// l'operateur OR qui s'écrit || 
    if ( $a == 9 || $b > $c){ // si $a est égal (== pour comparer en valeur ) à 9 ou alors $b > $c , alors on exécutes les accolades qui suivent :
        echo ' OK pour au moins une des deux conditions <br>';

    }else { // sinon c'est que les deux conditions sont fausses
        echo ' les deucx conditions sont fausse ';
    }

// if ... elseif .... else :
        if($a == 8){ // si $a est égal à 8
            echo 'réponse 1 : $a est égal à 8';
        } elseif($a != 10){ // sinon si $a est différent de 10
            echo 'reponse 2 : $a est différent de 10';
        } else{ //sinon, si nous ne somes pas entrés dans le if ni dans le elseif, on entre dans le else :
            echo 'réponse 3 : les 2 conditions précédentes sont fausses <br>';
        }
    
// La condition ternaire
// La ternaire est une autre syntaxe pour écrire un if ...else .
    $a = 10 ;
    echo ($a == 10) ? '$a est égale à 10 <br>' :  '$a est différent de 10 <br>'  ; // dans la ternaire le "?" remplace le if et le ":" remplace le else . Ainsi on dit : si $a est égal à 10 , on affiche la première expression sinon la seconde.

//-------------
// Comparaison avec == et === 
    $varA = 1 ; // integer
    $varB = '1'; // string
    if($varA == $varB){ // la condition est vrai car en valeur 1 et '1' sont équivalents
        echo '$varA est égal à $varB en valeur uniquement <br>';
    }
    if ($varA === $varB){ // la condition est fausse car 1 et '1' sont différents en type 
        echo '$varA est égal à $varB en valeur et en type (strictement égaux) <br>';

    }else {
        echo 'les deux variables sont différentes en valeur ou en type (pas strictement égales) <br>';

    }
// Pour mémoire l'opérateur "=" est un signe d'affectation.

//-------------
//Les fonctions : isset() et empty():

// Définitions :
// empty() vérifie si c'est vide : 0, '', NULL, false, non défini
// isset() vérifie si c'est défini, et non NULL 

    $var1 = 0;
    $var2 = '';
    if(empty($var1)){
        echo '$var1 est vide (0, string vide, NULL, false, non défini) <br>';

    }
    if(isset($var2)){
        echo '$var2 existe et est non NULL <br>';
    }
// Différence entre isset et empty : si on supprime les déclaration des variable  $var1 et $var2 empty() reste vrai car $var1 n'est pas définie; Isset() devient fausse car $var2 n'est pas définie non plus.
// Utilisation : empty() pour vérifier qu'un champ de formulaire est rempli . isset() pour vérifier l'existance d'une variable avant de l'utiliser.

//--------
// l'opérateur NOt qui s'écrit "!" :
    $var3 = 'quelque chose';
    if(!empty($var3)){ // "!" pour NOT qui est une négation . Ainsi quand on a !TRUE celea revient à FALSE, et quan on a !FALSE cela revient à TRUE.
        echo'$var3 n\'est pas vide <br>'; // ici on entre dans la condition, car $var3 n'est pas vide
    }
//-----
// PHP7 : afficher une variable sous condition d'existence avec l'opérateur "??"

    echo $maVar ?? 'valeur par défaut'; // on affiche la variable $maVar si elle existe, si non on affiche le string qui suit.
// Exemple d'utilisation : pour laiser les valeurs saisie dans un formulaire .



//-------------------------------
echo ' <h2>9-  Switch </h2>' ;
//-------------------------------

// la condition switch est une autre syntaxe pour écrire un if .. elseif ...else quand on veut comparer une variable à une multitude de valeurs
$langue  = 'chinois';

switch ($langue) {
    case 'français' : // on compare $langue à la valeur des "case" et on excute le code qui suit si elle correspond: 
        echo'Bonjour ! ';
    break; // "break" est obligatoire pour quitter le witcgh une fois un "case " est exécuté
    case 'italien' :
        echo 'Ciao !' ;
    break;
    case 'espagnol' :
        echo 'Hola !';
    break;
    default : // on tombe dans le cas par défaut si on n'entre pas dans les "case" pécédents
        echo ' Hello ! <br>';
    break;
}

//-----
// Exercice
// vous réécrivez ce switch avec des if .... pour obtenir exactement le même resultat.

$langue = 'Arabe';

if($langue == 'français'){
    echo'Bonjour ! ';
}elseif ($langue == 'italien'){
    echo 'Ciao !' ;
}elseif ($langue == 'espagnol' ){
    echo 'Hola !';
}else {
    echo ' Hello ! <br>';
}

//--------------------------------------------
echo ' <h2>10-  Fonctions prédéfinies </h2>' ;
//--------------------------------------------

// Une fonction prédéfine permet de réaliser un traitrement spécifique prédéterminé dans le language PHP
//------

//strpos()
$email1 = 'prenom@site.fr';
echo strpos($email1, '@'); // affiche 6 : strpos() indique la position 6 du caractére "@" dans la chaine $email1 (on compte à partir de 0).
echo '<br>';
$email2 = 'toto';
echo strpos($email2, '@');
var_dump(strpos($email2, '@')); // gràce au var_dump on aperçoit que la fonction retourne FALSE car le caractére @ n'est pas trouvé dans $email2. Noter que quand on fait un echo fe false , cela n'affiche rien dans le navigateur. var_dump est une instruction d'affichage améliorée que l'on utilise qaund on développe, puis qu'on retir.
echo '<br>';
//strlen()
$phrase = 'mettez une phrase ici';
echo strlen($phrase); // strlen() permet de retourner la taille de la chaine de caractères (nombre d'octets occupés, un caractère accentué valant 2 octets, et un espace 1 octect ).

echo '<br>';

//---------
//substr()
$texte = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor vel est cupiditate fugiat. Minus et veritatis ea dolores laboriosam mollitia dolore, officiis maiores similique dolor nostrum praesentium, odit aliquid asperiores? Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, voluptatem laborum. Aspernatur harum enim voluptate adipisci. Quibusdam aliquid magnam rem dignissimos perferendis maxime tempore assumenda molestiae officia, voluptas alias tenetur.';
echo substr($texte, 0, 30) . '.....<a href="#"> lire la suite </a>'; // coupe une partie  du texte, en partant de la position 0 ici et sur 30
echo '<br>';

//--------------------------------------------
echo ' <h2>11-  Fonctions utilisateur </h2>' ;
//--------------------------------------------
// Des fonctions sont des morceaux de code écrits dans des accolades et portant un nom.
// on applele une fonction au besoin pour exécuter le code qui s'y trouve .
// il est d'usage de créer desfonctions pour ne pas se répéter quand on veut  exécuter plusieurs fois le même traitement . On parle alors de "factoriser" son code.

function separation(){ // on déclare une fonction avec le mot clé function suivi du nom de la fonction et d'une paire de () qui accueillerons des paramètres ultérieurement.
    echo'<hr>';
}

separation(); // pour exécuter une fonction (donc le code qui s'y trouve), on l'appelle en écrivant son nom suivi d'une paire de ().

//----
// Fonction avec paramétres et return : 

function bonjour($prenom, $nom){ // $prenom et $nom sont les paramétres de notre fonction. Ils permettnt de recevoir une aleur car il s'agit de variable de reception.
    return 'Bonjour ' . $prenom . ' ' . $nom . ' ! <br>'; //return permet de sortir la phrase "bonjour ...." et de la renvoyer à l'endroit où la fonction est appelée
 }
echo bonjour ('John', 'Doe'); // si la fonction attend des valeurs il faut obligatoirement les lui donner, et dans le même ordre que les paramètres. Ces valeurs s'appellent des arguments. Ici on met un echo car la fonction nous retourne la phrase  mais ne l'affiche pas directement.
// On peut remplacer les arguments par des variables (provenant d'un formulaire par exemple):
    $prenom = 'Pierre';
    $nom = 'Giraud';
    echo bonjour ($prenom, $nom);// ici les deux arguments sont variables et peuvent recevoir n'importe quelle valeur. 

//Exercice : vous écriver une fonction qui multiplie un nombre 1 par un nombre 2 fournis lors de l'appel . cette fonction retourne le résultat de la multiplication . Vous afficher le résultat

    function multiplication ($nombre1, $nombre2){
        return 'Le résultat de la multiplication de   '. $nombre1 . ' x ' . $nombre2 . ' est ' . $nombre1 * $nombre2 . ' . <br>';
    }

    $nombre1 = 10;
    $nombre2 = 5 ;
     
    echo multiplication ($nombre1, $nombre2);

    echo '<br> <br> <br>';

    //--------------------------------------------
    echo ' <h2>12-  Variable locale et variable globale </h2>' ;
    //--------------------------------------------

    //-------
    // Aller de l'espace local à l'espace global :
    function jourSemaine (){
        $jour = 'mardi' ;// ici nous nous trouveons dans l'espace local de la fonction. Cette variable est dite "locale".
        return $jour; // permet de sortir une valeur de la fonction .
        
    }
    //echo $jour ; // on ne peut pas accéder à cette variable  ici car elle n'est connue qu'à l'intérieur de la fonction jourSemaine()
        echo jourSemaine(); // on récumére la valeur  "mardi" grâce au return en fin de la fonction.
        echo '<br>';
      //-------
      // Aller de l'espace globale vers l'espace local:
      $pays = 'France'; // ici nous nous trouvons dans l'espace global. Cette variable est donc dite "globale" .
       function affichePays(){
           global $pays; // permet d'aler chercher la variable pays à l'extérier de la fonction pour pouvoir l'exploiter à l'intérieur.
           echo $pays; // affiche france
       }
       affichePays();

    //---------------------------------------------------------
        echo ' <h2>13-  Structure itératives : Les boucles </h2>' ;
    //---------------------------------------------------------

    //Les boucles sont destiées à répéter du code de façon automatique.
    //boucle while :
        $i = 0; // valeur de départ de la boucle
        while ($i < 3){ // tant que $i est inférieur à 3 , on entre dans la boucle.
            echo $i . '-----' ; // affiche " 0---1----2---"
            $i++; // on n'oublie pas d'incrémenter la variable $i pour que la condition d'entrée devienne false (fausse) à un moment donné (évite les boucles infinie).
        }
        echo '<br>';    

        //Exercice : à l'aide d'une boucle while , vous affichez les années de 1920 à 2020 dans menu déroulant .
        $i = 1920; 
         echo '<select>';
        while ($i < 2021) {
          
            echo '<option>' . $i .' </option>';
            
            $i++;
        }
        echo '</select>';
        echo '<br>';
    // Exercice bonus : faire la même chose dans l'autre sens, de 20 à 1920
        $j = 2020; 
         echo '<select>';
        while ($j >1919) {
          
            echo '<option>' . $j .' </option>';
            
            $j--;
        }
        echo '</select>';
        echo '<br>';

    //--------
    //Do while
    // la boucle do while a la particularité de s'exécuter au moins une fois puis tant que la condition de fin est vraie.
        $k = 0; // valeur de départ de la boucle 
        do {
            echo 'Je fais un tour de boucle <br>';
            $k++;
        } while ($k > 10); // la condition renvoie false de suite, pourtant la boucle a bien tourné une fois, Attention au ";" après le while.
    // dans un formulaire d'enquéte sur un site pour réponde au formulaire avant d'aller sur le  site 
        echo '<br>';


    //-------
    // Boucle for
    // La boucle for est une autre syntaxe de la boucle while. 
        for($z = 0; $z < 3 ; $z++) { //on trouve dans les parenthése de la for : la valeur de départ , la condition d'entée dans la boucle, la variation de$z (incrémentation ou décrémentation .....).

            echo $z . '---';

        }
        echo '<br>';

    //Exercice : affichez les mois de 1 à 12 à l'aide d'une boucle for dans un menu déroulant 
    echo '<form>';

    echo '<label> jour de naissance </ label>';
    echo '<select>';
    for($jour = 1; $jour < 31; $jour++){
        echo '<option>' . $jour . '</ option>';

    }
    echo '</select>';

    echo '<label> Mois de naissance </ label>';
    echo '<select>';
    for($mois = 1; $mois < 13; $mois++){
        echo '<option>' . $mois . '</ option>';

    }
    echo '</select>';
    echo '<label> année de naissance </ label>';
    echo '<select>';
    for($annee = 2020; $annee > 1970; $annee--){
        echo '<option>' . $annee. '</ option>';

    }
    echo '</select>';
    echo '<input type ="submit">';
    echo '</form>';

//Exercice : 
//- faire  une boucle for qui affiche 0 à 9  sur la même ligne 
//- puis vous compléter la boucle précédente , pour mettre les chiffres dans une table HTML . vous y mettre une bordure en css.
//En desous je ferme ma balise php      
?> 
<table>
<tr>
<?php
    
for($i=0; $i<10; $i++){
    echo'<td>' . $i . '</td>';
 
}
   
?>
</tr>
</table>
<?php
// correction 2 en php
echo '<br>';
echo '<table>';
    echo '<tr>';
    for($i=0; $i<10; $i++){
        echo'<td>' . $i . '</td>';
     
    }
    echo '</tr>';
echo '</table>';


  //---------------------------------------------------------
  echo ' <h2> 14-  Les tableaux (array) </h2>' ;
  //---------------------------------------------------------

  // Un tableau appelé Array en anglais , est une variable amélirer dans laquelle on stocke une multitude de valeurs . Ces valeurs peuvent être de n'importe quel type . Elle possédent un indice dont la numérotation commence à 0.

  // Déclarer un array (méthode 1) :
  $liste = array ('Grégoire', 'Nathalie', 'Emilie','François', 'Georges'); //les valeurs sont séparées par une virgule.
  // echo $liste ; // erreur de type "Array to string conversion" car on ne peut pas afficher directement un tableau.
  echo '<pre>';
  var_dump($liste); // affiche le contenu du tableau avec les types 
  echo '<pre>';

  echo '<pre>';
  print_r($liste); // affiche le contenu du tableau sans les types
  echo '<pre>'; // <pre> est une balise html qui permet de formater le texte 
// pour notre besoin nous créons notre fonction personnelle d'affichage :
//( je l'ai déplacer dans le fichier "fonctions.php" et je l'ai inclut avec required_once)
  
//   function debug($var){
//     echo '<pre>';
//     print_r($var); 
//     echo '<pre>';

//   }
  debug($liste);
  // Autre façon de déclarer un array (méthode 2):
  $tab = ['France', 'Italie', 'Espagne', 'Portugal'];
  //Indice   0          1         2           3
  echo $tab[1] . '<br>'; // pour afficher une valeur du tableau on écrit son indice dans paire de crochets après le nom du tableau. Ici affiche Iatalie.
  //Ajouter une valeur à la fin d'un tableau :
  $tab [] = 'Suisse'; // lescrochets vides signifient qu'on ajoute une valeur à la fin du tableau $tab
  debug($tab); // pour vérifier que la valeur "Suisse" est présente.
  echo $tab[4];




  //---------- 
  // Les tableaux associatifs
  // Dans un tableau associatif nous pouvons choisir le nom des indices.
  $couleur = array(
    'b' => 'bleu',
    'r' => 'rouge',
    'v' => 'vert'
  ); 

  debug($couleur);
  // pour afficher une valeur de notre tableau associatif:
    echo 'La première couleur du tableau est : ' . $couleur['b'] .' . <br>';
    echo "La première couleur du tableau est :  $couleur[b] . <br>"; // Quand un tableau associatif est écrit dans des guillemets ou des quotes, il perd les quotes autour de son indice.

    //----------------
    //Compter le nombre d'élément contenu dans un tableau :
    echo 'Nombre de valeurs dans le tableau : ' . count($couleur) . ' . <br>'; // affiche 3
    echo 'Nombre de valeurs dans le tableau : ' . sizeof($couleur) . ' . <br>'; // affiche 3  aussi car sizeof() fait la même chose que count() donc il est un alias.

 
 

  //---------------------------------------------------------
  echo ' <h2> 15-  La boucle foreach </h2>' ;
  //-------------------------------------------------------
  //foreach est un moyen simple de passer un revue un tableau de façcon automatique . Cette boucle ne fonction que sur les tableaux est les objets.

  debug($tab); // pour voie le tableau à parcourir.
    echo '<ol>';
        foreach($tab as $pays){ // on parcourt le tableau $tab par ses baleurs . la variable $pays prend les valeurs du tableau successivement à chaque tour de boucle. Le mot "as" fait partie de la syntaxe? il est obligatoire.
            echo '<li>' . $pays . '</li>' .'<br>';
        }
    echo '</ol>';

    // la boucle foreach pour parcourir les INDICES et les VALUERS :
        foreach ($tab as $indice => $pays) { // quand il y a 2 variable aprés "as" celle de gauche parcous les indice est celle de droite parcourt les valeurs (quelque soit leur nom).
            echo 'Indice ' . $indice . ' correspond à ' . $pays . '. <br>' ;
        }
// Exercice : vous déclarer un tableau associatif avec les indices prenom, nom, email, telephone et vous y metter les valeurs correspondabnt à un seul contact. Puis avec une boucle foreach , vous affichez les valeurs dans des <p>, sauf le prenom doit ^étre dans un <h3>.



$contact = array(
    'prenom' => 'Sahar',
    'nom' => 'Ferchichi ',
    'email' => 'sahar.ferchichi@lepoles.com',
    'telephone' => '07 53 06 27 67'
);
debug($contact);


    foreach ($contact as $indice => $personne ){
        if ( $indice == 'prenom'){
            echo  '<h3>Bonjour ' . $personne .'! </h3>';

        }else {
            echo '<p>'. $personne . '</p>' ;
        }
      
    }


  //---------------------------------------------------------
  echo ' <h2> 16- Tableau multidimentionnel </h2>' ;
  //-------------------------------------------------------
  //On parle de tableau multidimentionnel quand un tableau est contenu dans un autre tableau.Cahaque tableau représente une dimension.


// Création d'un tableau mltidimentionnel :

$tab_multi = array(
    0 =>  array(
        'prenom' => 'Julien',
        'nom' => 'Dupon',
        'telephone' => '0125558557'
    ),
    1 => array(
        'prenom' => 'Nicolas',
        'nom' => 'Duron',
        'telephone' => '01255525557'
    ),
    2 => array(
        'prenom' => 'Pierre',
        'nom' => 'Dulac',
        
    )

);
debug($tab_multi);
debug($tab_multi[1]); // pour afficher que le tableau d'indice [1]

//afficher la valeur "julien" de $tab_multi:
echo $tab_multi[0]['prenom'];// pour afficher "julien" nous entrons d'abord à l'indice [0]de $tab_multi puis nous allons dans le sous tableau à l'indice ['prenom'].
//pour parcourir le tableau multidimentionnel on peut faire une boucle for car ses indices sont numérique :
    echo '<br>';
    for($i=0 ; $i < count($tab_multi); $i ++) { //tant que $i est inférieur au nombre d'élément  du tableau $tab_multi (soit 3) , on entre dans la boucle :
      echo $tab_multi[$i]['prenom'] . ' '; // $i vas successivement prendre la valeur 0, puis 1, puis 2 , ce qui permet d'afficher les 3 prénoms.
    }
    echo '<hr>';
//Exercice : vous affichez les trois prénom de tableau $tab_multiabec une boucle foreach.

    

foreach ($tab_multi as $indice => $valeur ){
    
    // echo $tab_multi[$indice]['prenom'] . ' ';
    //ou 
    echo $valeur['prenom'] . ' ';
  
}

echo'<hr>';

//Exercice :  vous déclarer un tableau avec les taille  S, M et L et XL , puis vous affichez les tailles dans un menu déroulant avec une boucle foreach .
$taille = array(
    0 => 'S',
    1 => 'M',
    2 => 'L',
    3 => 'XL'
);
    echo '<form>';
    echo'<label> Tailles </label>';
    echo'<select>';
        foreach ($taille as $indice => $valeur ){
            echo'<option>' . $valeur .'</option>';
            
        }
    echo '</select>';
    echo '<input type="submit" value="Ajouter au panier">';
    echo '</form>';


//---------------------------------------------------------
echo ' <h2> 17- Inclusions de fichier </h2>' ;
//---------------------------------------------------------

echo'Prmière inclusion : ';
include 'exemple.inc.php'; // permet de faire l'inclusion du fichier dont le chemin est spécifié. en cas d'erreur lors de l'inclusion include génère un warning et continue l'exécution du script.
echo'<br>';
echo'Deuxième inclusion : ';
include_once 'exemple.inc.php'; //  permet de faire l'inclusion du fichier si celui ci n'a pas été inclus.(on ne kl'inclus qu'une seule fois)
echo'<br>';
echo 'Trousième inclusion : ';
require 'exemple.inc.php';// fait l'inclusion du fichier spécifié. celui ci est obligatoire au bon fonctionnement du site : en cas d'erreur lors de l'inclusion require génère une erreur de type "fatal erreur" et stoppe l'exécition du script.
echo'<br>';
echo 'Quatrième inclusion';
require_once 'exemple.inc.php';// "once" signifie que l'on vérifie si le fichier a déjà inclus. si c'est le cas, on le ré-inclut pas .
// le ".inc" dans le nom du fichier "exemple.inc.php" est un indicatif pour préciser aux développeurs que le fichier est distiné à être inclus, et qu'il ne s'agit pas d'une page à part entière. 


//---------------------------------------------------------
echo ' <h2> 18 - Introduction aux objets </h2>' ;
//---------------------------------------------------------

//Un objet est un autre type de donnée (object en anglais ) il représente un objet réel (par exemple , une voiture , un personnage, un membre inscrit sur votre site, un produit que vous vendez, un panier d'achat) auquel on peut associer des variables, appelées propriétés, et des conctions appelées méthodes.
// pour créer des objets il nous faut un plan de construction c'est le rôle de la classe (class en anglais). Nous créons ici une class pour fabriquer des meubles :


class Meuble{ // on met une majuscule à la 1ère lettre du  nom de la classe 
    
    public $marque = 'ikea'; // propriété "marque" . public permet de préciser que l'élément sera accessible partout.
    public function prix() {// prix() est une méthode.
        return rand(50,200) . '€' ;  // rand() est une fonction prédéfinie qui tire un chiffre aléatoire ici entre 50 et 200 .
    }

}

// On crée une table à partir de la classe Meuble :
$table = new Meuble(); // On crée un objet $table à partir de la classe meuble à l'aide  du mot clé " new " . On dit que l'on instancie la classe.  $table est donc de type objet.
debug($table); // onvoit le type object et la seulepropriété "marque" .
echo 'La marque de notre table est : ' .$table ->marque . '<br>'; // pour accéder à la propriété d'un objet , on écrit l'objet suivi de la flèche "->" puis du nom de la propriété SANS le "$".
echo ' Le prix de notre table est : ' . $table -> prix() . '<br>'; // pour exécuter la méthode d'un objet, on écrit son nom après la flèche "->" et on lui ajoute une paire de ().



?>
<div id="bas"></div>




