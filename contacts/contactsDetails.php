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
$resultat = $bdd->prepare('SELECT * FROM personne LEFT JOIN societe ON personne.idsociete = societe.idsociete WHERE idpersonne =:idpersonne');
$resultat->execute(array(
'idpersonne'=> $_GET['contact']
));
?>


<!DOCTYPE HTML>
  <html>
    <body>
      <?php
        while ($donnees = $resultat->fetch())
        { ?>
          <p>Nom :<?= $donnees['nom']?></p>
          <p>Prénom :<?= $donnees['prenom']?></p>
          <p>Téléphone :<?= $donnees['tel']?></p>
          <p>Email :<?= $donnees['email']?></p>
          <p>Société :<?= $donnees['nomsociete']?></p>
        <?php } ?>
    </body>
  </html>
