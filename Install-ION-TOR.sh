#!/bin/bash

#TOR
sudo apt-get install -y tor

read -r -p "Please enter the password of your local mysql server: " _PASSWORD1

echo $_PASSWORD1

sed -i 's/raspberry/'$_PASSWORD1'/g' ./*.php
sed -i 's/raspberry/'$_PASSWORD1'/g' ./paasmertor/*.php

echo "
HiddenServiceDir /var/lib/tor/hidden_service/
HiddenServicePort 80 127.0.0.1:80
HiddenServicePort 22 127.0.0.1:22
HiddenServiceAuthorizeClient stealth haremote1
" >> /etc/tor/torrc

#tor restart
sudo /etc/init.d/tor restart

sudo mv /var/www/html/index.html /var/www/html/index_old.html

sudo cp -r ./paasmertor/* /var/www/html/


update-rc.d udhcpd enable

sudo mysql -uroot -p$_PASSWORD1 -e "create database paasmer;use paasmer;create table  feeddetails(id int auto_increment not null primary key,feedname1 varchar(30),feedname2 varchar(30),feedname3 varchar(30),feedname4 varchar(30),feedcontrol1 varchar(30),feedcontrol2 varchar(30),feedcontrol1pin int,feedcontrol2pin int,feedcontrol1status varchar(30),feedcontrol2status varchar(30),devicename varchar(30) not null);create table sensordetails(id int auto_increment not null primary key,feedname varchar(30) not null,value int,time varchar(30) not null);"

if [ -f "/var/lib/tor/hidden_service/hostname" ]
then
cat /var/lib/tor/hidden_service/hostname
fi
