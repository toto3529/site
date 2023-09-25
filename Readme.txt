
Christophe LECLERE : 

Le site est le travail conjoint de plusieurs stagiaires.

La version Symfony du projet est 4.4.44 :
- Les bugs sur cette version sont fixés jusqu'en novembre 2022 et la sécurité des composants jusqu'en novembre 2023
- Il y a un conflit entre la version de Doctrine et le MakerBundle qui entraine de nombreux bugs de développement (impossibilité de MAJ des entités, de l'architecture de la base de données, migrations HS, et autres). Les possibilités de modification de l'application et d'implémentation de nouveaux composants sont donc considérablement réduites.

-> Prévoir une montée de version avant toute modification conséquente du site. 


- J'ai tenté d'installer les modules Glide et Liip Imagine, pour pouvoir générer des vignettes des photos contenues dans l'album-photo, pour réduire la masse de données à l'affichage du carousel de la page accueil. je n'ai pas réussi à les faire fonctionner, les bundles ne s'installent pas correctement, certainement à cause de ces conflits.


- Afin de permettre à l'administrateur d'obtenir des statistiques sur la fréquentation du site, j'ai implémenté le module Matomo, car il est plus conforme à la protection des données au sens Européen, que Google Analytics qui est aujourdh'hui déconseillé à ce titre. 
Il est hébergé sur un sous-domaine du serveur pour une meilleure maintenance. 


- Pour le développement en local, j'ai travaillé sous Wamp. Habituellement je lance l'affichage du projet via le menu Localhost -> dossier public. Pour ce projet ça n'a pas fonctionné, il faut lancer Wamp, puis via l'invite de commande le serveur 8000 sur le dossier Public directement : 
C:\wamp64\www\vrnb\public> php -S localhost:8000
Je suis passé par un Virtual Host.


Les codes d'accès au dashboard Matomo, au serveur d'hébergement et à l'accès SSH sur le serveur sont à récupérer auprès de l'administrateur. 


Antoine MARTIN VAUFREY

passage de SF 4.4 à 6.3 (Php 8.1 fait par hébergeur)