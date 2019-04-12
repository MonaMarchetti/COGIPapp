
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
$resultat = $bdd->prepare('SELECT * FROM factures LEFT JOIN societe ON factures.idsociete = societe.idsociete WHERE idfactures =:idfactures');
$resultat->execute(array(
'idfactures'=> $_GET['detaillefact']

));
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
        		
			<main>

<h1>Details Factures</h1>

<?php
	while ($donnees = $resultat->fetch())
	{ ?>
		<p>Num Facture:<?= $donnees['numfacture']?></p>
		<p>Nom :<?= $donnees['nomsociete']?></p>
		<p>TVA :<?= $donnees['tva']?></p>
		<p>Type société :<?= $donnees['type']?></p>
		<p>Société :<?= $donnees['nomsociete']?></p>


		<p>Nom Societé:<?= $donnees['nomsociete']?></p>
		<p>Pays :<?= $donnees['pays']?></p>


	<?php } ?>

</main>
</body>
</html>
