<?php
include 'conn.php';

if (isset($_POST['rec_no'])) {
    try{
        $sql = "update temp4 SET winery='".$_POST['winery']."' WHERE rec_no='".$_POST['rec_no']."'";
        $con->exec($sql);
        echo 'yes...!!!';
        header("Location: http://localhost/Mypagi/index.php");

        // 
        // , " . $_POST['country'] . ", " . $_POST['description'] . "," . $_POST['designation'] . "," . $_POST['points'] . "," . $_POST['price'] . "," . $_POST['province'] . "," . $_POST['region_1'] . "," . $_POST['region_2'] . "," . $_POST['variety'] . "," . $_POST['winery'] . "
    }
    catch(PDOException $e){
        echo 'no'.$e->getMessage();

    }
    
}
else{
    echo '
<form action="update.php" method="post">
rec_no:<input type="text" name="rec_no" ><br>
winery:<input type="text" name="winery"><br>
<input type="submit" name="submit">
<a href="index.php">home</a>
</form>
';

}
