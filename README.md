# Installation
##Python interpreter
Install dependencies (-g flag is optional for global installation):

~~~sh
$ sudo npm install [-g] jscs
$ sudo npm install [-g] jshint
~~~

Clone skulpt repo to public directory. (path tussen vierkante haakjes [../learn2program] eventueel zelf aan te vullen!)

~~~sh
$ git clone https://github.com/skulpt/skulpt [../learn2program]/htdocs/public/skulpt
$ cd [../learn2program]/htdocs/public/skulpt
$ ./skulpt.py dist
~~~
Set-up should now be completed.

##Environment
Hernoem file:

~~~sh
$ mv htdocs/.env.example htdocs/.env
~~~

Aanpassingen:

DB_HOST=127.0.0.1  
DB_DATABASE=learn2program_db  
DB_USERNAME=root  
DB_PASSWORD=  

[Al de rest mag ongewijzigd blijven]

##Database
- Installeren (manier 1)

[opmerking: by default: username = "root", password = "". Indien mysql iets vraagt moeten deze ingegeven worden.]

Create tables:

~~~sh
$ mysql -u root -p < database/learn2program.mysql
~~~

- Installeren (manier 2)
Create tables and insert values into them:

~~~sh
$ mysql -u root -p
mysql> create database learn2program_db;
mysql> exit
$ php artisan migrate --seed
~~~
or
~~~sh
$ php artisan migrate
$ php artisan db:seed
~~~
Neemt tables in database/migrations en inputs in database/seeds

- Testen:

~~~sh
$ mysql -u root -p
mysql> use learn2program_db;
( mysql> insert into Users(username, pass) Values("myname", "mypassword"); )
mysql> select * from Users;
~~~

Dit zou een tabel moeten geven waarin de aangemaakte user zit. Proficiat de database werkt.

##Server

Navigeer naar juiste dir/

~~~sh
$ cd htdocs/
~~~

- Update dependencies

~~~sh
$ composer update
$ composer install
~~~

- Start server

~~~sh
$ php artisan serve
~~~

Toegankelijk via "localhost:8000"

- Custom URL & port

[opmerking: sudo rechten kunnen vereist zijn]

~~~sh
$ php artisan serve --host=learn2program.dev --port=80
~~~

Pas /etc/hosts aan met volgende entry

~~~
127.0.0.1		learn2program.dev	www.learn2program.dev
~~~

Toegankelijk via "learn2program.dev"

- Testen:

Typ in browser:

localhost:8000

of

http://www.learn2program.dev

klik maar wat rond...

##Routes
Om te zien welke routes beschikbaar zijn, gebruik commando:

~~~sh
$ php artisan route:list
~~~

##Errors
Error: PDOException ... Could not find driver  
Oplossing op Linux: sudo apt-get -y install php5-mysql

Error: General error: 2053  
Oplossing: gebruik geen DB::select() of DB::statement() voor insertions.

