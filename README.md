# websecurity
utilisation de mysql 8.0.18
BD login: root
BD password:rootroot

injection sql utiliser <<  //"'or 1=1;#  >> dans le champs email et n'importe quoi dans le champ password

attaque xss persistante (insertion en dure dans la bd d'une ligne de code qui s'exécute à chaque appel de la page listePersonne.php) insertion faite depuis la page insertPersonne.php evec :
   a."</a>";echo"<script>alert('xss attack');</script>
