<?php
session_start();

include('../database.php');
$conn = createConnection();

$id =  $_GET['id'];

if ($id == 1) {
    $sql = "SELECT * FROM USERS WHERE ID = " . $_SESSION['id'];
    $results = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($results);
    echo json_encode($user);
}
