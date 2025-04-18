<?php
    $id = $_POST["id"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $tel = $_POST["tel"];
    $birth = $_POST["birth"];
    $email = $_POST["email"];
    // $regist_day = date("Y-m-d(H:i)");

    // $con = mysqli_connect("localhost", "user", "1234", "boram");
    
    // $sql = "insert into member(id, password, name, gender, tel, birth, email)";
    // $sql .= "values('$id', '$password', '$name', '$gender', '$tel', '$birth', '$email')";

    $con = mysqli_connect("localhost", "user", "1234", "boram"); //DB 연결
    $sql = $con->prepare("INSERT INTO member (id, password, name, gender, tel, birth, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssss", $id, $password, $name, $gender, $tel, $birth, $email); //s가 문자열로 받아오는건데 s수만큼 뒤에있는거 문자열로 받아옴

    // 쿼리 실행
    $sql->execute();

    echo "<script> location.href = 'login_form.html';</script> ";

    //연결 종료
    $sql->close();
    mysqli_close($con);
?>
