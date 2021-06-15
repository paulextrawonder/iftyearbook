<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'freedb.tech:3306');
define('DB_USERNAME', 'freedbtech_iftyearbook');
define('DB_PASSWORD', '12345');
define('DB_NAME', 'freedbtech_iftyearbook');
 
/* Attempt to connect to MySQL database */
$dbconnected = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($dbconnected === false){
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
}
