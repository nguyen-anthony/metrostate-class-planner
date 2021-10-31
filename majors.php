<?php
session_start();
require('database.php');

$conn = createConnection();

$completedClasses = [];
$usersMajor = null;

if ($_SESSION['loggedin']) {
    $sql = 'SELECT * FROM USER_COURSES WHERE USER_ID = ' . $_SESSION['id'];

    foreach ($conn->query($sql) as $row) {
        array_push($completedClasses, $row['COURSE_ID']);
    }

    $majorSql = 'SELECT * FROM USERS WHERE ID = ' . $_SESSION['id'];

    foreach ($conn->query($majorSql) as $row) {
        $usersMajor = $row['MAJOR_ID'];
    }
}

function getMajors($connection, $userMajor)
{
    $sql = 'SELECT * FROM MAJORS';
    $optionsData = '';
    foreach ($connection->query($sql) as $row) {
        $majorName = strtolower(str_replace(' ', '-', $row['NAME']));
        if ($row['ID'] == $userMajor) {
            $optionsData .= '<option id="' . $majorName . '" value="' . $row['ID'] . '" selected>' . $row['NAME'] . '</option>';
        } else {
            $optionsData .= '<option id="' . $majorName . '" value="' . $row['ID'] . '">' . $row['NAME'] . '</option>';
        }
    }
    echo $optionsData;
    $conn = null;
}

function getMajorDataRaw($connection)
{
    $sql = 'SELECT * FROM MAJORS';
    $optionsData = '';
    foreach ($connection->query($sql) as $row) {
        $optionsData .= $row['NAME'] . ', ';
    }
    echo $optionsData;
    $conn = null;
}

function getMajorReqCourses($connection, $compClasses)
{
    $major = $_GET['major_id'];

    $majorCourses = [];
    $output = '';

    $sql = 'SELECT * FROM MAJOR_COURSES WHERE MAJOR_ID = ' . $major;

    foreach ($connection->query($sql) as $row) {
        array_push($majorCourses, $row['COURSE_ID']);
    }

    foreach ($majorCourses as $course) {
        $courseQuery = 'SELECT * FROM COURSES WHERE ID = ' . $course;
        foreach ($connection->query($courseQuery) as $courseRow) {
            if (in_array($courseRow['ID'], $compClasses)) {
                $output = $output . '<tr class="table-data completed row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button class="completeButton button-"' . $courseRow['ID'] . ' type="button" value="' . $courseRow['ID'] . '">X</button></td></tr>';
            } else {
                if ($_SESSION['loggedin']) {
                    $output = $output . '<tr class="table-data row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button class="completeButton button-"' . $courseRow['ID'] . ' type="button" value="' . $courseRow['ID'] . '">X</button></td></tr>';
                } else {
                    $output = $output . '<tr class="table-data row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button type="button" disabled>yes</button></td></tr>';
                }
            }
        }
    }

    echo $output;
}

function getMajorReqStudent($conn, $compClasses)
{
    $student = $_GET['student_id'];
    $studentMajorLookup = 'SELECT * FROM USERS WHERE ID = ' . $student . ' LIMIT 1';
    $result = mysqli_fetch_assoc(mysqli_query($conn, $studentMajorLookup));
    $majorId = $result['MAJOR_ID'];
    $majorName = $result['NAME'];

    $majorCourses = [];
    $output = '';

    $sql = 'SELECT * FROM MAJOR_COURSES WHERE MAJOR_ID = ' . $majorId;

    foreach ($conn->query($sql) as $row) {
        array_push($majorCourses, $row['COURSE_ID']);
    }

    foreach ($majorCourses as $course) {
        $courseQuery = 'SELECT * FROM COURSES WHERE ID = ' . $course;
        foreach ($conn->query($courseQuery) as $courseRow) {
            if (in_array($courseRow['id'], $compClasses)) {
                $output = $output . '<tr class="table-data completed row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button class="completeButton button-"' . $courseRow['ID'] . ' type="button" value="' . $courseRow['ID'] . '">X</button></td></tr>';
            } else {
                if ($_SESSION['loggedin']) {
                    $output = $output . '<tr class="table-data row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button class="completeButton button-"' . $courseRow['ID'] . ' type="button" value="' . $courseRow['ID'] . '">X</button></td></tr>';
                } else {
                    $output = $output . '<tr class="table-data row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button type="button" disabled>yes</button></td></tr>';
                }
            }
        }
    }
    json_encode($majorName);

    echo $output;
}

function getGoalData($conn, $compClasses)
{
    $goal = $_GET['goal_id'];
    $courses = [];
    $output = '';

    $sql = 'SELECT DISTINCT * FROM SECONDARY_REQUIREMENTS_COURSES WHERE SECONDARY_REQUIREMENTS_ID = ' . $goal;

    foreach ($conn->query($sql) as $row) {
        array_push($courses, $row);
    }

    foreach ($courses as $course) {
        $courseQuery = 'SELECT * FROM COURSES WHERE ID = ' . $course['COURSES'];
        foreach ($conn->query($courseQuery) as $courseRow) {
            if (in_array($courseRow['ID'], $compClasses)) {
                $output = $output . '<tr class="table-data completed row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button class="completeButton button-"' . $courseRow['ID'] . ' type="button" value="' . $courseRow['ID'] . '">X</button></td></tr>';
            } else {
                if ($_SESSION['loggedin']) {
                    $output = $output . '<tr class="table-data row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button class="completeButton button-"' . $courseRow['ID'] . ' type="button" value="' . $courseRow['ID'] . '">X</button></td></tr>';
                } else {
                    $output = $output . '<tr class="table-data row-' . $courseRow['ID'] . '"><td>' . $courseRow['NAME'] . '</td><td>' . $courseRow['DESCRIPTION'] . '</td><td>' . $courseRow['CREDITS'] . '</td><td><button type="button" disabled>yes</button></td></tr>';
                }
            }
        }
    }

    echo $output;
}

function markComplete($connection)
{
    $courseId = $_GET['course_id'];
    $status = $_GET['status'];

    if ($status == 'add') {

        $sql = "INSERT INTO USER_COURSES (USER_ID, COURSE_ID) VALUES ('" . $_SESSION['id'] . "', '" . $courseId . "')";

        if (mysqli_query($connection, $sql)) {
            echo 'success';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
    } elseif ($status == 'remove') {
        $sql = "DELETE FROM USER_COURSES WHERE COURSE_ID = " . $courseId . " AND USER_ID = " . $_SESSION['id'];

        if (mysqli_query($connection, $sql)) {
            echo 'success';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}

function sortMajorData($conn, $compClasses, $usersMajor)
{
    $data = $_GET['data'];

    switch ($data) {
        case 'raw':
            getMajorDataRaw($conn);
            break;

        case 'clean':
            getMajors($conn, $usersMajor);
            break;

        case 'major':
            getMajorReqCourses($conn, $compClasses);
            break;

        case 'majorStudent':
            getMajorReqStudent($conn, $compClasses);
            break;

        case 'goals':
            getGoalData($conn, $compClasses);
            break;

        case 'complete':
            markComplete($conn);
            break;
    }
}

sortMajorData($conn, $completedClasses, $usersMajor);
