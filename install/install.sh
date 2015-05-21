#!/bin/sh
# Setup website and configure cronjobs
# Don't sudo this script.

#########################
##### SETUP DATABASE ####
#########################

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

# Seeding database
php ../htdocs/artisan db:seed
