# [TORelay.com](https://torelay.com)

https://torelay.com

A simple TOR relay app.

![Image of Torelay](https://raw.githubusercontent.com/yadakhov/torelay/master/public/img/torelay.png)

TORelay is written using the [Lumen](http://lumen.laravel.com/) Web Framework.

## Minimum requirement
The Lumen framework has a few system requirements:

- Linux server (recommended)
- PHP >= 5.4
- Mcrypt PHP Extension
- OpenSSL PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension

## Installing nginx websever on ubuntu based system
```bash
sudo apt get update
sudo apt get upgrade

# install nginx and php5
sudo apt-get install nginx php5-fpm php5-cli php5-mcrypt php5-curl curl git

# install composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# clone the clone codebase
cd ~
mkdir www
cd www
git clone https://github.com/yadakhov/torelay
cd torelay
composer install
# storage folder needs to be writable by the web server
sudo chmod o+w -R storage
# configurations
cp .env.example .env
# change configurations to match your server
nano .env

# nginx virtual host
cd /etc/nginx/sites-available/
sudo touch torelay
sudo nano torelay

# Copy and paste nginx configurations. Change USERNAME to your account username. 
server {
    listen 80;
    server_name torelay.app;
    root "/home/USERNAME/www/torelay/public";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log /var/log/nginx/torelay.app-access.log;
    error_log  /var/log/nginx/torelay.app-error.log error;

    sendfile off;

    client_max_body_size 100m;

    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
    }

    location ~ /\.ht {
        deny all;
    }
}

# save and exit

# symlink conf to sites-enabled folder
sudo ln -s /etc/nginx/sites-available/torelay  /etc/nginx/sites-enabled/torelay

# restart nginx server and php5-fpm
sudo service nginx restart
# You should see OK for the last command or you screwed up
# To view nginx log do the following
tail -f /var/log/nginx/error.log

sudo service php5-fpm restart
```

## For local http://torelay.app url to work  
```
sudo nano /etc/hosts
# add this line
127.0.0.1       torelay.app
```

## Install TOR on your machine
```bash
sudo apt-get install tor
# TOR configurations
sudo nano /etc/tor/torrc
# Make sure you have this line
RunAsDaemon 1
ControlPort 9051
CookieAuthentication 1
# restart tor service
sudo service tor restart
```

## Ensure TOR runs on boot
```
sudo apt-get install rcconf
sudo rcconf
```

## The web server user 'www-data' needs sudo
This may weaken your security.  A good idea is to run your webserver as another user other than www-data
```
sudo visudo
# Add the following end of file:
www-data ALL = NOPASSWD : ALL
# Save and exit
```

## TOR
This product is produced independently from the Tor anonymity software and carries no guarantee from
The Tor Project about quality, suitability or anything else.
