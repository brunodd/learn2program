# Installation

## Installation
This installation presumes all necessary packages have been installed.
Following packages are needed:

- php 5.5 (or later)

~~~sh
$ sudo apt-get install php5-cli
~~~

- curl

~~~sh
$ sudo apt-get install curl php5-curl
~~~

- composer

~~~sh
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
~~~

- MySQL + mycrypt

~~~sh
$ sudo apt-get install mysql-server php5-mysql
$ sudo apt-get install mcrypt php5-mcrypt
$ sudo php5enmod mcrypt
$ sudo service mysql restart
~~~

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
$ ./install.sh [-all | -seed | -init]
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

###[Optional: Custom URL & port]

[Note: sudo rights may be required]

~~~sh
$ php artisan serve --host=learn2program.dev --port=80
~~~

Adjust /etc/hosts using the following entry

~~~
127.0.0.1		learn2program.dev	www.learn2program.dev
~~~

Accessible via http://www.learn2program.dev

##Routes
Om te zien welke routes beschikbaar zijn, gebruik commando vanuit htdocs/:

~~~sh
$ php artisan route:list
~~~

