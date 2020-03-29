<?php


session_start();
if(isset($_SESSION['login'])){session_destroy(); }

if(isset($_POST['send'])){
    #Remove any illegal character from the data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pwd = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
   

    if (empty($_POST['email']) OR empty($_POST['password'])){
            ?>
                <script>
                    alert('l un des champs est vide est vide!')
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
    elseif($_POST['email'] != $email OR $_POST['password'] != $pwd){ 
        ?>
            <script>
                alert('un des champ est invalide!')
            </script>
        <?php
    }

    else{

        try {
            $connexion = new  PDO("mysql:host=localhost;dbname=bdsecu", "root", "rootroot");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException  $e) {
			echo("Erreur  connexion :" . $e->getMessage());
			exit();
        }
        
        $email1 =$_POST['email'];
        $pwd1= $_POST['password'];

        $bd = $connexion->query("select * FROM personne where email = '".$email1."' and pwd = '".$pwd1."'");//"'or 1=1;#
        $line = $bd->fetch();
        if($line){
            header('location:listePersonne.php');
        }
        else{
            ?><script>alert('utilisateur non trouvé!')</script><?php
            }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
    <link rel="stylesheet" href="css2/style.css" type="text/css">
</head>
<body>
    <div id="haut" >
    </div>

    <div>
        <div id="milieuForm" >
            <div  >
                <H3>se connecter</H3>
                <form method="post" action="connexion.php">
                    <input  name="email" type="text" size="40"  placeholder="email" style="margin-top: 5px;"/></br></br>
                    <input  name="password" type="password" size="40"  placeholder="password" /></br></br>
                    <input  name="send" type="submit"  value="send" id="btn-primary"/>
                    <input  name="reset" type="reset"  id="btn-danger" />
                    <a href="insertPerson.php"> inscrivez-vous! </a>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

