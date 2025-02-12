<?php
    $userid = 'rpmanoha';
    $database = 'rpmanoha';
    $password = '9QvlbelQ';   
    $host = 'webdev.scs.ryerson.ca';
    $connect = mysqli_connect("localhost", $userid, $password, $database) or die(mysqli_error());
    echo "<div>Connected to MySQL Database <b>$database</b></div>";
?>