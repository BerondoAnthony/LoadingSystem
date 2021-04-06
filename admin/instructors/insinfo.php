<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['nameform']) || isset($_POST['addressform']) || isset($_POST['ageform']) || isset($_POST['emailform'])){

        $check=0;

        $name = $_POST['nameform'];
        $address = $_POST['addressform'];
        $age = $_POST['ageform'];
        $major = $_POST['majorform'];
        $email = $_POST['emailform'];
        $num = $_POST['noform'];

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        $query = "SELECT * FROM users";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          if(strpos($fullurl,$res['user_id']) == true){
            $currentID = $res['user_id'];
            break;
          }
        }
        $query3 = "UPDATE instructor_info SET ins_name='$name', ins_address='$address', ins_age='$age', ins_major='$major', ins_email='$email', ins_no='$num' where user_id='$currentID'";
        $results = mysqli_query($dbc,$query3);
        header("Location:./instructorpage.php?user_id=$currentID?successedit");
        
    }

?>