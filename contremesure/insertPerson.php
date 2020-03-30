<?php

if(isset($_POST['envoyer'])) {
  #Remove any illegal character from the data
  $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING); 
  $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);
  echo $pwd;

	if (empty($_POST['nom']) OR empty($_POST['prenom']) OR empty($email) OR empty($_POST['pwd'])) {
		?>
		  <script>
          alert('au moins un des champs du formulaire est vide!')
      </script>
    <?php
  
  }
  #Determine if the data is in proper form
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
    ?>
		    <script>
            alert('le champ email n est pas valide!')
        </script>
    <?php
  }
  #compare sanitized data and posted data
  elseif($_POST['nom'] != $nom OR $_POST['prenom'] != $prenom OR $_POST['email'] != $email OR $_POST['pwd'] != $pwd){ 
    ?>
		    <script>
            alert('un ou plusieurs champs contiennent des caractères non autorisés!')
        </script>
    <?php
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
						
      #a."</a>";echo"<script>alert('xss attack');</script>
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
