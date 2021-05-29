<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['username'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
        $query = "SELECT * FROM users";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['user_id']) == true){
                $curID = $res['user_id'];
                $usertype2 = $res['user_type'];
            }
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['role'];
        $status = $_POST['status'];
        $email =  $_POST['email'];

        $query2 = "SELECT * FROM users";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($username == $res2['username'] && $curID != $res2['user_id']){
                $_SESSION['modal'] = "erroronly";
                header("Location:./userpage.php?");
                $check = 1;
                break;
            }
        }

        if($_SESSION['user_type'] == "Admin" || $_SESSION['user_type'] == "Secretary" && $usertype2!="Admin"){
            $query3 = "UPDATE users SET username='$username', password='$password', user_type='$usertype', user_status='$status', email='$email' where user_id='$curID'";
            $results = mysqli_query($dbc,$query3);
            $_SESSION['modal'] = "successedit";
            header("Location:./userpage.php");
        }
        if($usertype2=='Admin' && $_SESSION['user_type'] == "Secretary"){
            $_SESSION['modal'] = "erroredit";
            header("Location:./userpage.php");
        }


    }

}
?>