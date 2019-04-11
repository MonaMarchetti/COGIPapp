

<?php
try
{
	// On se connecte à MySQL
	$bdd= new PDO('mysql:host=localhost; dbname=Cogip;charset=utf8', 'user123', 'user123');

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
    header('location:contacts.php'); //permet de rafraichir la page en y renvoyant automatiquement
}

if(isset($_POST['supPers'])){
  $sc = $_POST['select'];
  foreach($sc as $suppr)
  {
    $rq = $bdd -> prepare("DELETE FROM personne WHERE idpersonne = ?");
    $rq->execute(array(
      $suppr
    ));
  }
  header('location:contacts.php');
}

?>


<!DOCTYPE HTML>
  <html>
    <body>
      <form style="margin:10px" method="post" enctype = "multipart/form-data" action="">
        <table border='1'>
        	<tr>
            <th>Check</th>
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
              <td><input type="checkbox" name="select[]" value="<?= $donnees['idpersonne']?>" /></td>
              <td><?= $donnees['nom']?></td>
          		<td><?= $donnees['prenom']?></td>
          		<td><?= $donnees['tel']?></td>
          		<td><?= $donnees['email']?></td>
          		<td><?= $donnees['nomsociete']?></td>
            </tr>
          <?php } ?>
        </table>

        <h1>Ajouter un contact</h1>
        <p>Nom:</p>
        <input type="text" name="nom"><br>
        <p>Prénom:</p>
        <input type="text" name="prenom"><br>
        <p>Téléphone:</p>
        <input type="number" name="tel"><br>
        <p>Email:</p>
        <input type="email" name="email"><br>
        <p>Societe:</p>
        <select name="societe">
          <?php
          foreach ($list as $value) {
          ?>
            <option value="<?= $value['idsociete']?>"><?= $value['nomsociete']?></option>
          <?php
          }
          ?>
        </select><br>
        <button type="submit" name="submit" value="insert">Ajouter</button>
					<input type="submit" name="supPers" value="Supprimer" />
				</form>

      </body>
      </html>
