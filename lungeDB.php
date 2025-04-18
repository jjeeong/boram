<?php

    session_start();

    if (isset($_SESSION["userid"])) 
        $userid = $_SESSION["userid"];
    else {
        $userid = "";
    }

    $con = mysqli_connect("localhost", "user", "1234", "boram");

    date_default_timezone_set('Asia/Seoul');

    $count = $_GET["count"];
    $start_date = $_GET["start_time"];
    $end_date = date("Y-m-d(H:i)");
    $start_time = $_GET["start_time"];
    $end_time = date("Y-m-d H:i:s");

    $sql = "INSERT INTO health (count, id, start_date, end_date, type, start_time, end_time) VALUES ('$count','$userid','$start_date','$end_date', 2, '$start_time', '$end_time')";

    mysqli_query($con, $sql);
    mysqli_close($con);

?>