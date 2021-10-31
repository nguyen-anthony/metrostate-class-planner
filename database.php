<?php
    function createConnection(){
        $host = 'localhost';
        $user = 'rissxhla_ics325sp2123';
        $password = 'wipprogram1!';
        $db = 'rissxhla_ics325sp2130';

        $conn = new mysqli($host,$user,$password,$db);

        if(mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        return $conn;
    }
?>