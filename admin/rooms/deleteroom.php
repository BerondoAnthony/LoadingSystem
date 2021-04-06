<?php

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM rooms";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['room_id']) == true){
            $curID = $res2['room_id'];
        }
    }

    $results3 = mysqli_query($dbc, "DELETE FROM rooms where room_id = $curID");
    header("Location:./rooms.php");
      

?>