<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['courseName'])){
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $coursename = $_POST['courseName'];
        $coursedesc = $_POST['courseDesc'];
        $check = 0;
        $holder = 0;

        $query = "SELECT * FROM course";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['course_id']) == true){
                $holder = $res['course_id'];
            }
            if($res['course_name'] == $coursename && $res['course_id'] != $holder){
                $check=1;
                $_SESSION['modal'] = "error";
                header("Location:./courses.php");
                
            }
            if($res['course_name'] == $coursename && $res['course_id'] == $holder){
                $check=0;
                break;
            }
               
        }

        if($check==0){
            $result = mysqli_query($dbc, "UPDATE course SET course_name='$coursename', description='$coursedesc' where course_id='$holder'");
            $_SESSION['modal'] = "successedit";
            header("Location:./course.list.php?course_id=$holder");
        }
    };
}
?>