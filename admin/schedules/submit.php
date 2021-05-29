<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){

    include_once("../../connection/connection.php");
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
        $query = "SELECT * FROM schedules";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['sched_id']) == true){
                $curID = $res['sched_id'];
            }
        }

        $query3 = "UPDATE schedules SET stats='Submit' where sched_id='$curID'";
        $results = mysqli_query($dbc,$query3);
        $_SESSION['modal'] = "successedit";
        header("Location:./schedulelist.php?sched_id=$curID");
        echo $curID;


    }
?>