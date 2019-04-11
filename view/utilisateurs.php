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

$resultat = $bdd->query('SELECT * FROM utilisateur');

if(isset($_POST['submit'])){
  $nom = $_POST['Nom'];
  $prenom = $_POST['Prénom'];
  $type = $_POST['Type'];
  $password = $_POST['Password'];
	$idutilisateur = $_POST['Type'];

  $rq = $bdd -> prepare("INSERT INTO utilisateur ( nom, prenom, type,  password, idutilisateur )
        VALUES ( :nom, :prenom, :type, :password, :idutilisateur )");
    $rq ->execute(array(
      'nom' => $nom,
      'prenom' => $prenom,
      'type' => $type,
      'password' => $password,
			'idutilisateur' => $idutilisateur
    )) ;
    header('location:connexion.php'); //permet de rafraichir la page en y renvoyant automatiquement
}

?>


<!DOCTYPE HTML>
  <html>
    <body>
      <form style="margin:10px" method="post" enctype = "multipart/form-data" action="">
        <table border='1'>
        	<tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Type</th>
            <th>Password</th>
          </tr>

        	<?php
        	while ($donnees = $resultat->fetch())
        	{ ?>
          	<tr>
              <td><?= $donnees['nom']?></td>
          		<td><?= $donnees['prenom']?></td>
          		<td><?= $donnees['type']?></td>
          		<td><?= $donnees['password']?></td>
            </tr>
          <?php } ?>
        </table>

        <h1>Ajouter un utilisateur</h1>
        <p>Nom:</p>
        <input type="text" name="Nom"><br>
        <p>Prénom:</p>
        <input type="text" name="Prénom"><br>
        <p>Type:</p>
				<select name="Type">
          <?php
          foreach ($resultat as $value) {
          ?>
            <option value="<?= $value['idutilisateur']?>"><?= $value['type']?></option>
          <?php
          }
          ?>
        </select><br>
        <p>Password:</p>
        <input type="text" name="Password"><br>

        <button type="submit" name="submit" value="insert">Ajouter</button>
        </form>

      </body>
      </html>
