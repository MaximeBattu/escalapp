# Prérequis

- php >= 7.2
- [Composer](https://getcomposer.org/)
- [NodeJs](https://nodejs.org/en/)
- pdo_sqlite (extension php => dans php.ini)
- mb_string (extension php => dans php.ini)
- OpenSSL => pour composer (rajouter : `extension=php_openssl.dll` à la fin du fichier)

# Getting Started

- cloner l'application : `git clone https://github.com/MaximeBattu/escalapp.git` 
- ouvrir cmd dans le dossier crée/cloné
- installer dépendances composer : `composer install` OU `php composer.phar install`
- installer aussi la dépendance doctrine (pour que les changements (update) s'executent bien ) : `composer require doctrine/dbal`
- créer le fichier sqlite : `database.sqlite` dans `database/`
- dupliquer le fichier `.env.example` et le renomer `.env` => situer à la racine du dossier `escalapp`
- ouvrir le fichier .env et modifier le chemin de `DB_DATABASE` en y renseignant le chemin absolu vers le fichier `database.sqlite`
    - attention : mettre des `/` à la place des `\`
    - si le chemin contient des espaces, le mettre entre guillemets
    - ex : `DB_DATABASE="F:/Users/Maxime BATTU/Desktop/escalapp/database/database.sqlite"`
- lancer les migrations de la DB : `php artisan migrate`
- lancer les seeders de la DB (pour avoir les données stockées en brute) : `php artisan db:seed`
- génerer une clé d'apllication : `php artisan key:generate`
- installer les dépendances frontend : `npm install`
- compiler les fichiers frontend : `npm run dev`
- lancer l'application avec le serveur interne php : `php artisan serve`
- ouvrir le navigateur et aller sur `localhost:8000` ou le port afficher sur le cmd
- Si vous faîtes du style lancer : `npm run watch` dans une autre console 

# Adding project to git

- Avant d'envoyer le projet il faut compiler les vues en mode production : `npm run prod`
- Récupération du projet sur le git :  `git pull`
- Ajout des fichiers : `git add .`
- Status des fichiers ajoutés : `git status`
- Commit les fichiers ajoutés : `git commit -m "Message"` 
- Envoyer le commit sur le git : `git push origin master`

# Problems

- Si vous avez des problèmes avec les vues laravel (style non chargé ou pas totalement chargé) hésiter pas à faire un : `npm run dev`

