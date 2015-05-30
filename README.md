# TORelay

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
