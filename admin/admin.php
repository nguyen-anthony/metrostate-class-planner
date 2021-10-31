<?php
require('/home/rissxhla/nguyenanthony.com/wip/pagetemplate.php');

use wip\pagetemplate;

$ob = new pagetemplate();

require('../database.php');
$conn = createConnection();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== True) {
    header("location: ../login.php");
    exit;
}

if (isset($_SESSION["loggedin"]) && $_SESSION["admin"] == False) {
    header("location: ../account.php");
}
?>
<div class="panel">
    <div class="adminPanel">
        <h5 class="title"><b>Admin Panel</b></h5>
        <div class="studentsGrid">
            <b>Students</b>
            <table id="userTable">
                <tr>
                    <th> </th>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                    <th>STUDENT ID</th>
                    <th>MAJOR</th>
                </tr>
                <?php
                $users = array();
                $sql = 'SELECT * FROM USERS WHERE DELETE_DATE IS NULL AND ROLE_ID = 1';
                foreach ($conn->query($sql) as $row) {
                    array_push($users, $row['ID']);
                }

                foreach ($users as $user) {
                    $userQuery = 'SELECT * FROM USERS WHERE ID = ' . $user;
                    foreach ($conn->query($userQuery) as $userRow) {
                        $majorQuery = 'SELECT * FROM MAJORS WHERE ID = ' . $userRow['MAJOR_ID'];
                        $major = mysqli_fetch_assoc(mysqli_query($conn, $majorQuery));
                        $output = $output . '<tr><td><input type="checkbox" name="studentCk" onClick="ckChange(this)"></td><td>' . $userRow['ID'] . '</td><td>' . $userRow['USERNAME'] . '</td><td>' .
                            $userRow['FIRST_NAME'] . '</td><td>' . $userRow['LAST_NAME'] . '</td><td>' . $userRow['STUDENT_ID'] . '</td><td>' . $major['NAME'] .
                            '</td></tr>';
                    }
                }

                echo $output;
                ?>
            </table>
            <br>
            <input type="button" id="editButton" value="Edit Selected Student">
        </div>
        <br>
        <br>
        <div class="advisorsGrid">
            <b>Advisors</b>
            <table id="advisorTable">
                <tr>
                    <th> </th>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                </tr>
                <?php
                $advisors = array();
                $advisorSQL = 'SELECT * FROM USERS WHERE DELETE_DATE IS NULL AND ROLE_ID = 2';
                foreach ($conn->query($advisorSQL) as $advisorRow) {
                    array_push($advisors, $advisorRow['ID']);
                }

                foreach ($advisors as $advisor) {
                    $advisorQuery = 'SELECT * FROM USERS WHERE ID = ' . $advisor;
                    foreach ($conn->query($advisorQuery) as $advisorRow) {
                        $majorQuery = 'SELECT * FROM MAJORS WHERE ID = ' . $advisorRow['MAJOR_ID'];
                        $major = mysqli_fetch_assoc(mysqli_query($conn, $majorQuery));
                        $advisorOutput = $advisorOutput . '<tr><td><input type="checkbox" name="advisorCk" onClick="ckChangeAdvisor(this)"></td><td>' . $advisorRow['ID'] . '</td><td>' . $advisorRow['USERNAME'] . '</td><td>' .
                            $advisorRow['FIRST_NAME'] . '</td><td>' . $advisorRow['LAST_NAME']  . '</td></tr>';
                    }
                }

                echo $advisorOutput;
                ?>
            </table>
            <br>
            <input type="button" id="editAdvisorButton" value="Edit Selected Advisor">
        </div>
        <br>
        <br>
        <div class="adminGrid">
            <b>Admins</b>
            <table id="adminTable">
                <tr>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                </tr>
                <?php
                $admins = array();
                $adminSQL = 'SELECT * FROM USERS WHERE DELETE_DATE IS NULL AND ROLE_ID = 3';
                foreach ($conn->query($adminSQL) as $adminRow) {
                    array_push($admins, $adminRow['ID']);
                }

                foreach ($admins as $admin) {
                    $adminQuery = 'SELECT * FROM USERS WHERE ID = ' . $admin;
                    foreach ($conn->query($adminQuery) as $adminRow) {
                        $majorQuery = 'SELECT * FROM MAJORS WHERE ID = ' . $adminRow['MAJOR_ID'];
                        $major = mysqli_fetch_assoc(mysqli_query($conn, $majorQuery));
                        $adminOutput = $adminOutput . '<tr><td>' . $adminRow['ID'] . '</td><td>' . $adminRow['USERNAME'] . '</td><td>' .
                            $adminRow['FIRST_NAME'] . '</td><td>' . $adminRow['LAST_NAME']  . '</td></tr>';
                    }
                }

                echo $adminOutput;
                ?>
            </table>
        </div>
    </div>
</div>
<script src="adminUpdate.js"></script>
<?php
$ob->loadfooter();
?>