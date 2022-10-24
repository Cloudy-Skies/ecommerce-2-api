<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'eu-cdbr-west-03.cleardb.net');
define('DB_USERNAME', 'b2a21de5a2ce10');
define('DB_PASSWORD', '1b17406f ');
define('DB_NAME', 'heroku_408a343ea3e0bac');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if(!$link){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>