

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
    ON personne.idsociete = societe.idsociete
		');
?>


<!DOCTYPE HTML>
<html>
<body>

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
			<td><?= $donnees['nomsociete']?></td>
			<td><input type='checkbox' name='id[]' value='<?php $donnees['Id']?>'/></td>
	</tr><br>

	<?php
}
?>

<form style="margin:10px" method="post" enctype = "multipart/form-data" action="">
<p>Ajouter un contact</p>
id personne: <input type="text" name="idpersonne"><br>
Nom: <input type="text" name="nom"><br>
Prénom: <input type="text" name="prenom"><br>
Téléphone: <input type="number" name="tel"><br>
Email: <input type="email" name="email"><br>
id societe: <input type="text" name="idsociete"><br>
<button type="submit" name="submit" value="submit">Ajouter</button>
</form>

<?php

if(isset($_POST['submit'])){

$idpersonne = $_POST['idpersonne'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$idsociete = $_POST['idsociete'];


$rq = $bdd -> prepare("INSERT INTO personne ( idpersonne, nom, prenom, email,  tel, idsociete)
			VALUES (:idpersonne, :nom, :prenom, :email, :tel, :idsociete )");
	$rq ->execute(array(

		'idpersonne' => $idpersonne,
		'nom' => $nom,
		'prenom' => $prenom,
		'email' => $email,
		'tel' => $tel,
		'idsociete' => $idsociete


	)) ;
	?>

<tr>
		<td><?=$idpersonne?></td>
		<td><?=$nom?></td>
		<td><?=$prenom?></td>
		<td><?=$tel?></td>
		<td><?=$email?></td>
		<td><?=$idsociete?></td>
		<td><input type='checkbox' name='delete[]' value='<?php $donnees['idpersonne']?>'/></td>

</tr>
</table>
?>



<?php
} else {
	echo "</table>";
}

?>
<form action="" method="post">
		<input type='submit' name='effacer' value='effacer' />
</form>

<?php

if(isset($_POST['effacer'])){//to run PHP script on submit

$deleteId = $_POST['delete'];
echo $deleteId;

for($i = 0; $i< sizeof($deleteId); $i++){
 echo $deleteId[$i];

$quer = $bdd->prepare("DELETE FROM personne WHERE idpersonne =:idpersonne");
$quer->execute(array(
'idpersonne' => $deleteId[$i]
));

	header('location:contacts.php');



}
}

$resultat->closeCursor();
?>

</body>
</html>
