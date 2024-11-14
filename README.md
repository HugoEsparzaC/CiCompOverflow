# CiComp Overflow
A forum platform designed for Computer Science students to collaborate, ask questions, and share knowledge, inspired by Stack Overflow.

## How to Run the Page Locally
### Start the Apache2 and MySQL servers
```bash
sudo systemctl start httpd
```
```bash
sudo systemctl start mysql
```
### Create the Database
There is a `.mwb` file for MySQL Workbench.
### Add a `.env` File in the `includes` Folder
The file should contain the following information:
```bash
DB_HOST = 
DB_USER = 
DB_PASS = 
DB_NAME = 

MAIL_HOST = 
MAIL_PORT = 
MAIL_USERNAME = 
MAIL_PASSWORD = 

APP_URL = 
```
The values depend on your credentials.
### Install Dependencies
```bash
nmp i
```
```bash
composer install
```
### Start the Apache Server to View the Page
```bash
cd public/
```
```bash
php -S localhost:3000
```
