<?php

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM course";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['course_id']) == true){
            $courseID = $res2['course_id'];
        }
    }

    $query = "SELECT * FROM curriculum where course_id = $courseID";
    $results = mysqli_query($dbc, $query);
    while($res = mysqli_fetch_array($results)){
        $curID = $res['curriculum_id'];
        $results3 = mysqli_query($dbc, "DELETE FROM subjects WHERE curriculum_id = $curID");
        
    }

    $results3 = mysqli_query($dbc, "DELETE FROM subjects WHERE curriculum_id = $curID");
    $results4 = mysqli_query($dbc, "DELETE FROM curriculum WHERE course_id = $courseID");
    $results5 = mysqli_query($dbc, "DELETE FROM course WHERE course_id = $courseID");
    header("Location:./courses.php?successdelete");
      

?>