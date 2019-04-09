<?php

	try
	{
			// On se connecte à MySQL
			$pdo = new PDO('mysql:host=localhost;dbname=weatherapp; charset=utf8', 'root');
	}
	catch (Exception $e)
	{
			// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
	}

	$resultat = $pdo->query('SELECT * FROM Météo');

	if(isset($_POST['submit'])){
		//////////////////////////Méthode Alternative////////////////////////////////////
		// $req = $pdo->prepare("INSERT INTO Meteo (ville, haut, bas) VALUES (?, ?, ?)");
		// $req->execute(array($ville,$_POST['haut'],$_POST['bas']));
		$req = $pdo->prepare("INSERT INTO Météo (ville, haut, bas) VALUES (:ville, :haut, :bas)");
		$req->execute(array(
		'ville'=> $_POST['city'],
		'haut'=> $_POST['high'],
		'bas'=> $_POST['low']
		));
		header('location:index.php'); //permet de rafraichir la page en y renvoyant automatiquement
	}

	if(isset($_POST['supCity'])){
		$sc = $_POST['supCity'];
		foreach($sc as $suppr)
		{
			$req = $pdo->prepare("DELETE FROM Météo WHERE ville = ?");
			$req->execute(array(
				$suppr
			));
		}
		header('location:index.php'); //permet de rafraichir la page en y renvoyant automatiquement
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>WeatherApp</title>
	</head>

	<body>
		<form method="post" action="">
			<table>
				<tr>
					<th>Check</th>
					<th>Villes</th>
					<th>Maxima</th>
					<th>Minima</th>
				</tr>
				<?php
					while ($donnees = $resultat->fetch())
					{ ?>
						<tr>
							<td><input type="checkbox" name="supCity[]" value="<?= $donnees['ville']?>" /></td>
							<td><?= $donnees['ville']?></td>
							<td><?= $donnees['haut']?></td>
							<td><?= $donnees['bas']?></td>
							<td><input type="submit" value="Supprimer" /></td>
						</tr>
				<?php } ?>
			</table>

			<p>Ville</p>
			<input type="text" name="city"><br>
			<p>Maxima</p>
			<input type="text" name="high"><br>
			<p>Minima</p>
			<input type="text" name="low"><br>
			<button type="submit" name="submit" value="insert">Submit</button>
		</form>

	</body>
</html>
