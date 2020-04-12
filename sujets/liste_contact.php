<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).
*/


//connexion avec la  base donné
$pdo = new PDO('mysql: host=localhost;dbname=repertoire', //driver mysql (IBM, oracle, ODBC ...), nom di serveur (host), nomde la BDD(dbname)
              'root',//pseudo de la BDD
              '', //mdp de la BDD
              array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les erreurs SQl dans le navigateur
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // pour définir le charset des échanges avec la BDD
              )            
);
require_once 'fonction.php';

$resultat = $pdo->query("SELECT * FROM contact");
debug($resultat);
var_dump($resultat);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sujet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="container">
	<h1> Tableau de contact</h1>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">Id_contact</th>
					<th scope="col">Nom</th>
					<th scope="col">Prenom</th>
					<th scope="col">Telepohone</th>
					<th scope="col">Email</th>
					<th scope="col">Type_contact</th>
					<th scope="col">Photo</th>
					<th scope="col">Voir</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php
					while ($contact = $resultat->fetch(PDO::FETCH_ASSOC)){
						echo '<tr>';
							echo '<td>' . $contact['id_contact'] . '</td>'; 
							echo '<td>' . $contact['nom'] . '</td>'; 
							echo '<td>' . $contact['prenom'] . '</td>'; 
							echo '<td>' . $contact['telephone'] . '</td>'; 
							echo '<td>' . $contact['email'] . '</td>'; 
							echo '<td>' . $contact['type_contact'] . '</td>'; 
							echo '<td><img src="'. $contact['photo'] .'" style="width:80px"></td>';
							echo '<th> <a href="detail_contact.php?detail_contact=' . $contact['id_contact'].'">Voir plus</a></th>';
						echo '</tr>';
						}

					?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>



