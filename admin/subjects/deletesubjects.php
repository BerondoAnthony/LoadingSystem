<?php

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM subjects";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['subject_id']) == true){
            $currentID = $res2['subject_id'];
            $gobackID = $res2['curriculum_id'];
        }
    }

    $results2 = mysqli_query($dbc, "DELETE FROM subjects WHERE subject_id = $currentID");
    
    if(strpos($fullurl,'year1')){
        header("Location:../curriculum/firstyear.php?curriculum_id=$gobackID?year1?successdelete");
    }

    if(strpos($fullurl,'year2')){
        header("Location:../curriculum/secondyear.php?curriculum_id=$gobackID?year2?successdelete");
    }

    if(strpos($fullurl,'year3')){
        header("Location:../curriculum/thirdyear.php?curriculum_id=$gobackID?year3?successdelete");

    }

    if(strpos($fullurl,'year4')){
        header("Location:../curriculum/fourthyear.php?curriculum_id=$gobackID?year4?successdelete");

    }
?>