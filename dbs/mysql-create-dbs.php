<?php
include "dbs-const.php";

// Create connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br>";
// Create database
$sql = "CREATE DATABASE " . DBNAME . ";";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();


?>