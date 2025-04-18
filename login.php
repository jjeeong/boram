<?php

    $id       = $_POST["id"];
    $password = $_POST["password"];

    $con = mysqli_connect("localhost", "user", "1234", "boram");
    $sql = $con->prepare("SELECT num, id, password, name, gender, tel, birth, email from member where id = ?");
    $sql->bind_param("s", $id);
    $sql->execute();
    $result = $sql->get_result();

    $num_match = mysqli_num_rows($result);

    if(!$num_match) {
        echo "<script>
               window.alert('등록되지 않는 아이디입니다.')
               history.go(-1)
             </script>";
      }
      else {
          $row = mysqli_fetch_assoc($result);
          $db_pass = $row["password"];
  
          mysqli_close($con);
  
          if($password != $db_pass) {
             echo "<script>
                  window.alert('비밀번호를 잘못 입력했습니다.')
                  history.go(-1)
                </script>";
             exit;
          }
          else {
              session_start();
              $_SESSION["userid"] = $row["id"];
  
              echo "<script>
                  location.href = 'mainpage.php';
                </script>";
          }
       }     
       
       
    $sql->close();
    mysqli_close($con);
  ?>