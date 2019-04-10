<?php
try
{
	// On se connecte à MySQL
	$bdd= new PDO('mysql:host=localhost;dbname=COGIP;charset=utf8', 'root');
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

$list = $bdd->query('SELECT * FROM societe');
?>

<!DOCTYPE HTML>
<html>
<body>
<table border='1'>
	<tr><td>Nom</td><td>Prénom</td><td>Téléphone</td><td>email</td><td>société</td></tr>

	<?php
	while ($donnees = $resultat->fetch())
	{ ?>
	<tr>
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
Nom: <input type="text" name="nom"><br>
Prénom: <input type="text" name="prenom"><br>
Téléphone: <input type="number" name="tel"><br>
Email: <input type="email" name="email"><br>
Societe:  <select name="societe">
  <?php
  foreach ($list as $value) {
    ?>
  <option value="<?= $value['idsociete']?>"><?= $value['nomsociete']?></option>
<?php
}
?>
</select> <br>
<button type="submit" name="submit" value="submit">Ajouter</button>
</form>



<?php

if(isset($_POST['submit'])){
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$idsociete = $_POST['societe'];



$rq = $bdd -> prepare("INSERT INTO personne (  nom, prenom, email,  tel, idsociete)
			VALUES ( :nom, :prenom, :email, :tel, :idsociete )");
	$rq ->execute(array(
		'nom' => $nom,
		'prenom' => $prenom,
		'email' => $email,
		'tel' => $tel,
		'idsociete' => $idsociete
	)) ;
	?>

<tr>
		<td><?=$nom?></td>
		<td><?=$prenom?></td>
		<td><?=$tel?></td>
		<td><?=$email?></td>
		<td><?php $donnees['nomsociete']?></td>
		<td><input type='checkbox' name='delete[]' value='<?php $donnees['idpersonne']?>'/></td>

</tr>
</table>



<?php
} else {
	echo "</table>";
}
?>



</body>
</html>
