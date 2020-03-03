<style>
    h2 {
        border-top : 1px solid navy;
        border-bottom : 1px solid navy;
        color : navy;
    }

</style>

<?php 
//-------------------------------
echo ' <h2> Les balises PHP </h2>' ;
//-------------------------------

?>
<?php 
// Pour ouvrir un passage en PHP on utilise  la balise  précédente
// Pour fermer un passage en PHP on utilise la balise suivante :
?>

<p>Bonjour</p> <!-- en dehors des balises du PHP nous pouvons écrire du HTML dans fichier ayant l'extention .php ( ce n'est pas possible dans un fichier .html) -->

<?php 
// vous ,'ête pas obligé de fermer un pasage en PHP en fin de script.
// pour faire un commentaire su 1 seule ligne
# pour faire un commentaire sur une seule ligne 
/*
pour faire 
des comentaires
surr plusieurs 
lignes
*/

//-------------------------------
echo ' <h2> Affichage </h2>' ;
//-------------------------------

echo ' Bonjour <br> '; // echo est une instruction qui permet d'effecuter un affichage. Nous pouvons y mettre du HTML. Toutes les instructions se terminent par un ";"  en PHP .
print ' Nous sommes lundi <br>'; // print est une autre instruction d'affichage
var_dump('code ') ;
echo '<br>';
print_r('code'); // ces deux fonctions d'affichage permettent d'analyer dans le navigateur le contenu d'une variable par exemple (nous en verrons l'utilisation plus tard).

//-------------------------------
echo ' <h2> Les variables </h2>' ;
//-------------------------------

// Une variable est un espace mémoir qui porte un nom et qui permet de conserver une valeur . Cette valeur peut être de n'importe quel type .
// En PHP on représenyte une variable avec le signe "$".

$a = 127; // on déclare la variable $a et lui affecte la valeur 127.

echo gettype($a); //gettype() est une fonction prédifine qui permet de voir le type d'une variable ici il s'agit d'un integer (entier).
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
echo ' <h2> Concaténation  </h2>' ;
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
echo ' <h2> Guillemets et quotes  </h2>' ;
//-------------------------------

$message = "aujourd'hui";
$message = 'aujourd\'hui'; //on échappe les apostrophes quand on écrit dans les quotes simples avec "\"
$txt = 'Bonjour';
echo " $txt tout le monde <br>"; // dans les guillemets la variabe est évaluée  : c'est sont contenu qui est affiché
echo ' $txt tout le monde <br>'; // dans des quotes simples , $txt est considéré comme une chaine de caractères brute : on affiche littéralement .

//-------------------------------
echo ' <h2> Les constantes </h2>' ;
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
echo ' <h2> Opérateurs arithmétiques </h2>' ;
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
echo ' <h2> Structures conditionnelles </h2>' ;
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
echo ' <h2> Switch </h2>' ;
//-------------------------------




