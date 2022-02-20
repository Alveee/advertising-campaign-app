## Advertising campaign app

This project is a simple application for managing advertising campaigns. The technologies that are used to make this application, are laravel for back-end service, reactjs for fron-end service and MySQL to maintain database.

## Setup

1. Clone this repository
2. Go to project root directory and copy the `env.example` and paste the data in a new file named `.env`
3. Add your environment variables
4. run `docker run --rm \ -u "$(id -u):$(id -g)" \ -v $(pwd):/var/www/html \ -w /var/www/html \ laravelsail/php81-composer:latest \ composer install --ignore-platform-reqs ` command
5. run `./vendor/bin/sail up -d` to start all of the Docker containers in the background
6. run `./vendor/bin/sail artisan migrate` command
7. run `./vendor/bin/sail db:seed`
8. Once the application's containers have been started, you may access the project in your web browser at: http://localhost.
