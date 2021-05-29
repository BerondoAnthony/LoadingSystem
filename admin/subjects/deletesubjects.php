<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
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
        $_SESSION['modal'] = "successdelete";
        header("Location:../curriculum/firstyear.php?curriculum_id=$gobackID?year1");
    }

    if(strpos($fullurl,'year2')){
        $_SESSION['modal'] = "successdelete";
        header("Location:../curriculum/secondyear.php?curriculum_id=$gobackID?year2");
    }

    if(strpos($fullurl,'year3')){
        $_SESSION['modal'] = "successdelete";
        header("Location:../curriculum/thirdyear.php?curriculum_id=$gobackID?year3");

    }

    if(strpos($fullurl,'year4')){
        $_SESSION['modal'] = "successdelete";
        header("Location:../curriculum/fourthyear.php?curriculum_id=$gobackID?year4");

    }
}
?>