This installation presumes all necessary packages have been installed.
Following packages are needed:
- MySQL
- php 5.5 (or later)
- composer
- mcrypt
- curl
- pdo_mysql

Before running the installer, the MySQL database server must be running.

To install the application, navigate to /htdocs/
    $ cd ./htdocs/
and run composer install:
    $ composer install
and return
    $ cd ../

Navigate to the install/ directory and run the installer:
    $ cd ./install/
    $ ./install.sh
and return
    $ cd ../

This will initialize the database and seed it with some default entries.

To run the application, navigate to htdocs/ directory:
    $ cd htdocs/
    $ php artisan serve
