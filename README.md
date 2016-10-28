# About
This project is intended for learning purposes only. The code contains solutions that have security and performance vunarabilities so please don't use it in
production. 

Any form of damages that you cause opon youself and others as a result of running code from the project is your own responsibilies. I do not 
leave any form of resposibilities or guarantees. 

You can follow along in my tutorials series [on youtube](https://www.youtube.com/watch?v=sbDkHuY9p8w&list=PLjxbCynJ0Gd9SEi9RnXOPcaEIhITFtruB&index=1) in order to see all the steps of developent. 

# Setup
- Make sure you have [composer](https://getcomposer.org/doc/00-intro.md) installed.
- Make sure that you have some way of hosting you php application. (like [MAMP](https://www.mamp.info/en/), [LAMP](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu), [XAMPP](https://www.apachefriends.org/index.html))
- Make sure you have [MySQL installed](https://dev.mysql.com/downloads/installer/) **NOTE**: MySQLis included in MAMP, LAMP and XAMPP.

In the tutorials I have php 5.6 installed. If you want to use some other php version, like php 7, I cannot guarantee that it's gonna work for you.

- `git clone https://github.com/victor-axelsson/php_backend.git`
- `composer install`
- `composer dump-autoload`
- setup your env file: 

```
DB_NAME=<your db name>
DB_IP=<ip to your db, like localhost or 127.0.0.1>
DB_USER=<your db username>
DB_PASSWORD=<your db user password>
DB_PORT=<the port number>
```
