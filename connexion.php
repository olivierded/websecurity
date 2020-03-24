<?php


session_start();
if(isset($_SESSION['login'])){session_destroy(); }


if(isset($_POST['send'])){
    if (empty($_POST['email']) OR empty($_POST['password'])){
            ?> <script>alert('l un des champs est vide est vide!')</script> <?php
    }
    else{

        try {
            $connexion = new  PDO("mysql:host=localhost;dbname=bdsecu", "root", "rootroot");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException  $e) {
			echo("Erreur  connexion :" . $e->getMessage());
			exit();
        }
        
        $email =$_POST['email'];
        $pwd= $_POST['password'];

        $bd = $connexion->query("select * FROM personne where email = '".$email."' and pwd = '".$pwd."'");//"'or 1=1;#
        $line = $bd->fetch();
        if($line){
            header('location:listePersonne.php');
        }
        else{
            ?><script>alert('utilisateur non trouvé!')</script><?php
            }
        //var_dump($line);
        // echo $line;

        /*
        $bd = $connexion->query("select * FROM personne ");
        $i = 0;
        while($line = $bd->fetch()){
            if($line['email']== $email and $line['pwd'] == $pwd){
               $i++; 
            }
        }
        
        if($i == 1){
            header('location:listePersonne.php');
        }
        else{
            ?><script>alert('utilisateur non trouvé!')</script><?php
            }
        */
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

