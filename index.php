<!DOCTYPE HTML>
<html>
   <head>
		<title>Connexion</title>
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
      <div id="main">
    <h1>Bienvenue à la Cogip!</h1>

    <form action="login.php" method="post">
      Votre login : <input type="text" name="login">
      <br />
      Votre mot de passe : <input type="password" name="pwd"><br />
      <input type="submit" value="Connexion">
    </form>

    <form action="login.php" method="post">
      Vous êtes un simple utilisateur :
      <input type="submit" name="visiteur" value="Visitez">
    </form>
    
        </div>
    <style>
    
    body {
        background-image: url("assets/accountant.jpeg");
    }
        #main {
            margin-left: 20%;
            margin-right 20%;
            margin-top: 10%;
            background-color:rgba(255, 0, 0, 0.6);
        }
        

    </style>
  </body>
</html>
