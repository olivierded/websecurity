# Execice 1

Les points suivants sont des éléments du code qui pourraient être un problème de sécurité :

- __Faille XSS__: Le code présente une sensibilité aux injections xss. La fonction request.args() est utilisée pour récupérer les valeurs associées a des clés sans vérification des informations saisies par l’utilisateur. Un utilisateur malveillant peut au vu du code injecter un script bash dans les champs « ssn » et « email ». Plusieurs buts peuvent être visés dans ce cas:
    - L’utilisateur peut avoir pour objectif de récupérer la totalité des informations présentes dans le secure_directory;
    - Ou peut avoir pour objectif de supprimer tous les fichiers du répertoire
    Ainsi il pourra injecter dans le champs email un script qui permet d’exécuter des commandes bash dans le repertoire « /tmp/ » de la machine cible.

Si l'on passe par exemple ``` ;rm -r * ;``` dans le champ 'ssn', lors de l'appel ```s = {"list": lambda: list_secure_data(request.args['ssn']),``` qui lui même appel ``` os.system('ls' + SECURE_DIRECTORY + '/' + path)[1] ```, va donc supprimer tous les fichiers du repertoire.

- Le script utilise un random_key statique et basique pour générer une clé de chiffrement basé sur l’algorithme ECB (Electronic Code Book). Il s’agit ici du plus simple algorithme de chiffrement par bloc qui va découper la chaîne de caractère en plusieurs blocs de taille identique, les chiffrer puis les assembler en un seul bloc. Un attaquant ayant réussit à exploiter la faille ci-dessus peut facilement décrypter les données cryptées à l’aide de cette clé. Il suffit qu’il l’utilise lui même pour crypter des données, puis ils pourra effectuer une identification par bloc pour comprendre les associations entre valeurs réelles et valeurs chiffrées.

- __Les commentaires inappropriés__ : Les trois commentaires du codes n'ont rien à voir avec la logique du code. Ce genre de commentaires peut être un problème de sécurité dans le sens où ils peuvent divulguer des informations (sur le fonctionnement de l'entreprise par exemple) qui étaient censées être confidentielles.

- __Il n'existe pas de système d'authentification__ : A priori tout le monde pourra appeler l'API même ceux qui n'y ont pas droit.

- __Le repertoire SECURE_DIRECTORY n'est pas sécurisé__ : Vu qu'il n'a pas de permission particulière et que n'importe quel personne qui reussi à se connecter au serveur a le droit d'écriture.

[Exercice 2](README.md)