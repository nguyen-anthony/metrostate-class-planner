<?php
session_start();
require('pagetemplate.php');

use wip\pagetemplate;

$ob = new pagetemplate();
require('database.php');
//include('secure/passwordReset.php');
$conn = createConnection();


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== True) {
    echo "<script>alert(\"You have to log in to access this page!\")</script>";
    header("location: login.php");
    exit;
}
$id = $_SESSION['id'];

?>

<div class="panelNoBorder">
    <div class="accountInformation">
        <form id="accountInformation" name="accountInformation">
            <legend>Personal information</legend>
            <div class="namediv">
                <label for="firstNameField"><b>First Name:</b></label>
                <input type="text" id="firstNameField" name="firstNameField" disabled>
            </div>
            <br>
            <div class="namediv">
                <label for="lastNameField"><b>Last Name:</b></label>
                <input type="text" id="lastNameField" name="lastNameField" disabled>
            </div>
            <br>
            <label for="emailField"><b>Email:</b></label><br>
            <input type="email" id="emailField" name="emailField" disabled><br>
            <br>
            <label for="studentField"><b>Student Id:</b></label><br>
            <input type="number" id="studentField" name="studentField" disabled>
            <br>
            <a href="contact.php">Contact an Admin to make any changes to the above information.</a>
        </form>
    </div>
    <div class="passwordReset">
        <?php include('secure/errors.php'); ?>
        <p id="notifications" style="display:none;"></p>
        <form id="passwordReset" name="passwordReset" action="account.php" method="POST">
            <legend>Change password</legend>
            <input type="hidden" id="userID" name="userID" value="<?php echo $id; ?>">
            <label for="oldPassword"><b>Old Password:</b></label>
            <br>
            <input type="password" id="oldPassword" name="oldPassword">
            <br>
            <label for="newPassword"><b>New Password:</b></label>
            <br>
            <input type="password" id="newPassword" name="newPassword">
            <br>
            <label for="confirmPassword"><b>Confirm Password:</b></label>
            <br>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <br><br>
            <button type="button" id="submitPwReset" name="submitPwReset">Submit</button>
        </form>
    </div>
    <div class="import">
        <form id="downloadClassData" name="downloadClassData" method="post" action="forms/CSVController.php">
            <legend>Import and Export class data</legend>
            <label for="downloadData">Download class data:</label>
            <input name="downloadClassData" type="hidden">
            <br>
            <button type="submit">Download completed classes</button>
        </form>
        <br>
        <form id="downloadExampleCSV" name="downloadExampleCSV" method="post" action="forms/CSVController.php">
            <label for="downloadExampleCSV">Download example CSV</label>
            <input name="downloadExampleCSV" type="hidden">
            <br>
            <button type="submit">Download</button>
        </form>
        <br>
        <form id="dataUpload" name="dataUpload" action="forms/CSVController.php" method="post">
            <label for="importClassData">Import Class Data</label>
            <input type="file" id="importClassData" name="importClassData" disabled>
            <button type="submit" disabled>Upload</button>
        </form>
    </div>
</div>
<script src="js/account.js"></script>

<?php
$ob->loadfooter();
?>