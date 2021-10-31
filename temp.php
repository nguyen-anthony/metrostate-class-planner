<?php
    require('database.php');
    $conn = createConnection();


    $firstname = $_POST['firstNameField'];
    $lastname = $_POST['lastNameField'];
    $studentID = $_POST['studentIdField'];
    $school = $_POST['schoolSelection'];
    $role = 'Student';
    $major = $_POST['majorSelection'];
    $email = $_POST['emailField'];
    $password = $_POST['passwordField'];

    echo "Name: ".$firstname." ".$lastname."\nStudentID: ". $studentID."\nSchool Selection: ". $school."\nMajor: ". $major."\nEmail: ". $email."\nPassword ". $password;

    $query = "INSERT INTO USERS (USERNAME, FIRST_NAME, LAST_NAME, ROLE, STUDENT_ID, MAJOR_ID) 
                    VALUES ('$email','$firstname','$lastname','$role','$studentID','$major')";
    echo "<br><br>";

    if ($conn->query($query) === TRUE){
        echo "New user created successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
?>

