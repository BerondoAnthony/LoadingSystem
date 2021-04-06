<?php

    DEFINE('user', 'root');
    DEFINE('pass', 'dbpass');
    DEFINE('host', 'localhost');
    DEFINE('dbname', 'fls');
    
    $dbc = @mysqli_connect(host, user, pass, dbname)
    OR dies('Could not connect to MySQL: ' . mysqli_connect_error());
    
?>