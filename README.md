# Installation

## Install using the installer (Recommended)
This installation presumes all necessary packages have been installed.
Following packages are needed:

- php 5.5 (or later)
	- sudo apt-get install php5-cli
- MySQL
	- 
- curl  
- composer  
- mcrypt  
- pdo_mysql  

Before running the installer, the MySQL database server must be running.

To install the application, navigate to /htdocs/
and run composer install:

~~~sh
$ cd htdocs/
$ composer install
~~~

and return

~~~sh
$ cd ../
~~~

Navigate to the install/ directory and run the installer:

~~~sh
$ cd install/
$ ./install.sh
~~~

and return

~~~sh
$ cd ../
~~~

This will initialize the database and seed it with some default entries.

To run the application, navigate to htdocs/ directory:

~~~sh
$ cd htdocs/
$ php artisan serve
~~~

## Install manually (not recommended)
###Python interpreter
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

###Environment
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

###Database
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

###Server

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

## TROUBLESHOOTING 
(Only for linux. OS X fixes are similar, but can't use the apt-get package manager):  

--
Installing composer:

~~~sh
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
~~~
--
I get the error:

~~~
[PDOException]
could not find driver
~~~

Run:

~~~sh
$ dpkg --get-selections | grep php5-mysql
$ sudo apt-get install php5-mysql
~~~
--
I get the error:

~~~
mcrypt extension is missing
~~~

Run:

~~~sh
$ sudo apt-get install mcrypt php5-mcrypt
$ sudo php5enmod mcrypt
$ sudo service mysql restart
~~~

