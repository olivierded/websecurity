<?php

if(isset($_POST['envoyer'])) {

	if (empty($_POST['nom']) OR empty($_POST['prenom']) OR empty($_POST['email']) OR empty($_POST['pwd'])) {
		?>
		<script>alert('au moins un des champs du formulaire est vide!')</script><?php
	}

	else {

		try {
			$connexion = new  PDO("mysql:host=".getenv(HOST_DB).";dbname=bdsecu", "root", "rootroot");
		} catch (PDOException  $e) {
			echo("Erreur  connexion :" . $e->getMessage());
			exit();
		}

        $stmt = $connexion->prepare("insert into personne(nom,prenom,email,pwd) values(:nom,:prenom,:email,:pwd)");
        $stmt->execute(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'email' => $_POST['email'], 'pwd' => $_POST['pwd']));
        
        ?><script>alert('nouvel utilisateur enregistré!')</script><?php
						

	}
}


?>
<html>

<head>
  <title>formulaires</title>
  <meta charsert="UTF-8">
  <link rel="stylesheet" type="text/css" href="css2/style.css" />

</head>

<body >
<div id="haut" >

</div>

<div id="formul" >
        <h2><i> enregistrez-vous</i></h2>
        <form method="post" action="insertPerson.php" enctype="multipart/form-data"  >
        nom : 		<input  name="nom" type="text" maxlength="100" size="60" placeholder="ex: tuo" style="margin-left: 30px;"/></br></br>
        prenom :	<input  name="prenom" type="text" maxlength="100" size="60" placeholder="ex: malick karna" style="margin-left: 3px;"/></br></br>
        email :<input  name="email" type="text" size="60" placeholder="ex: 92100 Antony" style="margin-left: 37px;" /></br></br>
        password :	<input  name="pwd" type="password" size="60" style="margin-left: 37px;" /></br></br>
            <input  name="envoyer" type="submit" value="enregistrer" id="btn-primary" />
            <input  name="annuler" type="reset" value="annuler" id="btn-danger" />
            <a href="connexion.php">retour</a>

        </form>
</div>

</body>
</html>
