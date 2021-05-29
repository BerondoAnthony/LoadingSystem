<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['inssubject'])){

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $query = "SELECT * FROM instructors";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['ins_id']) == true){
                $currentID = $res['ins_id'];
                $fn = $res['full_name'];
            }
        }

        $subject = $_POST['inssubject'];

        $check = 0;

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

        echo $subject;
        echo $check;

        if($check==0){
            $result = mysqli_query($dbc, "INSERT INTO ins_pref(subject_preffered, ins_id) VALUES('$subject', '$currentID')"); 
            $_SESSION['modal'] = "successadd";
            header("Location:./instructorpage.php?ins_id=$currentID");
        }
    };
}
?>