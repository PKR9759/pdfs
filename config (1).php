<?php

define('DB_SERVER', '192.168.29.150');
define('DB_USERNAME', 'ce2022_80'); //write the username
define('DB_PASSWORD', 'ce2022_80'); //write the password
define('DB_NAME', 'ce2022_80'); //write the db name

/* Attempt to connect to MySQL/MariaDB database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    //echo "Welcome!";
}
