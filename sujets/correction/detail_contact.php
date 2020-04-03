<?php

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$contenu = '';

if (isset($_GET['id_contact'])) {

	$_GET['id_contact'] = htmlspecialchars($_GET['id_contact']);
	$query = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");
	$query->execute(array(':id_contact' => $_GET['id_contact']));

	// print_r($query);

	if ($query->rowCount() == 0) {
		$contenu .= '<p>Ce contact n\'existe pas...</p>';
	} else {
		
		$contact = $query->fetch(PDO::FETCH_ASSOC);

		$contenu .= '<div><img src="'. $contact['photo'] .'" alt="'. $contact['prenom'].'" style="width: 100px;"></div>';
		$contenu .= '<h1>'. $contact['prenom'] . ' ' . $contact['nom'] .'</h1>';
		$contenu .= '<h2> Téléphone : '. $contact['telephone'] .'</h2>';
		$contenu .= '<h2> Email : '. $contact['email'] .'</h2>';
		$contenu .= '<div> Type de contact : '. $contact['type_contact'] .'</div>';
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Détail contact</title>
</head>
<body>

	<?php echo $contenu; ?>	

</body>
</html>