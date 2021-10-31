<?php
require('pagetemplate.php');
use wip\pagetemplate;
$ob = new pagetemplate();
require('database.php');
include('secure/registrationlogin.php');
$conn = createConnection();
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === True & $_SESSION["admin" !== True]){
    header("location: account.php");
    exit;
}
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === True & $_SESSION["admin" === True]){
    header("location: admin/admin.php");
    exit;
}
?>
<form name="login" id="loginForm" action="login.php" method="POST">
    <div>
        <fieldset class="login">
            <legend>Login</legend>
            <?php include('secure/errors.php'); ?>
            <label for="emailField"><b>Username:</b></label>
            <input type="email" id="emailField" name="emailField" required><br>
            <label for="passwordField"><b>Password:</b></label>
            <input type="password" id="passwordField" name="password" required><br>
            <br><br>
            <label><b><u><a href="signup.php">Not a member? Create an account here</a></b></u></label>
            <br><br>
            <input type="submit" value="Submit" name="login_user">
        </fieldset>
    </div>
</form>

<?php
$ob->loadfooter();
$_SESSION['success'] = False;
?>

