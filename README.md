# Instalation

##### Recupération du projet :

`git clone git@github.com:oipnet-mentorat/symfony-ajax.git`

##### Instalation des dependances :

`composer install`

`npm install`

##### Compilation des assets :

`npm run dev`

##### Création du fichier .env :

`cp .env.dist .env`

Le projet est configuré pour utiliser une base de donnée sqlite

##### Creation de la base de donnée :

`bin/console doctrine:schema:create && bin/console doctrine:fixtures:load`

##### Lancement du serveur

`bin/console server:run`