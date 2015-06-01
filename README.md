# [TORelay.com](https://torelay.com)

TORelay is written using the [Lumen](http://lumen.laravel.com/) Web Framework.

## Minimum requirement
The Lumen framework has a few system requirements:

- Linux server
- PHP >= 5.4
- Mcrypt PHP Extension
- OpenSSL PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension

## Install TOR on your machine
```
sudo apt-get install tor
```

## Ensure TOR runs on boot
```
sudo apt-get install rcconf
sudo rcconf
```

## Config TOR
```bash
# TOR configurations
sudo vi /etc/tor/torrc
# Make sure you have this line
ControlPort 9051
sudo service tor restart
```

## The web server User 'www-data' needs sudo
This may weaken your security.  A good idea is to run your webserver as another other than www-data
```
sudo visudo
# Add the following end of file:
www-data ALL = NOPASSWD : ALL
# Save and exit
```

## TOR
This product is produced independently from the Tor anonymity software and carries no guarantee from
The Tor Project about quality, suitability or anything else
