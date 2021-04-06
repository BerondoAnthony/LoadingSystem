<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['username'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
        $query = "SELECT * FROM users";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['user_id']) == true){
                $curID = $res['user_id'];
            }
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['role'];
        $status = $_POST['status'];

        $query2 = "SELECT * FROM users";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($username == $res2['username'] && $curID != $res2['user_id']){
                header("Location:./userpage.php?erroronly");
                $check = 1;
                break;
            }
        }

        if($check==0 && $usertype =='Director'){
            $query3 = "UPDATE users SET username='$username', password='$password', user_type='$usertype', user_status='$status' where user_id='$curID'";
            $results = mysqli_query($dbc,$query3);
            header("Location:./userpage.php?successedit");
        }
        if($check==0 && $usertype =='Instructor'){
            $query3 = "UPDATE users SET username='$username', password='$password', user_type='$usertype', user_status='$status' where user_id='$curID'";
            $results = mysqli_query($dbc,$query3);
            header("Location:./addinstructor.php?username=$username?successedit");
        }

        if($usertype=='Admin'){
            header("Location:./userpage.php?erroredit");
        }


    }

?>