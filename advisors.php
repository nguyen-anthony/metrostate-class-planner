<?php

session_start();
require('database.php');

$conn = createConnection();
$userId = $_SESSION['id'];

function getStudents($conn){
    global $userId;
    $sql = 'SELECT * FROM USERS WHERE ADVISOR_ID = ' . $userId;
    $studentData = '';

    foreach($conn->query($sql) as $row){
        $studentInfo = $row['STUDENT_ID'] . " - " . $row['FIRST_NAME'] . " - " . $row['LAST_NAME'];
        $studentData .= '<option id="' . $row['ID'] . '" value="' . $row['ID'] . '">' . $studentInfo . '</option>';

    }

    echo $studentData;

}





function sortAdvisorData($conn){
    $data = $_GET['data'];

    switch($data){
        case 'clean':
            getStudents($conn);
            break;
    }

}

sortAdvisorData($conn);