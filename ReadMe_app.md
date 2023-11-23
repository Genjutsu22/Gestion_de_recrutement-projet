# Gestion de Recrutement

Is a web application aims to help RH doing their daily tasks of applying jobs.

## Table of Contents

- [About](#about)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Contributing](#contributing)
- [License](#license)

## About

This application has been developped by Abdallah Oubella, and supervised by MR. Hamza Hamout the professor of Web programming in high school of technology of Guelmim. 

## Features

This application has to do

- job application management


## Installation

To use this application firstly you need 

```bash
# Clone the repository
git clone https://github.com/Genjutsu22/Gestion_de_recrutement-projet

# Change into the project directory
cd Gestion_de_recrutement-projet

# Install composer dependencies
composer install

# Run migrations
php artisan migrate

# insert the data in file recrutement.sql in the database using 
localhost/phpmyadmin

# Serve the application
php artisan serve

## To work
# Serve the application
in your browser you can access the candidat account or admin account 

- admin account
http://127.0.0.1:8000/app-admin/login
login : admin-app@gmail.com
pass : admin

- candidat account
http://127.0.0.1:8000/login
you can create your account in registring page