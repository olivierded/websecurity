# Execice 1

Les points suivants sont des éléments du code qui pourraient être un problème de sécurité :

- __Les commentaires inappropriés__ : Les trois commentaires du codes n'ont rien à voir avec la logique du code. Ce genre de commentaires peut être un problème de sécurité dans le sens où ils peuvent divulguer des informations (sur le fonctionnement de l'entreprise par exemple) qui étaient censées être confidentielles.

- __Il n'existe pas de système d'authentification__ : A priori tout le monde pourra appeler l'API même ceux qui n'y ont pas droit.

- __Le repertoire SECURE_DIRECTORY n'est pas sécurisé__ : Vu qu'il n'a pas de permission particulière et que n'importe quel personne qui reussi à se connecter au serveur a le droit d'écriture.