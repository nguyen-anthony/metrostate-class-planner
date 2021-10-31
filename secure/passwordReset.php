<?php
include('../database.php');
session_start();

$conn = createConnection();
$errors = 0;
$success = False;
$successMsg = array();
$result = "";

$userID = $_POST['userId'];
$oldPw = mysqli_real_escape_string($conn, $_POST['oldPw']);
$newPw = mysqli_real_escape_string($conn, $_POST['newPw']);
$confirmPw = mysqli_real_escape_string($conn, $_POST['confirmPw']);
$uppercase = preg_match('@[A-Z]@', $newPw);
$lowercase = preg_match('@[a-z]@', $newPw);
$number    = preg_match('@[0-9]@', $newPw);
$specialChars = preg_match('@[^\w]@', $newPw);
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPw) < 8) {
    $result = "fail";
    $errors = $errors + 1;
}

$pwCheck = "SELECT * FROM USERS WHERE ID='$userID' LIMIT 1";
$result = mysqli_query($conn, $pwCheck);
$user = mysqli_fetch_assoc($result);

    if(md5($oldPw) != $user['PASSWORD']){
        $result = "fail";
        $errors = $errors + 1;
    }

    if($newPw != $confirmPw){
        $result = "fail";
        $errors = $errors + 1;
    }

    if($errors == 0){
        $password = md5($newPw);
        $updatePw = "UPDATE USERS SET PASSWORD ='$password' WHERE ID=$userID";
        mysqli_query($conn, $updatePw);
        $result = "success";
    }

    echo json_encode($result);
?>

