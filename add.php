<?php
include 'conn.php';

if (isset($_POST['rec_no'])) {
    try{
        $sql = "insert INTO temp4 (rec_no, country, description,designation,points,price,province,region_1,region_2,variety,winery)
    VALUES ('" . $_POST['rec_no'] . "', '" . $_POST['country'] . "', '" . $_POST['description'] . "', '" . $_POST['designation'] . "', '" . $_POST['points'] . "', '" . $_POST['price'] . "', '" . $_POST['province'] . "', '" . $_POST['region_1'] . "', '" . $_POST['region_2'] . "', '" . $_POST['variety'] . "', '" . $_POST['winery'] . "')";
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
<form action="add.php" method="post">
rec_no:<input type="text" name="rec_no" ><br>
country:<input type="text" name="country"><br>
description:<input type="text" name="description"><br>
designation:<input type="text" name="designation"><br>
points:<input type="text" name="points"><br>
price:<input type="text" name="price"><br>
province:<input type="text" name="province"><br>
region_1:<input type="text" name="region_1"><br>
region_2:<input type="text" name="region_2"><br>
variety:<input type="text" name="variety"><br>
winery:<input type="text" name="winery"><br>
<input type="submit" name="submit">
<a href="index.php">home</a>
</form>
';

}



?>
