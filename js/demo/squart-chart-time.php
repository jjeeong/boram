<?php
    $id = $_POST["id"];


    $con = mysqli_connect("localhost", "user", "1234", "boram");
    $sql = $con->prepare("SELECT (count, id, start_date, end_date, type, start_time, end_time) from health where id = ?");
    $sql->bind_param("s", $id);
    $sql->execute();
    $result = $sql->get_result();
       
       
    $sql->close();
    mysqli_close($con);
  ?>