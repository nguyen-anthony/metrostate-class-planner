<?php
require('pagetemplate.php');
use wip\pagetemplate;

$ob = new pagetemplate();

?>
<br><br>
<form name="contactForm" id="contactForm" action="forms/contactconfirm.php" method="POST">
    <div>
        <fieldset class="cform">
            <legend>Contact Form</legend>
            <div class="namediv">
                <label for="firstNameField"><b>FIRST NAME:</b></label>
                <input type="text" id="firstNameField" name="firstNameField" required pattern="[a-zA-Z0-9\s]+">
            </div>
            <div class="namediv">
                <label for="lastNameField"><b>LAST NAME:</b></label>
                <input type="text" id="lastNameField" name="lastNameField" required pattern="[a-zA-Z0-9\s]+">
            </div>
            <br><br>
            <label for="emailField"><b>EMAIL:</b></label>
            <input type="email" id="emailField" name="emailField" required><br>
            <label for="detailsTextBox"><b>ADDITIONAL DETAILS:</b></label><br>
            <textarea id="detailsTextBox" name="detailsTextBox" required></textarea>
            <br><br>
            <input type="submit" value="Submit">

        </fieldset>
    </div>
</form>

<br><br>

<?php
$ob->loadfooter();
?>

