<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM classes";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['class_id']) == true){
            $curID = $res2['class_id'];
        }
    }

    $query2 = "SELECT * FROM schedules";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if($res2['class_id'] == $curID){
            $cursched = $res2['sched_id'];
            $results5 = mysqli_query($dbc, "DELETE FROM scheds where schedid = $cursched");
        }
    }

    $results4 = mysqli_query($dbc, "DELETE FROM schedules where class_id = $curID");
    $results3 = mysqli_query($dbc, "DELETE FROM classes where class_id = $curID");
    $_SESSION['modal'] = "successdelete";
    header("Location:./classes.php");
}
?>