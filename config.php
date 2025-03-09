<?php
$host = 'localhost'; 
$dbname = 'your_database_name'; 
$username = 'your_db_username'; 
$password = 'your_db_password';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>