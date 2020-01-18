# Prerequisite

- php >= 7.2
- [Composer](https://getcomposer.org/)
- [NodeJs](https://nodejs.org/en/)
- pdo_sqlite (php extension => file : php.ini)
- mb_string (php extension => file : php.ini)
- OpenSSL => needed for composer (add : `extension=php_openssl.dll` at the end of file php.ini)

# Getting Started

- clone the application : `git clone https://github.com/MaximeBattu/escalapp.git` 
- open command terminal in the folder created/cloned
- install composer : `composer install` OR `php composer.phar install`
- install composer dependency : doctrine (to make sure update migration are working ) : `composer require doctrine/dbal`
- create sqlite file : `database.sqlite` in `database/`
- duplicate file `.env.example` and rename it `.env` => situated at the root of the folder `escalapp`
- open the following file `.env` and modify `DB_DATABASE` you have to pass the absolute path to `database.sqlite`
    - Warning : put `/` instead of `\` (on Windows)
    - If the path contains space, put it in quotes
    - Ex : `DB_DATABASE="F:/Users/Maxime BATTU/Desktop/escalapp/database/database.sqlite"`
- launch database migrations : `php artisan migrate`
- launch database seeders : `php artisan db:seed`
- generate application key : `php artisan key:generate`
- install frontend dependencies : `npm install`
- compile frontend files : `npm run dev`
- launch application with php local server : `php artisan serve`
- open your browser and search `localhost:8000` or the affected port (display on command terminal)
- If you want to do css/js, launch : `npm run watch` in an other command terminal 

# Adding project to git

- Before sending your modifications on the git you must compile your frontend files (production mod) `npm run prod`
- Add the files you modified/created/deleted : `git add .`
- Check the status of the files you've added : `git status`
- Commit your modification : `git commit -m "Message"` 
- After pushing you need to pull the actual project : `git pull` or `git pull origin master`
    - You need to read the command terminal and see in which files you have conflicts and fixed them
    - It's good to open the files with conflicts on VSCode : it helps you to fixed your conflicts (automatically)
    ![Example of conflict on VSCode](https://cdn.discordapp.com/attachments/586278324217708554/662438843210924043/unknown.png)
    - Once you fixed your conflicts you need to add the files you modified `git add .` then commit your changes `git commit -m "your message : solve conflicts on ..."`
- Finally you can push your modifications on the git : `git push` or `git push origin master`

# Problems

- If you have style problem when you pulled the project launch : `npm run dev`

