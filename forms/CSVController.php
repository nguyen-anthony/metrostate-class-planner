<?php
    session_start();

    include('../database.php');
    $conn = createConnection();

   function generateCSV() {
       $f = fopen('php://output', "w");
       $headers = ['classes'];
       $classes = ['art-320'];
       fputcsv($f, $headers);
       fputcsv($f, $classes);
       header('Content-Disposition: attachment;filename=Example.csv;');
       header('Content-Type: application/csv');
       fpassthru($f);
       fclose($f);
   }

   function importCSV() {
       echo "testing";
   }

   function downloadCourses($connection) {
       $userId = $_SESSION['id'];

       $completedClasses = [];

       $sql = 'SELECT * FROM user_courses WHERE user_id = ' . $userId;

       foreach($connection->query($sql) as $result){
           array_push($completedClasses, $result['course_id']);
       }

       $f = fopen('php://output', "w");
       $headers = ['completed classes'];
       $classes= [''];
       fputcsv($f, $headers);

       foreach($completedClasses as $class) {
           $classQuery = 'SELECT * FROM courses WHERE id = ' . $class;
           foreach($connection->query($classQuery) as $classDatum) {
               array_push($classes, $classDatum['name']);
           }
       }

       foreach($classes as $className) {
           $className = [$className];
           fputcsv($f, $className);
       }
       //fputcsv($f, $classes);
       header('Content-Disposition: attachment;filename=classes.csv;');
       header('Content-Type: application/csv');

   }

   function parseForms($connection) {
       $form = $_POST;
       $form = array_keys($form);

       switch($form[0]) {
           case 'downloadClassData':
               downloadCourses($connection);
               break;

           case 'downloadExampleCSV':
               generateCSV();
               break;

           case 'importClassData':
               importCSV();
               break;

           default:
               echo "Failed to parse";
               break;
       }
   }

   parseForms($conn);
?>