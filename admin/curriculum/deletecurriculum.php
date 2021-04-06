<?php

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM curriculum";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['curriculum_id']) == true){
            $curID = $res2['curriculum_id'];
            $courseID = $res2['course_id'];
            break;
        }
    }

    echo $curID;
    echo $courseID;

    $results = mysqli_query($dbc, "DELETE FROM subjects WHERE curriculum_id = $curID");
    $results3 = mysqli_query($dbc, "DELETE FROM curriculum WHERE curriculum_id = $curID");

    header("Location:../courses/course.list.php?course_id=$courseID?successdelete");
      

?>