<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM ins_sub";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['ins_sub_id']) == true){
            $curID = $res2['ins_sub_id'];
            $currentID = $res2['ins_id'];
        }
    }

    $results3 = mysqli_query($dbc, "DELETE FROM ins_sub where ins_sub_id = $curID");
    $_SESSION['modal'] = "successdelete";
    header("Location:./instructorpage.php?ins_id=$currentID");
}
?>