<?php
include('../database.php');
session_start();

$conn = createConnection();
$errors = array();

//if(isset($_POST['updateAccountBtn'])){
    $userID = mysqli_real_escape_string($conn, $_POST['userId']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);
    $roleID = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if(empty($email)) {array_push($errors, "Email is required");}
    if(empty($firstname)) {array_push($errors, "First name is required");}
    if(empty($lastname)) {array_push($errors, "Last name is required");}
    if(empty($studentID)) {array_push($errors, "Student ID is required");}
    if($roleID ==0) {array_push($errors, "Role selection is required");}

    $userCheck = "SELECT * FROM USERS WHERE USERNAME='$email' OR STUDENT_ID='$studentID' LIMIT 1";
    $result = mysqli_query($conn, $userCheck);
    $user = mysqli_fetch_assoc($result);

//    if($user){
//        if($user['USERNAME'] === $email){
//            array_push($errors, "Username already exists");
//        }
//
//        if($user['STUDENT_ID'] === $studentID){
//            array_push($errors, "Student ID already exists");
//        }
//    }

    if(count($errors) == 0){
        $updateQuery = "UPDATE USERS SET USERNAME='$email', FIRST_NAME='$firstname', LAST_NAME='$lastname',STUDENT_ID='$studentID',ROLE_ID='$roleID' WHERE ID='$userID'";
        $result = mysqli_query($conn, $updateQuery);
        $success = True;
        $_SESSION['success'] = True;
        echo $success;
        header('location: ../admin/adminUpdate.php');
    }
// }

?>

