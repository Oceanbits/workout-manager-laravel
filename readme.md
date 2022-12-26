## Perform following steps after clone

- ## install **Composer** with following command 
    - run command: **composer install**
    - to add required autoload file

- ## copy **.env** file from **.env.example**
    - to setup environment variable

- ## add dataBase in **phpMyAdmin**
    - [Open PhpMyAdmin in Browser](http://localhost/phpmyadmin/).
    - add dataBase with same **name** added in **.env** file

- ## perform **Migration** to create DataBase Tables
    - run migration command - **php artisan migrate**

- ## create **Passport Key** by run following command
    - run: **php artisan passport:key**
    - this command will create Key for passport
    - this command added after notice error while deploy on live server

- ## initialize **Passport Client** by run following command
    - run: **php artisan passport:client --personal**
    - and create passport client
