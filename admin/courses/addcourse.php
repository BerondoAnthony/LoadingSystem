<?php
 session_start();

 if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['courseName'])){

        $coursename = $_POST['courseName'];
        $coursedesc = $_POST['courseDesc'];
        $check = 0;

        $query = "SELECT * FROM course";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if($res['course_name'] == $coursename){
                $check=1;
                $_SESSION['modal'] = "error";
                header("Location:./courses.php");
            }
        }
        if($check==0){
            $result = mysqli_query($dbc, "INSERT INTO course(course_name, description) VALUES('$coursename','$coursedesc')"); 
            $_SESSION['modal'] = "successadd";
            header("Location:./courses.php");
        }
    };
 }
?>