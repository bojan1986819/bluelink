<?php
$db_conf = array(
    "type" => 'mysqli',
    "server" => env('DB_HOST', 'localhost'),
    "user" => env('DB_USERNAME', 'admin'),
    "password" => env('DB_PASSWORD', 'admin'),
    "database" => env('DB_DATABASE', 'bluelink'),
);