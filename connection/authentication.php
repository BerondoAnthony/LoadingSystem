<?php
    include_once("./connection.php");

    session_start();

    if(isset($_POST['usernameform']) && isset($_POST['passwordform'])){

        $username = $_POST['usernameform'];
        $password = $_POST['passwordform'];
        $user_status = "Active";
        $_SESSION['loginerror'] = 0;
        
        $newu = "";
        $newp = "";
            
        $query = "SELECT * from users";
        $result = mysqli_query($dbc,$query);
        while($res = mysqli_fetch_array($result)){
            $newu = $res['username'];
            $newp = $res['password'];
            if($username == $res['username'] && $password == $res['password'] && $user_status == $res['user_status']){
                $userID = $res['user_id'];
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['user_type'] = $res['user_type'];
                $_SESSION['modal'] = "None";
                if($res['user_type'] == 'Admin'){
                    header("Location:../admin/courses/courses.php");
                    break;
                }
                if($res['user_type'] == 'Director'){
                    header("Location:../director/classes/classes.php");
                    break;
                } 
                if($res['user_type'] == 'Secretary'){
                    header("Location:../admin/courses/courses.php?");
                    break;
                }
            }
        }

        if($username != $newu || $password != $newp){
            $query = "SELECT * from instructors";
            $result = mysqli_query($dbc,$query);
            while($res = mysqli_fetch_array($result)){
                $newu = $res['username'];
                $newp = $res['password'];

                if($username == $res['username'] && $password == $res['password'] && $user_status == $res['ins_status']){
                    $userID = $res['ins_id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['ins_id'] = $userID;
                    $_SESSION['user_type'] = "Instructor";
                    $_SESSION['modal'] = "None";
                    header("Location:../instructor/instructors/instructorpage.php?ins_id=$userID");
                    break;
                    
                }
            }
        }
        
        if($username != $newu && $password != $newp){
            $_SESSION['loginerror'] = 1;
            header("Location:../index.php");
        }
    };
?>
