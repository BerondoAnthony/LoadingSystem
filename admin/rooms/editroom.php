<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
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
        $roomloc = $_POST['roomloc'];
        $roomcap = $_POST['roomcapacity'];

        $query2 = "SELECT * FROM rooms";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($curID != $res2['room_id']){
                if($roomname == $res2['room_name'] && $roomloc == $res2['room_building']){
                    $check = 1;
                    $_SESSION['modal'] = "error";
                    header("Location:./rooms.php");
                    break;
                }
            }
            
        }

        if($check==0){
            $query3 = "UPDATE rooms SET room_name='$roomname', room_building='$roomloc', capacity='$roomcap', room_full='$roomname $roomloc' where room_id='$curID'";
            $query4 = "UPDATE scheds SET room_ass='$roomname $roomloc' where roomid='$curID'";
            $results = mysqli_query($dbc,$query3);
            $results = mysqli_query($dbc,$query4);
            $_SESSION['modal'] = "successedit";
            header("Location:./rooms.php");
            echo $curID;
        }


    }
}
?>