<?php
require('pagetemplate.php');
use wip\pagetemplate;
$ob = new pagetemplate();
require('database.php');
include('secure/registrationlogin.php');
$conn = createConnection();
?>

<form name="login" id="loginForm" action="signup.php" method="POST">
    <div>
        <fieldset class="login">
            <legend>Signup form</legend>
            <?php include('secure/errors.php'); ?>
            <div class="namediv">
                <label for="firstNameField"><b>FIRST NAME:</b></label>
                <input type="text" id="firstNameField" name="firstNameField" required pattern="[a-zA-Z0-9\s]+">
            </div>
            <div class="namediv">
                <label for="lastNameField"><b>LAST NAME:</b></label>
                <input type="text" id="lastNameField" name="lastNameField" required pattern="[a-zA-Z0-9\s]+">
            </div>
            <br><br>
            <label for="studentIdField"><b>Student ID:</b></label>
            <br>
            <input type="number" id="studentIdField" name="studentIdField">
            <br><br>
            <label for="schoolSelection"><b>Currently only Metropolitan State University is available</b></label><br>
            <select id="schoolSelection" name="schoolSelection">
                <option value="1">Metropolitan State University</option>
            </select>
            <br><br>
            <label for="majorSelection"><b>Intended Major:</b></label>
            <br>
            <select id="majorSelection" name="majorSelection">
                <option value="0">Select a major</option>
                <?php
                    $query = "SELECT ID, NAME FROM MAJORS ORDER BY NAME ASC";
                    $result = $conn -> query($query);
                    while($row = mysqli_fetch_array($result)){
                        $rows[] = $row;
                    }
                    foreach($rows as $row){
                        echo "<option value='". $row['ID']."'>" . $row['NAME'] . "</option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="emailField"><b>School Email:</b></label>
            <br>
            <input type="email" id="emailField" name="emailField" required>
            <br>
            <label for="passwordField"><b>Password:</b></label>
            <br>
            <input type="password" id="passwordField" name="password" required>
            <br>
            <label for="passwordField"><b>Confirm Password:</b></label>
            <br>
            <input type="password" id="passwordField" name="repeatPassword" required>
            <br>
            <br><br>
            <label><b><u><a href="login.php">Already have an account? Log in here</a></b></u></label>
            <br><br>
            <input type="submit" value="Submit" name="reg_user">
        </fieldset>
    </div>
</form>

<?php
$ob->loadfooter();
?>
