<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");
    $check = 0;

    $qual = $_POST['qualifications'];
    $currentID = $_SESSION['ins_id'];

    $query = "SELECT * FROM qualifications";
    $results = mysqli_query($dbc, $query);
    while($res = mysqli_fetch_array($results)){
        if($res['insid'] == $currentID){
            $check = 1;
            break; 
        }
    }
    if($check == 0){
        $result = mysqli_query($dbc, "INSERT INTO qualifications(qualinfo, insid) VALUES('$qual', '$currentID')");
        $_SESSION['modal'] = "successedit";
        header("Location:./instructorpage.php?ins_id=$currentID");
    }

    if($check == 1){
        $query3 = "UPDATE qualifications SET qualinfo='$qual' where insid='$currentID'";
        $results = mysqli_query($dbc,$query3); 
        $_SESSION['modal'] = "successedit";
        header("Location:./instructorpage.php?ins_id=$currentID");
    }
}

?>