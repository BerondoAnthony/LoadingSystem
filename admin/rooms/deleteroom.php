<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM rooms";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['room_id']) == true){
            $curID = $res2['room_id'];
        }
    }

    $query3 = "UPDATE room_scheds SET roomid='', mon='', tue='', wed='', thu='', fri='', sat='', sun='' where roomid = '$curID'";
    $results5 = mysqli_query($dbc,$query3);
    $query4 = "UPDATE scheds SET roomid='', room_ass='', mon='', tue='', wed='', thu='', fri='', sat='', sun='' where roomid = '$curID'";
    $results6 = mysqli_query($dbc,$query4);

    $results3 = mysqli_query($dbc, "DELETE FROM rooms where room_id = $curID");
    $_SESSION['modal'] = "successdelete";
    header("Location:./rooms.php");
      
}
?>