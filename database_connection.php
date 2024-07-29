<?php 

// data base details
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'advance_booking_system';

// connection
$conn = new mysqli($host, $user, $password, $db_name);

if(!$conn){
    echo 'Connection interrupted!.. Close and Try Again!..'.$conn->connection_error();
    exit();
}

?>