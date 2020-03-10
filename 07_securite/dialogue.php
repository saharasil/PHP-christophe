<?php
//----------------------------
// Cas pratique : un formulaire pour poster des commentaires 
// --------------------------

//Objectif : protéger la requête SQL dont les données proviennent de l'internaute.
/*
Modélisation de la BDD : 
    Nom de la BDD : dialogue
    Nom de la table : commentaire
    Champs           : id_commentaire    INT PK AI
                        pseudo           VARCHAR(20)
                        message          TEXT
                        date_enregistrement DATETIME