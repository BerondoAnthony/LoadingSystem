<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $check = 0;

    $ln = $_POST['lname'];
    $fn = $_POST['fname'];
    $un = 'user';
    $pw = 'pass';
    $status = $_POST['istatus'];
    $major = '';
    $email = $_POST['email'];


    
    $string1 = "qwertyuiop098ASDFGHJKL";
    $string2 = "asdfghjkl765ZXCVBNM";
    $string3 = "zxcvbnm4321QWERTYUIOP";
    $random1 = substr(str_shuffle($string1),0,3);
    $random2 = substr(str_shuffle($string2),0,3);
    $random3 = substr(str_shuffle($string3),0,3);


    $un = $un.$random1.$random2.$random3;

    $query2 = "SELECT * FROM instructors";
    $results2 = mysqli_query($dbc, $query2);
    while($res2 = mysqli_fetch_array($results2)){
        if($res2['first_name'] == $fn && $res2['last_name']){
            $_SESSION['modal'] = "erroronly";
            header("Location:./instructorlist.php");
            $check = 1;
            break;
        }
    }
    $sub = "ICS Faculty Loading System";
    $msg = "These are your credentials. Username: $un Password: $pw.";

    
    if($check == 0){
        $results3 = mysqli_query($dbc, "INSERT INTO instructors(last_name,first_name,username,password,ins_status,major,email,full_name) VALUES('$ln', '$fn', '$un', '$pw$random2$random3$random1', '$status', '$major', '$email', '$ln $fn')");    
        mail($email,$sub,$msg);
        $_SESSION['modal'] = "successadd";
        header("Location:./instructorlist.php");
    }
}
?>