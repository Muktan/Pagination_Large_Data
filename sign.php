<?php
    session_start();
    if (isset($_SESSION['logged']) && $_SESSION['logged']=="true") {
        header("Location: http://localhost/Mypagi/index.php");
    }
    include 'conn.php';
    $u= $_POST['email'];
    $p= $_POST['pass'];
    $res=$con->query("select * from user1");
    $res1 = $con->query("select count(*) as cou from user1");
    $rows=$res->fetchAll();
    $rows1=$res1->fetchAll();
    $cou=$rows1[0]['cou'];
    for ($i=0; $i < $cou; $i++) { 
        if ($u == $rows[$i]['uname'] && $p==$rows[$i]['upass']  ) {
            $_SESSION['logged'] = "true";
            $_SESSION['name'] = $u;
            header("Location: http://localhost/Mypagi/index.php");
            break;
        }
    }

    if (!isset($_SESSION['logged'])){
        header("Location: http://localhost/Mypagi/log.html");
    }
    
    // $_SESSION['logged']="false";
    // header("Location: http://localhost/Mypagi/log.html");

?>
