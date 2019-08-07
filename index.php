<!DOCTYPE html>
<html lang="en">
<?php


include 'conn.php';
session_start();
$iss = isset($_SESSION['logged']) ? $_SESSION['logged'] : "false";
$limit = 1000;
$start = (isset($_GET["page"]) && $_GET["page"] > 0) ? $_GET["page"] : 0;
// $result1 = $con->query("SELECT count(rec_no) AS rec_no FROM temp4");
// $rowCount = $result1->fetchAll();
// $total = $rowCount[0]['rec_no'];

$class_size = 100;
$classes_per_page = $limit / $class_size;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Beth+Ellen&display=swap" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        h1 {
            font-family: 'Beth Ellen', cursive;
        }

        body {

            background-image: url("bg.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .container {
            background: rgba(255, 200, 250, 0.5);
        }
    </style>
</head>

<body>



    <div class="container">

        <div class="row">
            <h1 class="col-sm-12" style="text-align:center;margin-top:30px;">Winery Data</h1>
            <nav class="col-sm-5" style="margin-top:10px;" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start - 10) ?>">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#"><?= (($start / 10) + 0) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 10) ?>"><?= (($start / 10) + 1) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 20) ?>"><?= (($start / 10) + 2) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 30) ?>"><?= (($start / 10) + 3) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 10) ?>">Next</a></li>
                </ul>
            </nav>
            <form class="form-inline my-2 col-sm-5 my-lg-0 row" action="http://localhost/Mypagi/index.php" onsubmit="re()" method="GET">
                <input class="col-sm-7 form-control mr-sm-2" id="pno" type="number" min="1" max="150" name="page" placeholder="Search" aria-label="Search">
                <button class="col-sm-4 btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form>

            <?php

            if (isset($_SESSION['logged']) && $_SESSION['logged'] == "true") {
                // echo isset($_SESSION['logged']);
                // echo $_SESSION['logged'];
                echo "<script>
                    console.log(" . $iss . ");
                </script>";
                echo '<button class="col-sm-2 btn btn-outline-success " onclick="send1()" style="margin-top:10px;height:40px" type="submit"><b>LOGOUT</b></button>';
            } else {
                echo "<script>
                    console.log(" . $iss . ");
                </script>";

                echo '<button class="col-sm-2 btn btn-outline-success " onclick="send()" style="margin-top:10px;height:40px" type="submit"><b>LOGGER</b></button>';
            }
            ?>



            <script>
                function re() {
                    document.getElementById("pno").value = (document.getElementById("pno").value * 10);
                }

                function send() {
                    window.location = "log.html";
                }

                function send1() {
                    window.location = "logout.php";
                }
            </script>
        </div>

        <?php
        for ($i = $start; $i < ($start + $classes_per_page); $i++) {
            echo '
                    <a class = "btn btn-primary _' . ($i * 100) . '" style="color:black;width:100%; border: 3px dotted;" href="index.php?page=' . $start . '&offset=' . (($i * 100) + 1) . '"> ' . (($i * 100) + 1) . '-' . (($i + 1) * 100) . '
                    </a>
                    <div id="_' . ($i * 100) . '" style="display:none;"></div>    
                ';
        }

        ?>
        <?php
        if (!isset($_GET["offset"]) || $_GET["offset"] == 0) {
            echo '
                <script>
                    document.getElementById("_' . ($start * 100) . '").style.display = "block";
                    document.getElementById("_' . ($start * 100) . '").innerHTML="';

            $query = "select * from temp4 limit " . (($start * 100) + 1) . "," . $class_size;

            $res = $con->query($query);
            $rows = $res->fetchAll();
            echo '<div class=\'row\' style=\'margin-left:10px;margin-right:10px\'>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Rec_no' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Country' . '</div>';
            echo '<div class=\'col-sm-2\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Description' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Designation' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Points' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Price' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Province' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Region_1' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Region_2' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Variety' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Winery' . '</div>';


            echo '</div>';
            echo '<div class=\'row\' style=\'margin-left:10px;margin-right:10px\'>';
            for ($i = 0; $i < 100; $i++) {

                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['rec_no'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['country'] . '</div>';
                echo '<div class=\'col-sm-2\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['description'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['designation'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['points'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['price'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['province'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['region_1'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['region_2'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['variety'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['winery'] . '</div>';
            }


            echo '        </div>";
                        </script>
                    ';
        } else {
            echo '
                <script>
                    document.getElementById("_' . ($_GET["offset"] - 1) . '").style.display = "block";
                    document.getElementById("_' . ($_GET["offset"] - 1) . '").innerHTML="';

            $query = "select * from temp4 limit " . ($_GET["offset"]) . "," . $class_size;

            $res = $con->query($query);
            $rows = $res->fetchAll();
            echo '<div class=\'row\' style=\'margin-left:10px;margin-right:10px\'>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Rec_no' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Country' . '</div>';
            echo '<div class=\'col-sm-2\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Description' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Designation' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Points' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Price' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Province' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Region_1' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Region_2' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Variety' . '</div>';
            echo '<div class=\'col-sm-1\' style=\'font-weight:bold;border:1px solid;height:27px;overflow:hidden;\'>' . 'Winery' . '</div>';


            echo '</div>';
            echo '<div class=\'row\' style=\'margin-left:10px;margin-right:10px\'>';
            for ($i = 0; $i < 100; $i++) {

                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['rec_no'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['country'] . '</div>';
                echo '<div class=\'col-sm-2\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['description'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['designation'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['points'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['price'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['province'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['region_1'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['region_2'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['variety'] . '</div>';
                echo '<div class=\'col-sm-1\' style=\'border:1px solid;height:27px;overflow:hidden;\'>' . $rows[$i]['winery'] . '</div>';
            }


            echo '        </div>";
                            </script>
                        ';
        }
        ?>
        <div class="row">

            <nav class="col-sm-4" style="margin-top:10px;" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start - 10) ?>">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#"><?= (($start / 10) + 0) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 10) ?>"><?= (($start / 10) + 1) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 20) ?>"><?= (($start / 10) + 2) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 30) ?>"><?= (($start / 10) + 3) ?></a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/Mypagi/index.php?page=<?= ($start + 10) ?>">Next</a></li>
                </ul>
            </nav>
            <form class="form-inline my-2 col-sm-5 my-lg-0 row" action="http://localhost/Mypagi/index.php" onsubmit="re()" method="GET">
                <input class="col-sm-7 form-control mr-sm-2" id="pno" type="number" min="1" max="150" name="page" placeholder="Search" aria-label="Search">
                <button class="col-sm-4 btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form>
            <?php
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == "true") {
                echo '<button class="col-sm-1 btn btn-outline-success " onclick="tryi()" style="margin-top:10px;height:40px" type="submit"><b>ADD</b></button>';
                    echo '<button class="col-sm-1 btn btn-outline-success " onclick="try1()" style="margin-top:10px;height:40px" type="submit"><b>UPDATE</b></button>';
            } ?>

            <script>
                function
                tryi () {
                    window.location="add.php";
                }

                function
                try1 () {
                    window.location="update.php";
                }

                function re() {
                    document.getElementById("pno").value = (document.getElementById("pno").value * 10);
                }
            </script>
        </div>
    </div>


</body>

</html>