<?php
    session_start();

    session_destroy();
    echo "Session Destroyed";
    echo  $_SESSION['username'];
    echo  $_SESSION['password'];
    echo  $_SESSION['user_type'];
    header("Location:../index.html");
?>