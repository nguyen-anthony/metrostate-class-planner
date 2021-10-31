<?php
require('../pagetemplate.php');
use wip\pagetemplate;
$ob = new pagetemplate();
require('../database.php');
$conn = createConnection();
?>
    <div class="panelNoBorder">
        <p id="notifications" style="display:none;"></p>
        <?php include('adminerrors.php'); ?>
        <div class="adminUpdatePanel">
            <?php
                $userId = $_GET['ID'];
                $username = $_POST['emailField'];
                $lookupuser = "SELECT * FROM USERS WHERE ID='$userId' LIMIT 1";
                $user = mysqli_fetch_assoc(mysqli_query($conn, $lookupuser));
                $roleID = $user['ROLE_ID'];
                $lookuprole = "SELECT * FROM ROLES WHERE ID='$roleID' LIMIT 1";
                $role = mysqli_fetch_assoc(mysqli_query($conn, $lookuprole));
            ?>
            <form id="userUpdateForm" name="userUpdateForm">
                <legend>Update User Information</legend>
                <input type="hidden" id="userID" name="userID" value="<?php echo $user['ID'];?>">
                <div class="emaildiv">
                    <label for="emailField"><b>EMAIL/USERNAME:</b></label>
                    <input type="email" id="emailField" name="emailField" value="<?php echo $user['USERNAME'];?>">
                </div>
                <label for="firstNameField"><b>FIRST NAME:</b></label>
                <input type="text" id="firstNameField" name="firstNameField" value="<?php echo $user['FIRST_NAME'];?>" pattern="[a-zA-Z0-9\s]+">
                <br>
                <label for="lastNameField"><b>LAST NAME:</b></label>
                <input type="text" id="lastNameField" name="lastNameField" value="<?php echo $user['LAST_NAME'];?>" pattern="[a-zA-Z0-9\s]+">
                <br>
                <label for="studentIDField"><b>STUDENT ID:</b></label>
                <input type="number" id="studentIDField" name="studentIDField" value="<?php echo $user['STUDENT_ID'];?>">
                <br>
                <label for="roleField"><b>ROLE:</b></label>
                <select id="roleSelection" name="roleSelection">
                    <option value="0">Select a role</option>
                    <?php
                        $query = "SELECT * FROM ROLES ORDER BY ID ASC";
                        $result = $conn -> query($query);
                        while($row = mysqli_fetch_array($result)){
                            $rows[] = $row;
                        }
                        foreach($rows as $row){
                            if($roleID == $row['ID']){
                                echo "<option value='". $row['ID']."' selected>" . $row['ROLE_NAME'] . "</option>";
                            } else {
                                echo "<option value='". $row['ID']."'>" . $row['ROLE_NAME'] . "</option>";
                            }
                        }
                    ?>
                </select>
                <br>
                <input type="submit" name="updateAccountBtn" id="updateAccountBtn">
                <input type="button" name="deleteButton" id="deleteButton" value="Delete">
            </form>
        </div>
    </div>
<script src="adminUpdate.js"></script>
<?php
$ob->loadfooter();
$_SESSION['success'] = False;
?>