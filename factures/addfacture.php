
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

$resultat = $bdd->query('SELECT * FROM factures
          LEFT JOIN societe
          ON factures.idsociete = societe.idsociete');

// $resultat = $bdd->query('SELECT * FROM facture
//           LEFT JOIN personne
//           ON facture.idpersonne = personne.idpersonne');

$list =$bdd->query('SELECT * FROM societe');

$persoc=$bdd->query('SELECT * FROM personne');

if(isset($_POST['submit'])){
  $datefacture = $_POST['datefacture'];
  $dateprestation = $_POST['dateprestation'];
  $numfacture = $_POST['numfacture'];
  $idsociete = $_POST['societe'];


  $rq = $bdd -> prepare("INSERT INTO factures ( datefacture, dateprestation, numfacture, idsociete)
        VALUES ( :datefacture, :dateprestation, :numfacture, :idsociete)");
    $rq ->execute(array(
      'datefacture' => $datefacture,
      'dateprestation' => $dateprestation,
      'numfacture' => $numfacture,
      'idsociete' => $idsociete,

    )) ;
    header('location:factures.php'); //permet de rafraichir la page en y renvoyant automatiquement
}

// if(isset($_POST['supSoc'])){
//   $sc = $_POST['select'];
//   foreach($sc as $suppr)
//   {
//     $rq = $bdd -> prepare("DELETE FROM factures WHERE idfacture = ?");
//     $rq->execute(array(
//       $suppr
//     ));
//   }
//   header('location:factures.php');
// }

?>


<!DOCTYPE HTML>
  <html>
       
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
							<li class="nav-item ">
								<a class="nav-link" href="../page_membre_modo.php">Accueil<span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item  active">
								<a class="nav-link" href="../factures/addfacture.php">Factures</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="../societe/socMod.php">Sociétés</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="../contacts/contactsAjout.php">Contacts</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="../index.php">Connexion</a>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<main>
        
      <form style="margin:10px" method="post" enctype = "multipart/form-data" action="">
        <table border='1'>
        	<tr>
            <th>Check</th>
            <!-- <th>Id</th> -->
            <th>Date Facture</th>
            <th>Date Prestation</th>
            <th>N. Facture</th>
            <th>Nom Societé</th>
          </tr>

        	<?php
        	while ($donnees = $resultat->fetch())
        	{ ?>
          	<tr>
              <td><input type="checkbox" name="select[]" value="<?= $donnees['idfacture']?>" /></td>
							<!-- <td><?= $donnees['idfacture']?></td> -->
	          	<td><?= $donnees['datefacture']?></td>
              <td><?= $donnees['dateprestation']?></td>
          		<td><a href="detailsfact.php?detaillefact=<?= $donnees['idfacture']?>"><?= $donnees['numfacture']?></a></td>
              <td><?= $donnees['nomsociete']?></td>
            </tr>

          <?php } ?>
        </table>

        <h1>Ajouter une facture</h1>
        <p>Date Facture:</p>
        <input type="date" name="datefacture"><br>
        <p>Date Prestation:</p>
        <input type="date" name="dateprestation"><br>
        <p>N. Facture: </p>
        <input type="number" name="numfacture"><br>
        <p>Nom Societé</p>
        <select name="societe"><br>
          <?php

          foreach ($list as $value) {

          ?>
            <option value="<?= $value['idsociete']?>"><?= $value['nomsociete']?></option>
          <?php
          }
									    ?>
        </select><br>
        <button type="submit" name="submit" value="submit">Ajouter</button>
					<!-- <input type="submit" name="supSoc" value="Supprimer" /> -->
				</form>


        </main>
      </body>
      </html>
