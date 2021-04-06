<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['roomname'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
        $query = "SELECT * FROM rooms";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['room_id']) == true){
                $curID = $res['room_id'];
            }
        }

        $roomname = $_POST['roomname'];
        $roomloc = $_POST['roomloc'];;

        $query2 = "SELECT * FROM rooms";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($curID != $res2['room_id']){
                if($roomname == $res2['room_name'] && $roomloc == $res2['room_building']){
                    $check = 1;
                    header("Location:./rooms.php?error");
                    break;
                }
            }
            
        }

        if($check==0){
            $query3 = "UPDATE rooms SET room_name='$roomname', room_building='$roomloc' where room_id='$curID'";
            $results = mysqli_query($dbc,$query3);
            header("Location:./rooms.php?");
            echo $curID;
        }


    }

?>