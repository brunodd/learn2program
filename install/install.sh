#!/bin/bash

#########################
##### SETUP DATABASE ####
#########################



# Seeding database
if [ $# -eq 1 ]
then
	if [[ "$1" == "-seed" ]]
	then
		php ../htdocs/artisan db:seed
	elif [[ "$1" == "-init" ]]
	then
		# Load fresh environment
		cp ../htdocs/.envbackup ../htdocs/.env

		# Configure app/config/database.php
		echo "### SETTING UP DATABASE ###"
		read -p "Database username: " username
		read -p "Database password: " password

		sed -i.bak 's/DB_USERNAME=root/DB_USERNAME='$username'/g' '../htdocs/.env'
		sed -i.bak 's/DB_PASSWORD=/DB_PASSWORD='$password'/g' '../htdocs/.env'

		# Load database
		mysql -u "${username}" -p "${password}" < ../database/learn2program.sql

	elif [[ "$1" == "-all" ]]
	then
		# Load fresh environment
		cp ../htdocs/.envbackup ../htdocs/.env

		# Configure app/config/database.php
		echo "### SETTING UP DATABASE ###"
		read -p "Database username: " username
		read -p "Database password: " password

		sed -i.bak 's/DB_USERNAME=root/DB_USERNAME='$username'/g' '../htdocs/.env'
		sed -i.bak 's/DB_PASSWORD=/DB_PASSWORD='$password'/g' '../htdocs/.env'

		# Load database
		mysql -u "${username}" -p "${password}" < ../database/learn2program.sql

		php ../htdocs/artisan db:seed
	else
		echo "usage: install.sh [flag]"
		echo "Flags:"
		echo "\t-all -> Initialize and seed the database"
		echo "\t-init -> initialize the database"
		echo "\t-seed -> seed the database"
	fi
else
	echo "usage: install.sh [flag]"
	echo "Flags:"
	echo "\t-all -> Initialize and seed the database"
	echo "\t-init -> initialize the database"
	echo "\t-seed -> seed the database"
fi
