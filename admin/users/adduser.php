<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['username'])){

        $check=0;

        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['role'];
        $status = $_POST['status'];

        $query2 = "SELECT * FROM users";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($username == $res2['username']){
                header("Location:./userpage.php?erroronly");
                $check = 1;
                break;
            }
        }
        if($check==0){
            $results3 = mysqli_query($dbc, "INSERT INTO users(username, password, user_type, user_status) VALUES('$username', '$password', '$usertype', '$status')");
            header("Location:./addinstructor.php?username=$username");
        }
    }

?>