<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['role'])){

        $check=0;

        $usertype = $_POST['role'];
        $status = $_POST['status'];
        $username = 'user';
        $password = 'pass';
        $email = '[email]';


        $string1 = "qwertyuiop098ASDFGHJKL";
        $string2 = "asdfghjkl765ZXCVBNM";
        $string3 = "zxcvbnm4321QWERTYUIOP";
        $random1 = substr(str_shuffle($string1),0,3);
        $random2 = substr(str_shuffle($string2),0,3);
        $random3 = substr(str_shuffle($string3),0,3);

        $username = $username.$random3.$random1.$random2;

        $query2 = "SELECT * FROM users";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($username == $res2['username']){
                $_SESSION['modal'] = "erroronly";
                header("Location:./userpage.php");
                $check = 1;
                break;
            }
        }

        $sub = "ICS Faculty Loading System";
        $msg = "These are your credentials. Username: $un Password: $pw.";
        
        if($check==0){
            $results3 = mysqli_query($dbc, "INSERT INTO users(username, password, user_type, user_status, email) VALUES('$username', '$password$random1$random2$random3', '$usertype', '$status', $email)");
            $_SESSION['modal'] = "successadd";
            header("Location:./userpage.php?successadd");
        }
    }
}
?>