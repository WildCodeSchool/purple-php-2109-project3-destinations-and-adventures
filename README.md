# How to install and deploy this app

Here is a link of a video going through each steps (in french): https://www.youtube.com/watch?v=AAap9qRHgIk
 
 #### Prerequisites

- Check the PHP version installed on the SSH server. For our tutorial, we have used the 7.1 version. Be sure to replace "7.1" with the actual version if different.
 
#### Getting ready

1. Connect to your server via SSH

2. Go inside the folder you want to deploy your project in


#### Composer

1. Install [Composer](https://getcomposer.org/) in your folder
2. `curl -sS https://getcomposer.org/installer | php-7.1 -d allow_url_fopen=On`

  

#### Import the project

1. Run `git clone https://github.com/WildCodeSchool/purple-php-2109-project3-destinations-and-adventures.git` on the SSH command line 


#### Installing dependencies

Use Composer to install all the required dependencies (first check the PHP version installed in the server, here we've used PHP 7.1) :

    php-7.1  -d allow_url_fopen=on -d memory_limit=-1 composer.phar install

#### Deploying Encore Assets

Run this command to get the .css and .js assets :

    ./node_modules/.bin/encore production

#### Populating the database

Enter the .env file at the root of the project and edit :
 -   "APP_ENV=dev" to "APP_ENV=prod"
 -   The database parameters to the ones you get from your host (DATABASE_URL=...)

Now you can set up your database by execute each of these commands:
- `php-7.1 bin/console doctrine:database:drop --force`
- `php-7.1 bin/console doctrine:database:create`
- `php-7.1 bin/console doctrine:schema:update --force`

#### Clear the cache

    php-7.1 bin/console cache:clear

Here you go! Your website is now online and ready to go.

# First steps on the app

To access the app for the first time, you will need to create a first account.
To do so, go to the **/register** path.

There you will be asked to set up the first account.

Once your account is created, you can log into the app and start using it.
