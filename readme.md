# Prérequis

- php >= 7.2
- [Composer](https://getcomposer.org/)
- [NodeJs](https://nodejs.org/en/)
- pdo_sqlite
- mb_string
- OpenSSL => pour composer

# Getting Started

- cloner l'application : `git clone https://gitlab.com/MaximeBattu/escalapp.git` 
- ouvrir cmd dans le dossier crée/cloné
- installer dépendances composer : `composer install` OU `php composer.phar install`
- créer le fichier sqlite : database.sqlite dans database/
- dupliquer le fichier .env.example et le renomer `.env`
- ouvrir le fichier .env et modifier le chemin de `DB_DATABASE` en y renseignant le chemin absolu vers le fichier database.sqlite
    - attention : mettre des `/` à la place des \
    - si le chemin contient des espaces, le mettre entre guillemets
    - ex : `DB_DATABASE="F:/Users/Maxime BATTU/Desktop/escalapp/database/database.sqlite"`
- lancer les migrations de la DB : `php artisan migrate`
- lancer les seeders de la DB (pour avoir les données stockées en brute) : `php artisan db:seed`
- génerer une clé d'apllication : `php artisan key:generate`
- installer les dépendances frontend : `npm install`
- compiler les fichiers frontend : `npm run dev`
- lancer l'application avec le serveur interne php : `php artisan serve`
- ouvrir le navigateur et aller sur `localhost:8000` ou le port afficher sur le cmd


