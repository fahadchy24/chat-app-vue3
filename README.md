# Chat App
### A Laravel & Vue3 Chat Application

----

## Getting started

### Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Clone the repository

    git clone https://github.com/fahadchy24/chat-app-vue3

Switch to the repo folder

    cd chat-app-vue

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Install the broadcasting functions

    php artisan install:broadcasting

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

Start the local broadcasting server

    php artisan reverb:start

**TL;DR command list**

    git clone git@github.com:fahadchy24/chat-app-vue3.git
    cd chat-app-vue3
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan install:broadcasting

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
    php artisan reverb:start

## Database seeding & backup


Run the database seeder

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh


----------


## Environment variables

- `.env` - Environment variables can be set in this file

<br>




***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

## Screenshots

|Admin Dashboard|User Dashboard|Chat Box|    
|------------|-------------|----------|
|<img src="https://raw.githubusercontent.com/fahadchy24/chat-app-vue3/main/public/assets/images/admin-end-dashboard.png" width="250">|<img src="https://raw.githubusercontent.com/fahadchy24/chat-app-vue3/main/public/assets/images/user-end-dashboard.png" width="250">|<img src="https://raw.githubusercontent.com/fahadchy24/chat-app-vue3/main/public/assets/images/chat-box.png" width="250">
