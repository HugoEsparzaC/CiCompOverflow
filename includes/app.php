<?php

use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

// Connect to the database
ActiveRecord::setDB($db);