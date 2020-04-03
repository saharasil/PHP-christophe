<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

*/

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// $pdo = new PDO('mysql:host=sql313.epizy.com;dbname=epiz_24774743_repertoire', 'epiz_24774743', '0etBIHMKQR', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


$query = $pdo->query('SELECT * FROM contact');
 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des contacts</title>
	<style>
		.photo {
			width: 80px;
		}

		table {
			border-collapse: collapse;
		}

		table, th, tr, td {
			border: 1px solid;
		}


	</style>
</head>
<body>
	<h1>Liste des contacts</h1>
		<table>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Téléphone</th>
				<th>Email</th>
				<th>Type de contact</th>
				<th>Photo</th>
				<th>Voir</th>
			</tr>
<?php
while ($contact = $query->fetch(PDO::FETCH_ASSOC)) {
		echo '<tr>
				<td>'. $contact['nom'] .'</td>
				<td>'. $contact['prenom'] .'</td>
				<td>'. $contact['telephone'] .'</td>
				<td>'. $contact['email'] .'</td>
				<td>'. $contact['type_contact'] .'</td>
				<td><img src="'. $contact['photo'] .'" class="photo"></td>
				<td><a href="detail_contact.php?id_contact='. $contact['id_contact'] .'">voir le contact</a></td>
			 </tr>';
}			
?>

</table>

</body>
</html>