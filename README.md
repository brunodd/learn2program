# Installation
##Environment
Hernoem file:

~~~sh
mv htdocs/.env.example htdocs/.env
~~~

Aanpassingen:

DB_HOST=127.0.0.1  
DB_DATABASE=learn2program_db  
DB_USERNAME=root  
DB_PASSWORD=  

[Al de rest mag ongewijzigd blijven]

##Database:

 Navigeer naar juiste dir/

~~~sh
cd database/
~~~

- Installeren

[opmerking: by default: username = "root", password = "". Indien mysql iets vraagt moeten deze ingegeven worden.]

Create tables:

~~~sh
$ mysql -u root -p < learn2program.mysql
~~~

- Testen:

~~~sh
$ mysql -u root -p
mysql> use database learn2program_db;
mysql> insert into Users(username, pass) Values("myname", "mypassword");
mysql> select * from Users;
~~~

Dit zou een tabel moeten geven waarin de aangemaakte user zit. Proficiat de database werkt.

##Server

Navigeer naar juiste dir/

~~~sh
cd htdocs/
~~~

- Start server

~~~sh
php artisan serve
~~~

- Testen:

Typ in browser:

localhost:8000  
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

