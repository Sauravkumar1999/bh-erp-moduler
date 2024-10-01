# BusinessHub ERP Modular

Sales items and platforms are provided to salespeople, and a certain commission is paid when items are sold through the platform. A sales organization is created and operated in a multi-level manner, and when a lower-level salesperson sells a product, a certain portion of the commission is distributed to the upper-level salesperson.

For sales products, the recommender and sales status can be tracked through the recommender code.

A referral code is assigned to each salesperson in Business Hub, and when accessing a sales product, the referral code is automatically attached and redirected.

However, for some products, the referral code assigned by Business Hub cannot be used, so for some products, the administrator manually assigns the code for the product to each salesperson.
## Documents about project
https://www.notion.so/mustcompany/Product-BusinessHub-a74fecb17ec44e4ba3e59806f540d7c7?pvs=4

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- PHP
- Composer
- Git

### Installing

##### Step 1: Clone the project from Git

```bash
git clone git@github.com:globalmsq/bh-erp.git
```
##### step 2: move to project folder
```bash
cd bh-erp
```
##### step 3: Install Composer dependencies
```bash
 composer install
```
##### step 4: Copy the environment file
Use the provided dev.env file to generate your .env file:
```bash
 copy etc\configs\env.dev .env
```
##### step 5: Generate application key
```bash
 php artisan key:generate
```
### Setting Up the Database
##### step 6: Exporting Database Locally
To export the database, you can use a database management tool such as phpMyAdmin, SQLyog, or Adminer. Follow these steps:

##### 1. Open Database Management Tool:
Launch your preferred database management tool. If you haven't installed one yet, you can download and install tools like phpMyAdmin, SQLyog, or Adminer.

##### 2. Connect to Database:
Use the following connection details to connect to your database:
````angular2
DB_CONNECTION=mysql
DB_HOST=p2u-rds-infra-dev-centralrdsinstance0c56c151-p0jyz6gov1xu.cjqroyjy0ipx.ap-northeast-2.rds.amazonaws.com
DB_PORT=3306
DB_DATABASE=bh_erp_db
DB_USERNAME=bh_erp_dev
DB_PASSWORD=DWh7mKdEpjc5JGzDnCu9
````
##### 3. Export Database:
Once connected to the database, navigate to the export or backup section of your database management tool.

#### How to Export Database:
https://www.loom.com/share/f6160f6d223f4bdb9a42ac403095a8e9

##### step 7: Importing Database Locally
To import the database into your local environment, you can use the same database management tool that you used for exporting, such as phpMyAdmin, SQLyog, or Adminer.
https://www.loom.com/share/54a9312f1cad456aa3ae23de451ea28e

##### step 8: Setting Up the Database
Configure the database connection settings in the .env file. Provide the appropriate values for DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD.
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

##Usage
#####Run Development Server
Start the Laravel development server:

```php artisan serve```

Access the application at http://localhost:8000 in your web browser.

Login 
=====
URL: ```http://localhost:8000/login```

username: ```developer@developer.com```

password: ```123developer@123```
