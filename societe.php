
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

$resultat = $bdd->query('SELECT * FROM societe');


if(isset($_POST['submit'])){
  $nomsociete = $_POST['nomsociete'];
  $pays = $_POST['pays'];
  $tva = $_POST['tva'];
  $type = $_POST['type'];

  $rq = $bdd -> prepare("INSERT INTO societe ( nomsociete, pays, tva, type)
        VALUES ( :nomsociete, :pays, :tva, :type)");
    $rq ->execute(array(
      'nomsociete' => $nomsociete,
      'pays' => $pays,
      'tva' => $tva,
      'type' => $type,
    )) ;
    header('location:societe.php'); //permet de rafraichir la page en y renvoyant automatiquement
}

if(isset($_POST['supSoc'])){
  $sc = $_POST['select'];
  foreach($sc as $suppr)
  {
    $rq = $bdd -> prepare("DELETE FROM societe WHERE idsociete = ?");
    $rq->execute(array(
      $suppr
    ));
  }
  header('location:societe.php');
}

?>


<!DOCTYPE HTML>
  <html>
    <body>
      <form style="margin:10px" method="post" enctype = "multipart/form-data" action="">
        <table border='1'>
        	<tr>
            <th>Check</th>
            <th>Id</th>
            <th>Nom</th>
            <th>Pays</th>
            <th>N. TVA</th>
            <th>type</th>
          </tr>

        	<?php
        	while ($donnees = $resultat->fetch())
        	{ ?>
          	<tr>
              <td><input type="checkbox" name="select[]" value="<?= $donnees['idsociete']?>" /></td>
							<td><?= $donnees['idsociete']?></td>
							<td><?= $donnees['nomsociete']?></td>
          		<td><?= $donnees['pays']?></td>
          		<td><?= $donnees['tva']?></td>
          		<td><?= $donnees['type']?></td>
            </tr>
          <?php } ?>
        </table>

        <h1>Ajouter une société</h1>
        <p>Nom Société:</p>
        <input type="text" name="nomsociete"><br>
        <p>Pays:</p>
        <input type="text" name="pays"><br>
        <p>N. TVA: </p>
        <input type="number" name="tva"><br>
        <p>type: </p>
				<select name="type">
          <?php
					$list = $bdd->query('SELECT DISTINCT type FROM societe');

          foreach ($list as $value) {


          ?>
            <option value="<?= $value['type']?>"><?= $value['type']?></option>
          <?php
          }
									    ?>
        </select><br>
        <button type="submit" name="submit" value="submit">Ajouter</button>
					<input type="submit" name="supSoc" value="Supprimer" />
				</form>

      </body>
      </html>
