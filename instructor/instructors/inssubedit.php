<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['inssubject'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $subject = $_POST['inssubject'];

        
        $query = "SELECT * FROM ins_pref";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          if(strpos($fullurl,$res['ins_pref_id']) == true){
            $curID = $res['ins_pref_id'];
            $currentID = $res['ins_id'];
            break;
          }
        }

        $query = "SELECT * FROM ins_pref";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if($res['subject_preffered'] == $subject && $res['ins_id'] == $currentID){
                $check=1;
                $_SESSION['modal'] = "error";
                header("Location:./instructorpage.php?ins_id=$currentID");
                break;
            }
        }

        if($check==0){
            $query3 = "UPDATE ins_pref SET subject_preffered='$subject' where ins_pref_id='$curID'";
            $results = mysqli_query($dbc,$query3);
            $_SESSION['modal'] = "successedit";
            header("Location:./instructorpage.php?ins_id=$currentID");
        }


    }
}
?>