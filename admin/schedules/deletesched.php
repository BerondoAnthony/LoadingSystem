<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM schedules";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['sched_id']) == true){
            $curID = $res2['sched_id'];
            $classid = $res2['class_id'];
        }
    }

    $results1 = mysqli_query($dbc, "DELETE FROM ins_scheds where main_sched = $curID");
    $results5 = mysqli_query($dbc, "DELETE FROM room_scheds where main_sched = $curID");
    $results4 = mysqli_query($dbc, "DELETE FROM scheds where schedid = $curID");
    $results3 = mysqli_query($dbc, "DELETE FROM schedules where sched_id = $curID");
    $_SESSION['modal'] = "successdelete";
    header("Location:../classes/classschedule.php?class_id=$classid");
      
}
?>