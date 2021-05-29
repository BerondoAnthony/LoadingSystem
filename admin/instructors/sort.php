<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $query = "SELECT * FROM instructors";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          if(strpos($fullurl,$res['ins_id']) == true){
            $currentID = $res['ins_id'];
            break;
          }
        }
    

    $check=0;

    $sem = $_POST['sems'];
    $year = $_POST['schoolyear'];

    $_SESSION['sortyear'] = $year;
    $_SESSION['sortsem'] = $sem;
        
    header("Location:./instructorpage.php?user_id=$currentID");
    
  }
?>