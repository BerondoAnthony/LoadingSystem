<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['roomname'])){

        $check=0;

        $roomname = $_POST['roomname'];
        $roomloc = $_POST['roomloc'];
        $roomcap = $_POST['roomcapacity'];

        $query2 = "SELECT * FROM rooms";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($roomname == $res2['room_name'] && $roomloc == $res2['room_building']){
                $check = 1;
                $_SESSION['modal'] = "error";
                header("Location:./rooms.php");
                break;
            }
        }

        if($check==0){
            $results3 = mysqli_query($dbc, "INSERT INTO rooms(room_name, room_building, capacity, room_full) VALUES('$roomname', '$roomloc', $roomcap, '$roomname $roomloc')");
            $_SESSION['modal'] = "successadd";
            header("Location:./rooms.php");
            
        }
        echo $roomcap;
        echo $roomname;
        echo $roomloc;

    }
}
?>