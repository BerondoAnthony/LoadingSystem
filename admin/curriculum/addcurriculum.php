<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['curriculumName'])){

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $curriculumName = $_POST['curriculumName'];
        $check = 0;
        $holder = 0;

        $query2 = "SELECT * FROM course";
        $query = "SELECT * FROM curriculum";
        $results = mysqli_query($dbc, $query);
        $results2 = mysqli_query($dbc, $query2);

        while($res2 = mysqli_fetch_array($results2)){
            if(strpos($fullurl,$res2['course_id']) == true){
                $holder = $res2['course_id'];
            }
        }

        while($res = mysqli_fetch_array($results)){
            if($res['curriculum_name'] == $curriculumName && $res['course_id'] == $holder){
                $check=1;
                header("Location:../courses/course.list.php?course_id=$holder?error");
            }
        }
        if($check==0){
            $result = mysqli_query($dbc, "INSERT INTO curriculum(curriculum_name, course_id) VALUES('$curriculumName','$holder')"); 
            header("Location:../courses/course.list.php?course_id=$holder?successadd");
        }
    };

?>