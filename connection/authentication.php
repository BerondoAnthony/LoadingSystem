<?php
    include_once("./connection.php");
    if(isset($_POST['usernameform']) && isset($_POST['passwordform'])){

        $username = $_POST['usernameform'];
        $password = $_POST['passwordform'];
        $user_status = "Active";
            
        $query = "SELECT * from users";
        $result = mysqli_query($dbc,$query);
        while($res = mysqli_fetch_array($result)){

            if($username == $res['username'] && $password == $res['password'] && $user_status == $res['user_status']){
                $userID = $res['user_id'];
                if($res['user_type'] == 'Admin'){
                    header("Location:../admin/courses/courses.php?user_id=$userID");
                    break;
                }
                if($res['user_type'] == 'Instructor'){
                    header("Location:");
                    break;
                }
                if($res['user_type'] == 'Director'){
                    header("Location:");
                    break;
                } 
            }
        }
        
        if($username != $res['username'] && $password != $res['password']){
            header("Location:../index.html?signup=error");
        }
    };
?>
