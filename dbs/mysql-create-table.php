<?php
include "dbs-const.php";

// Create connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br>";
// Create table
$sql = "CREATE TABLE " . TABLENAME . "(
    ID BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    Subject TINYINT(3) NOT NULL,
    Difficulty TINYINT(1) NOT NULL,
    Question VARCHAR(500) CHARACTER SET utf8 NOT NULL,
    Choices VARCHAR(2000) CHARACTER SET utf8 NOT NULL,
    Answer TINYINT(1) NOT NULL
    );";
if ($conn->query($sql) === TRUE) {
    echo "Table QuestionBank created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$conn->close();


?>