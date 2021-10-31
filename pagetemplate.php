<?php
    namespace wip;
    class pagetemplate{

        public static $root = "";

        function __construct(){
            $local = false;
            //self::$root = $_SERVER["DOCUMENT_ROOT"];
            if($local == false) {
                self::$root = $_SERVER['DOCUMENT_ROOT'] . '/wip/';
            }
            include self::$root . 'includes/header.php';
            //include self::$root . '/includes/menu.php';

        }

        function loadfooter(){
            include self::$root . 'includes/footer.php';
        }
    }
?>