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
        $email = $_POST['email'];


        $string1 = "qwertyuiop098ASDFGHJKL";
        $string2 = "asdfghjkl765ZXCVBNM";
        $string3 = "zxcvbnm4321QWERTYUIOP";
        $random1 = substr(str_shuffle($string1),0,3);
        $random2 = substr(str_shuffle($string2),0,3);
        $random3 = substr(str_shuffle($string3),0,3);

        $username = $username.$random3.$random1.$random2;
        $password = $password.$random1.$random2.$random3;

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
        
        
        $to = $email; 
        $subject = 'ICS Faculty Loading System'; 
        $message = "These are your login credentials for ICS Faculty Loading Sysyem. We advise you to change it. Username: $username Password: $password."; 
        $headers = 'From: techsupport@theloadingsystem.com' . "\r\n" . 
                    'Reply-To: test@test.com' . "\r\n" . 
                    'X-Mailer: PHP/' . phpversion(); 

        mail($to, $subject, $message, $headers);  
             
        if($check==0){
            $results3 = mysqli_query($dbc, "INSERT INTO users(username, password, user_type, user_status, email) VALUES('$username', '$password', '$usertype', '$status', '$email')");
            $_SESSION['modal'] = "successadd";
            header("Location:./userpage.php?successadd");
            
        }
    }
}
?>