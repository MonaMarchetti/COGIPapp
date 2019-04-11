<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();

// On récupère nos variables de session
if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

  // On teste pour voir si nos variables ont bien été enregistrées
  echo '<html>';
  echo '<head>';
  echo '<title>Page de notre section membre</title>';
  echo '</head>';

  echo '<body>';
  echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';
  echo '<br />';

  // On affiche un lien pour fermer notre session
  echo '<a href="./logout.php">Déconnection</a>';
}
else {
  echo 'Les variables ne sont pas déclarées.';
}
?>
