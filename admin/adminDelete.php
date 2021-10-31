<?php
include('../database.php');
session_start();

    $conn = createConnection();
    $errors = array();

    $userID = mysqli_real_escape_string($conn, $_POST['userId']);
    $userCheck = 'SELECT * FROM USERS WHERE ID = ' . $userID;
    $user = mysqli_fetch_assoc(mysqli_query($conn, $userCheck));

    $sql = 'UPDATE USERS SET DELETE_DATE = CURDATE() WHERE ID = ' . $userID;
    $result = mysqli_query($conn, $sql);


?>