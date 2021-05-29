<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");
    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(isset($_POST['fname'])){

        $check=0;

        $ln = $_POST['lname'];
        $fn = $_POST['fname'];
        $un = $_POST['uname'];
        $email = $_POST['email'];
        $status = $_POST['istatus'];
        
        
        $query = "SELECT * FROM instructors";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          if(strpos($fullurl,$res['ins_id']) == true){
            $currentID = $res['ins_id'];
            break;
          }
        }

        $query = "SELECT * FROM instructors";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          if($res['last_name'] == $ln && $res['first_name'] == $fn && $currentID != $res['ins_id']){
            $_SESSION['modal'] = "erroronly";
            header("Location:./instructorlist.php");
            $check = 1;
            break;
          }
        }

        if($check==0){
            $query3 = "UPDATE instructors SET last_name='$ln', first_name='$fn', email='$email', ins_status='$status', full_name='$ln $fn' where ins_id = '$currentID'";
            $query4 = "UPDATE scheds SET ins_ass='$ln $fn' where insid = '$currentID'";
            $results = mysqli_query($dbc,$query3);
            $results = mysqli_query($dbc,$query4);
            $_SESSION['modal'] = "successedit";
            header("Location:./instructorlist.php");
        }
    }
  }
?>