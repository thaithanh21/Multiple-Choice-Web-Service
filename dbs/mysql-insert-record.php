<?php
include "dbs-const.php";
include "../questionbank/questionbank-const.php";

// Create connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br>";



// Parse json file
$str = file_get_contents("../questionbank/questions.json");
$json = json_decode($str, true); // decode the JSON into an associative array
foreach ($json as $subjName => $questionArray) {
    foreach ($questionArray as $question){  // Iterate through each question
        $questionContent = "";
        $answer = "";
        $choices = "";
        $difficulty = "";
        foreach($question as $key => $value) {
            if ($key == "choices") {
                foreach ($value as $choice){
                    $choices = $choices . $choice . ", ";
                }
                $choices = substr($choices, 0, strlen($choices) - 2);
            } else if ($key == "question") {
                $questionContent = $value;
            } else if ($key == "answer") {
                $answer = $value;
            } else if ($key == "difficulty") {
                $difficulty = DIFFICULTY[$value];
            }
        }
        insertRecord(SUBJECT[$subjName], $difficulty, $questionContent, $choices, $answer);  
    }

}

function insertRecord($subj, $difficulty, $questionContent, $choices, $answer) {    // Insert record to QuestionBank
    global $conn;
    $sql = "SELECT * FROM " . TABLENAME . " WHERE Question=" . "\"" . $questionContent . "\"" . ";";
    $similarQuestion = $conn->query($sql);
    if ($similarQuestion->num_rows > 0) {
        echo "Question: {" . $questionContent . "} already exists<br>";
        return;
    }
    $sql = "INSERT INTO QuestionBank (Subject, Difficulty, Question, Choices, Answer) VALUES";
    $sql = $sql . "(" . $subj . ", " . $difficulty . ", " . "\"" . $questionContent . "\"" . ", " . "\"" . $choices . "\"" . ", " . $answer . ");";
    if ($conn->query($sql)) {
        echo "New record inserted successfully<br>";
    } else {
        echo "Error inserting record: " . $conn->error . "<br>";
    }

}



$conn->close();


?>