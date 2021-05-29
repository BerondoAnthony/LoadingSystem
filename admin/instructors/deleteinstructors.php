<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
    $query2 = "SELECT * FROM instructors";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if(strpos($fullurl,$res2['ins_id']) == true){
            $curID = $res2['ins_id'];
        }
    }

    $query3 = "UPDATE ins_scheds SET insid='', mon='', tue='', wed='', thu='', fri='', sat='', sun='' where insid = '$curID'";
    $results5 = mysqli_query($dbc,$query3);
    $query4 = "UPDATE scheds SET insid='', ins_ass='', mon='', tue='', wed='', thu='', fri='', sat='', sun='' where insid = '$curID'";
    $results6 = mysqli_query($dbc,$query4);
    $results4 = mysqli_query($dbc, "DELETE FROM ins_sub where ins_id = $curID");
    $results3 = mysqli_query($dbc, "DELETE FROM instructors where ins_id = $curID");
    $_SESSION['modal'] = "successdelete";
    header("Location:./instructorlist.php");
}
?>