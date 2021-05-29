<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['year'])){

        $nostud = $_POST['noStud'];
        $year = $_POST['year'];
        $section = $_POST['section'];
        $adviser = $_POST['adviser'];
        $course = $_POST['course'];

        $check = 0;

        $query = "SELECT * FROM classes";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if($res['course'] == $course && $res['section'] == $section && $res['year_level'] == $year){
                $check=1;
                $_SESSION['modal'] = "error";
                header("Location:./classes.php?error");
            }
        }
        if($check==0){
            $result = mysqli_query($dbc, "INSERT INTO classes(course, year_level, section, adviser, no_studs) VALUES('$course','$year', '$section', '$adviser', '$nostud')"); 
            $_SESSION['modal'] = "successadd";
            header("Location:./classes.php");
        }
    };
}
?>