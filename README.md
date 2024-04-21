## Guide for deploy
- Clone this repo first to local
- Open the folder by using terminal
- Make sure docker on desktop is running
- Run on the terminal, docker-compose up -d --build
- Run "composer install" to installing all dependencies
- Run php artisan key:generate
- Set up .env by copy .env.example to .env
- Run php artisan migrate && db:seed, to migrate table and seed dummy data


## Account

Admin : 
- email : superadmin@test.com
- password : password

User : 
- email : user@test.com
- password : password
