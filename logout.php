<?php 
    include 'conn.php';
    session_start();
    $_SESSION['logged']="false";
    session_destroy();
    header("Location: http://localhost/Mypagi/index.php");
?>