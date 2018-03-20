<?php
include "dbs/dbs-const.php";
// Create connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Retrieve record
$sql = "SELECT * FROM QuestionBank;";
$result = $conn->query($sql);
if ( $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $question = "{ " 
                    . "question: " . "\"" . $row["Question"] . "\","
                    . "choices: " . "[" . $row["Choices"] . "],"
                    . "answer: " . $row["Answer"] 
                    . " }";
        echo "<script>" . "questions.push($question);" . "</script>";
    }
} else {
    echo "Error retrieve record: " . $conn->error;
}


$conn->close();


?>