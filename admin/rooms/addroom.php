<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['roomname'])){

        $check=0;

        $roomname = $_POST['roomname'];
        $roomloc = $_POST['roomloc'];

        $query2 = "SELECT * FROM rooms";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($roomname == $res2['room_name'] && $roomloc == $res2['room_building']){
                $check = 1;
                header("Location:./rooms.php?error");
                break;
            }
        }
        if($check==0){
            $results3 = mysqli_query($dbc, "INSERT INTO rooms(room_name, room_building) VALUES('$roomname', '$roomloc')");
            header("Location:./rooms.php");
            
        }

    }

?>