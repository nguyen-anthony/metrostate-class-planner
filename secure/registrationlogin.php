<?php
    include('../database.php');
    session_start();

    $conn = createConnection();
    $errors = array();
    $success = False;

    if(isset($_POST['reg_user'])){
        $firstname = mysqli_real_escape_string($conn, $_POST['firstNameField']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastNameField']);
        $studentID = mysqli_real_escape_string($conn, $_POST['studentIdField']);
        $school = mysqli_real_escape_string($conn, $_POST['schoolSelection']);
        $roleID = "1";
        $major = mysqli_real_escape_string($conn, $_POST['majorSelection']);
        $email = mysqli_real_escape_string($conn, $_POST['emailField']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $repeatPassword = mysqli_real_escape_string($conn, $_POST['repeatPassword']);

        if(empty($email)) {array_push($errors, "Email is required");}
        if(empty($firstname)) {array_push($errors, "First name is required");}
        if(empty($lastname)) {array_push($errors, "Last name is required");}
        if(empty($studentID)) {array_push($errors, "Student ID is required");}
        if(empty($school)) {array_push($errors, "School selection is required");}
        if($major == 0) {array_push($errors, "Major selection is required");}
        if(empty($password)) {array_push($errors, "Password is required");}
        if($password != $repeatPassword){
            array_push($errors, "Passwords do not match!");
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            array_push($errors,'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
        }

        $userCheck = "SELECT * FROM USERS WHERE USERNAME='$email' OR STUDENT_ID='$studentID' LIMIT 1";
        $result = mysqli_query($conn, $userCheck);
        $user = mysqli_fetch_assoc($result);

        if($user){
            if($user['USERNAME'] === $email){
                array_push($errors, "Username already exists");
            }

            if($user['STUDENT_ID'] === $studentID){
                array_push($errors, "Student ID already exists");
            }
        }

        if(count($errors) == 0){
            $password = md5($password);
            $register = "INSERT INTO USERS (USERNAME, PASSWORD, FIRST_NAME, LAST_NAME, ROLE_ID, STUDENT_ID, MAJOR_ID, CREATE_DATE, UPDATE_DATE) 
                    VALUES ('$email','$password','$firstname','$lastname','$roleID','$studentID','$major',curdate(),curdate())";
            mysqli_query($conn, $register);
            $success = True;
            $_SESSION['success'] = True;
            header('location: ../wip/login.php');
        }
    }

    if(isset($_POST['login_user'])) {
        $email = mysqli_real_escape_string($conn, $_POST['emailField']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if(empty($email)) {
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }

        if(count($errors) == 0) {
            $password = md5($password);
            $login = "SELECT * FROM USERS WHERE USERNAME='$email' AND PASSWORD='$password'";
            $results = mysqli_query($conn, $login);
            $user = mysqli_fetch_assoc($results);
            if(mysqli_num_rows($results) == 1){
                $_SESSION["id"] = $user['ID'];
                $_SESSION['username'] = $email;
                $_SESSION["role"] = $user['ROLE_ID'];
                $_SESSION['success'] = True;
                $_SESSION["loggedin"] = True;
                if($user['ROLE_ID'] == '3'){
                    $_SESSION["admin"] = True;
                    header('location: ../wip/admin/admin.php');
                } else {
                    $_SESSION["admin"] = False;
                    header('location: ../wip/account.php');
                }
            }else {
                array_push($errors, "Wrong username/password combination");
            }

        }
    }

?>