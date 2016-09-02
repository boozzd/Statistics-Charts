# Statistics charts
### Requirements
- Bower
- Docker
- Docker Compose
- PHP 5.4
- MySQL
- NGINX
### Installation

- Clone project: ```git clone https://github.com/boozzd/Statistics-Charts.git```
- Install bower dependencies: ```bower install```
#### Using Docker
- From root project directory run command: ```docker-compose up```
#### Using without Docker
- Change settings in config file:
> app/config/config.php
- Make sure that your local PHP+NGINX configure to the `app/index.php`
#### Continue
- Apply migration. Go to the `http://localhost/migrate.php` or apply it from CLI `php migrate.php`
- Complete.
