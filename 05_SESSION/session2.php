<?php
//ouverture de la session avec session_start() : 
session_start(); // ici la session n'est pas recrée car elle existe déjà grâce au session_start() lancé dans le fichier session1.php.
echo 'La session est accessible dans tout les scriptes du site ';
print_r($_SESSION);
// ce fichier n'a rien à avoir avec la session1.php , il n' y a pas d'inclusion (include ou require), il pourrait être dans n'importe quel dossier, s'appeler n'importe comment, les information contenues dans la session sont accessibles grâce au session_start().