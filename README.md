Sample application using yii2-ecom package
=============
The only purpose of this package is to demonstrate usage and features of the package [opus-online/yii2-ecom](https://github.com/opus-online/yii2-payment). Examples include:

- Example database setup with products, discounts, orders, invoices, users and payment log
- ActiveRecord models implementing Order and Product functionality
- Full order lifecycle (list → basket → order → payments → invoices)
- UI components to list all AR objects (plus shopping basket contents)

Installation 
------------
You need an environment running PHP 5.4+ and an empty database. 

1. `git clone https://github.com/opus-online/yii2-app-ecom`
2. `cd yii2-app-ecom`
3. `composer install --no-dev`
4. `./yii init`
5. Follow the instructions on the screen to set up the database

See the [documentation](https://github.com/opus-online/yii2-payment) for `opus-online/yii2-ecom` for more. 

Database schema
---------------
This is the database schema used by the application. Active Record models have been generated using [opus-online/yii2-advmodel](https://github.com/opus-online/yii2-advmodel).

![Database schema](https://github.com/opus-online/yii2-app-ecom/blob/master/schema/schema.png?raw=true "Database schema")
