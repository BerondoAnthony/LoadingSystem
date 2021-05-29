<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

        $check=0;

        $ln = $_POST['lnform'];
        $fn = $_POST['fnform'];
        $un = $_POST['unform'];
        $pass = $_POST['passform'];
        $major = $_POST['majorform'];
        $email = $_POST['emailform'];
        

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        $query = "SELECT * FROM instructors";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          if(strpos($fullurl,$res['ins_id']) == true){
            $currentID = $res['ins_id'];
            break;
          }
        }
        $query3 = "UPDATE instructors SET last_name='$ln', first_name='$fn', username='$un', password='$pass', major='$major', email='$email', full_name='$ln $fn' where ins_id='$currentID'";
        $results = mysqli_query($dbc,$query3);
        $_SESSION['modal'] = "successedit";
        header("Location:./instructorpage.php?user_id=$currentID");
        
    
}
?>