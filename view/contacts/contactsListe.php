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
?>

<!DOCTYPE HTML>
  <html>
    <body>
        <table border='1'>
        	<tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>email</th>
            <th>société</th>
          </tr>

        	<?php
        	while ($donnees = $resultat->fetch())
        	{ ?>
          	<tr>
              <td><a href='contactsDetails.php?contact=<?= $donnees['idpersonne']?>'> <?= $donnees['nom']?></a></td>
          		<td><?= $donnees['prenom']?></td>
          		<td><?= $donnees['tel']?></td>
          		<td><?= $donnees['email']?></td>
          		<td><?= $donnees['nomsociete']?></td>
            </tr>
          <?php } ?>
        </table>
    </body>
  </html>
