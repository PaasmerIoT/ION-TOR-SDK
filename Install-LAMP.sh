#########################################################################
#LAMP for Raspberry Pi                                                  #
#This script will install Apache, PHP, FTP, and MySQL.                  #
#This script was written by Harbour, Justin                             #
#[C] 2013 Justin Harbour: See LICENSE.md for details                    #
#########################################################################

#!/bin/bash

#Prerequisites
sudo apt-get update

#TOR
#sudo apt-get install -y tor

#FTP
sudo apt-get install -y proftpd

#Apache
sudo apt-get install -y apache2
sudo echo "ServerName localhost" >> /etc/apache2/httpd.conf

#PHP
sudo apt-get install -y php5 libapache2-mod-php5 php5-intl php5-mcrypt php5-curl php5-gd php5-sqlite

#sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password raspberry'
#sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password raspberry'


#MySQL
sleep 4
echo "The password for MYSQL Server must be more than 8 characters and it should be alphanumeric"
sleep 4
sudo apt-get install -y mysql-server mysql-client php5-mysql

#apt-get update
#sudo dpkg --configure -a

#apt-get install expect

#VAR=$(expect -c '
#spawn sudo apt-get -y install mysql-server
#expect "New password for the MySQL \"root\" user:"
#send "raspberry\r"
#expect "Repeat password for the MySQL \"root\" user:"
#send "raspberry\r"
#expect eof
#')

#echo "$VAR"

#sudo apt-get -y install mysql-client libmysqlclient15-dev  php5-mysql 

#For some reason important to restart - otherwise possible errors

#sudo /etc/init.d/mysql stop
#sudo /etc/init.d/mysql start


#Additional Dependencies
sudo apt-get install -y nmap zenmap

#echo "
#HiddenServiceDir /var/lib/tor/hidden_service/
#HiddenServicePort 80 127.0.0.1:80
#HiddenServicePort 22 127.0.0.1:22
#HiddenServiceAuthorizeClient stealth haremote1
#" >> /etc/tor/torrc

#tor restart
#sudo /etc/init.d/tor restart

#sudo mv /var/www/html/index.html /var/www/html/index_old.html

#sudo cp -r ./paasmertor/* /var/www/html/


update-rc.d udhcpd enable

#sudo mysql -uroot -praspberry -e "create database paasmer;use paasmer;create table  feeddetails(id int auto_increment not null primary key,feedname1 varchar(30),feedname2 varchar(30),feedname3 varchar(30),feedname4 varchar(30),feedcontrol1 varchar(30),feedcontrol2 varchar(30),feedcontrol1pin int,feedcontrol2pin int,feedcontrol1status varchar(30),feedcontrol2status varchar(30),devicename varchar(30) not null);create table sensordetails(id int auto_increment not null primary key,feedname varchar(30) not null,value int,time varchar(30) not null);"

#if [ -f "/var/lib/tor/hidden_service/hostname" ]
#then
#cat /var/lib/tor/hidden_service/hostname
#fi
