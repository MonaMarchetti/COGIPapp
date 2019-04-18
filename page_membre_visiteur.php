<?php

  try
  {
  	// On se connecte à MySQL
  	$bdd= new PDO('mysql:host=localhost;dbname=id9271623_cogip;charset=utf8', 'id9271623_ragazzadb', 'IlaCatMo');

  }
  catch(Exception $e)
  {
  	// En cas d'erreur, on affiche un message et on arrête tout
          die('Erreur : '.$e->getMessage());
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

  <!--fontawesome-->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

</head>

<body style="background-color: #ccccff; font-size: 18pt;">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #30032c;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="page_membre_visiteur.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="factures/visiteurfacture.php">Factures</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="societe/socVisit.php">Sociétés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts/contactsListe.php">Contacts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Connexion</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <main class="container">
          <div class="row justify-content-md-center mb-5 mt-3">
            <div class="col-md-6">
              <h1>Bonjour cher visiteur!</h1>
            </div>
          </div>

						<div class="row justify-content-md-center mb-5">
              <div class="col-md-6">
						<h2>Dernières Factures : </h2>
			        <table border='1' style="width: 108%;">
								<tr>
			            <th>No Facture</th>
			            <th>Dates</th>
			            <th>Societe</th>
			          </tr>

			        	<?php

								$resultat = $bdd -> query ('SELECT * FROM factures
									LEFT JOIN societe
									ON factures.idsociete= societe.idsociete
									ORDER BY datefacture ASC
									LIMIT 5
								');

								$resulSoc = $bdd -> query ('SELECT * FROM societe');

			        	while ($donneesFac = $resultat->fetch())
			        	{ ?>
			          	<tr>
										<td><?= $donneesFac['numfacture']?></td>
										<td><?= $donneesFac['datefacture']?></td>
			          		<td><?= $donneesFac['nomsociete']?></td>
			            </tr>
			          <?php }

								?>
			        </table>
						</div>
          </div>
          <div class="row justify-content-md-center mb-5">
						<div class="col-md-6">
							<h2>Derniers Contacts : </h2>
				        <table border='1' style="width: 100%;">
									<tr>
				            <th>Nom</th>
										<th>Prénom</th>
										<th>Email</th>
				            <th>Téléphone</th>
				            <th>Societe</th>
				          </tr>

				        	<?php

									$resultatCont = $bdd->query('SELECT * FROM personne
										LEFT JOIN societe
										ON personne.idsociete = societe.idsociete
										ORDER BY idpersonne DESC
										LIMIT 5

									');

				        	while ($donnees = $resultatCont->fetch())
				        	{ ?>
				          	<tr>
											<td><?= $donnees['nom']?></td>
											<td><?= $donnees['prenom']?></td>
				          		<td><?= $donnees['email']?></td>
											<td><?= $donnees['tel']?></td>
											<td><?= $donnees['nomsociete']?></td>
				            </tr>
				          <?php }

									?>
				        </table>
								</form>
						</div>
          </div>
          <div class="row justify-content-md-center mb-5">
						<div class="col-md-6">
							<h2>Dernières Sociétés : </h2>
								<table border='1' style="width: 108%;">
									<tr>
										<th>Nom Société</th>
										<th>TVA</th>
										<th>Pays</th>
										<th>Type</th>
									</tr>

									<?php

									$resultatSoc = $bdd->query('SELECT * FROM societe
										ORDER BY nomsociete ASC
										LIMIT 5

									');

									while ($donnees = $resultatSoc ->fetch())
									{ ?>
										<tr>
											<td><?= $donnees['nomsociete']?></td>
											<td><?= $donnees['tva']?></td>
											<td><?= $donnees['pays']?></td>
											<td><?= $donnees['type']?></td>
										</tr>
									<?php }


									?>
								</table>
						</div>
          </div>
  </main>
</body>
</html>
