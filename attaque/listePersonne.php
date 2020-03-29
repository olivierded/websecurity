<?php


session_start();
if(isset($_SESSION['login'])){session_destroy(); }



try  {  $connexion=  new  PDO( "mysql:host=localhost;dbname=bdsecu;charset=utf8","root","rootroot");
}
catch  (PDOException  $e)
{
    echo("Erreur  connexion :".$e->getMessage()  );
    exit();
}
$bd = $connexion->query("select * FROM personne order by nom ");
$bd1 = $connexion->query("select * FROM personne ");
$i = 0;
while($line = $bd1->fetch()){$i++;}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>liste des personnes</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

    <div id="haut" >

    </div>

    <div>


         <div id="milieu" >
           <div id="choix" >
            <form method="post" action="listePersonne.php">
                <input  name="tromb" type="submit" value="tromb" id="btn-default"/>
                <input  name="list" type="submit" value="list" id="btn-primary" />
                <a href="connexion.php">déconnexion</a>
            </form>
           </div>





        <?php if(isset($_POST['tromb'])){?>

            <div id="lien" align="center"  >
                <h3 align="center"> listes des personnes <?php echo '('.$i.')'?></h3></br>
                <div style="max-height:780px; overflow:auto;border:0px solid;">
                    <?php

                    while($ligne = $bd->fetch()){
                        echo "<div  id='tromb_style'> ";
                     //   echo "<a href='#'><img SRC='".$ligne['photos']."' style='margin-top:10px;'/></a>";
                        echo '<p>'.$ligne['nom'].' '.$ligne['prenom'].'</p>';
                        echo "</div> ";
                    }
                    ?>
                </div>
            </div>

        <?php   }

        else{

       ?>

            <div id="lien" align="center"  >
                <h3 align="center"> listes des personnes <?php echo '('.$i.')'?></h3></br>
                <div style="max-height:780px; overflow:auto; border:0px solid;">
                    <?php

                    while($ligne = $bd->fetch()){
                        echo "<div id='list'> ";
                        echo "<a href='#'>".$ligne['nom']." ".$ligne['prenom']."</a>";
                        echo "</div></br>";
                    }  
                    ?>
                </div>
            </div>

        <?php   } ?>

        </div>
    </div>

</body>
</html>
