<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM users";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['user_id']) == true){
            $curID = $res2['user_id'];
            $type = $res2['user_type'];
        }
    }
    if($type != 'Admin'){
        $results3 = mysqli_query($dbc, "DELETE FROM users where user_id = $curID");
        $_SESSION['modal'] = "successdelete";
        header("Location:./userpage.php");
    }
    else{
        $_SESSION['modal'] = "errordelete";
        header("Location:./userpage.php");
    }

}
?>