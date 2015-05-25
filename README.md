# Installation

## Install using the installer (Recommended)
This installation presumes all necessary packages have been installed.
Following packages are needed:
- MySQL
- php 5.5 (or later)
- curl
- composer
- mcrypt

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

Navigate to the install/ directory and run the installer (The -seed flag will also seed the website):

~~~sh
$ cd install/
$ ./install.sh [-seed]
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


<!---
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
-->


###Environment
Rename file:

~~~sh
$ cp htdocs/.envbackup htdocs/.env
~~~

In the .env file:

DB_HOST=127.0.0.1
DB_DATABASE=learn2program_db
DB_USERNAME=root
DB_PASSWORD=

[The rest doesnt matter]

###Database
- Installing

[Note: by default for mysql: username = "root", password = ""]

Create database with empty tables:

~~~sh
$ mysql -u root -p < database/learn2program.mysql
~~~

Seed the database:

~~~sh
$ cd htdocs/
$ php artisan db:seed
~~~

- Testing:

~~~sh
$ mysql -u root -p
mysql> use learn2program_db;
mysql> select * from Users;
~~~

###Server

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

Website will be accessible through "localhost:8000"

- Custom URL & port

[Note: might need sudo rights]

~~~sh
$ php artisan serve --host=learn2program.dev --port=80
~~~

Update /etc/hosts with following entry

~~~
127.0.0.1		learn2program.dev	www.learn2program.dev
~~~

Website will be accessible through "learn2program.dev"

- Test:

Type in browser:

localhost:8000

or

http://www.learn2program.dev

##Routes
To see which routes are available, use command:

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

Your mysql installation isn't complete.
Run:

~~~sh
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

