<?php

    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $query2 = "SELECT * FROM users";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['username']) == true && $res2['user_type'] == 'Instructor'){
            $currentID = $res2['user_id'];
        }
    }
    $results3 = mysqli_query($dbc, "INSERT INTO instructor_info(ins_name,ins_address,ins_age,ins_major,ins_email,ins_no,user_id) VALUES('', '', '', '', '', '', '$currentID')");
    header("Location:./userpage.php");
?>