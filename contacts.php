

<?php
try
{
	// On se connecte à MySQL
	$bdd= new PDO('mysql:host=localhost;dbname=Cogip;charset=utf8', 'user123', 'user123');

}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$resultat = $bdd->query('SELECT * FROM personne
    LEFT JOIN societe
    ON personne.idsociete = societe.idsociete');
?>


<!DOCTYPE HTML>
<html>
<body>

	<form style="margin:10px" method="post" action="">
	<p>Ajouter un contact</p>
	Id: <input type="number" name="id"><br>
	Nom: <input type="text" name="nom"><br>
	Prénom: <input type="text" name="prenom"><br>
	Téléphone: <input type="number" name="tel"><br>
	Email: <input type="email" name="email"><br>
	Société: <input type="text" name="societe"><br>
	<button type="submit" name="submit" value="submit">Ajouter</button>
	</form>

<table border='1'>
	<tr><td>ID</td><td>Nom</td><td>Prénom</td><td>Téléphone</td><td>email</td><td>société</td></tr>

	<?php
	while ($donnees = $resultat->fetch())

	{ ?>
	<tr>
			<td><?= $donnees['idpersonne']?></td>
			<td><?= $donnees['nom']?></td>
			<td><?= $donnees['prenom']?></td>
			<td><?= $donnees['tel']?></td>
			<td><?= $donnees['email']?></td>
			<td><?= $donnees['idsociete']?></td>

	</tr><br>

	<?php
}


if(isset($_POST['submit'])){

$idpersonne = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$email = $_POST['email'];


$rq = $bdd -> prepare("INSERT INTO personne (`idpersonne`, `nom`, `prenom`, `email`, `societe`, `tel`)
			VALUES (:idpersonne, :nom, :prenom, :email,  :societe, :tel  )");
	$rq ->execute(array(
		'idpersonne' => $idpersonne,
		'nom' => $nom,
		'prenom' => $prenom,
		'email' => $email,
		'societe' => $societe,
		'tel' => $tel



	)) ;
	?>

<tr>
		<td><?=$idpersonne?></td>
		<td><?=$nom?></td>
		<td><?=$prenom?></td>
		<td><?=$tel?></td>
		<td><?=$email?></td>
		<td><?=$societe?></td>
</tr>
</table>




<?php
} else {
	echo "</table>";
}



$resultat->closeCursor();
?>

</body>
</html>
