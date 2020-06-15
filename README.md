# Chinese Wall Visualisation

This is a demonstration of the Chinese wall policy used in the consulting companies.

## Installation

To run the web application you will need a web server. Hence install Apache using the following command.

```bash
$ sudo apt-get install apache2
```

Run the command below to install MySQL.
```bash
$ sudo apt-get install mysql-server
```
Install MySQL Workbench to create and edit databases. It is graphical tool used to model data, build SQL queries and manage MySQL servers.Run the following command. 

```bash
$ sudo apt install mysql-workbench
```
Also create a database with name "chineseWall" and run the files provided in the folder ChineseWallDatabase in this GitHub folder to create tables.

Enter the below command to install php
```bash
$ sudo apt-get install php libapache2-mod-php
```

Clone this GitHub folder into the location /var/www/html/ on your linux operating system. After you clone the folder go to chineseWall/inc/config.php and change the password to your password that you have set to connect to the MySQL server. Then you can just type the following link on your browser to get to the login page.   

```bash
localhost/chineseWall/login.php
```
