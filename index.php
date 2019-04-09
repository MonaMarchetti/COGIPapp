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
<html lang="fr">

<head>
  <title>COGIPapp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--CSS made in bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--my CSS-->
  <link rel="stylesheet" href="assets/css/style.css">

  <!--fontawesome-->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

</head>

<body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #30032c;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="factures.php">Factures</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sociétés.php">Sociétés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts.php">Contacts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <main>

  </main>
</body>
</html>
