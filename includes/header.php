<html>
    <head>
        <title>Work In Progress - Web Application</title>

        <?php
            $local = false;
            $root = $_SERVER["DOCUMENT_ROOT"]; //C:\xampp\htdocs\
            if($local == false){
                $root = $_SERVER["DOCUMENT_ROOT"];
            }
            $docRoot = "https://".$_SERVER['HTTP_HOST'];
            if($local == false){
                $docRoot = "https://".$_SERVER['HTTP_HOST'];
            }
            include($root.'/wip/includes/external.php');
            session_start();
        ?>
        <link rel="stylesheet" href="<?=$docRoot?>/wip/css/style.css">
        <!--<script src="<?=$docRoot ?>js/site.js"></script>-->
    </head>

    <body>
        <div id="navbar">
            <ul id="navheader">
                <li class="navitem"><a id="logo" href="https://nguyenanthony.com/wip/" class="navlink">WIP</a></li>
                <?php
                if($_SESSION["loggedin"] === True){
                    echo "<li class=\"navitem\"><a href=\"https://nguyenanthony.com/wip/tour.php\" class=\"navlink\">PROGRESS</a></li>";
                } else {
                    echo "<li class=\"navitem\"><a href=\"https://nguyenanthony.com/wip/tour.php\" class=\"navlink\">TOUR</a></li>";
                }
                ?>
                <li class="navitem"><a href="https://nguyenanthony.com/wip/contact.php" class="navlink">CONTACT</a></li>
                <?php
                    if($_SESSION["loggedin"] === True){
                        echo "<li class=\"navitem\"><a href=\"https://nguyenanthony.com/wip/logout.php\" class=\"loginBtn\">LOGOUT</a></li>";
                        echo "<li class=\"navitem\"><a href=\"https://nguyenanthony.com/wip/account.php\"><i class=\"fas fa-user fa-lg\"></i></a></li>";
                    } else {
                        echo "<li class=\"navitem\"><a href=\"https://nguyenanthony.com/wip/login.php\" class=\"loginBtn\">SIGN UP/SIGN IN</a></li>";
                    }
                ?>
            </ul>
        </div>
    <hr>

