1. Database:

- Navigeer naar juiste dir/

~~~sh
cd .../learn2program/database/
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

2. Server

- Navigeer naar juiste dir/

~~~sh
cd .../learn2program/htdocs/
~~~

- Start server

~~~sh
php artisan serve
~~~

- Testen:

Typ in browser:

localhost:8000  
klik maar wat rond...

3. Routes
Om te zien welke routes beschikbaar zijn, gebruik commando:

~~~sh
$ php artisan route:list
~~~
