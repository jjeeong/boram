<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .close{
            margin: 20px 0 0 120px;
            cursor: pointer;
        }
    </style>

    <title>Boram | Check_id</title>
</head>
<body>
    <div class="form-group">
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">아이디 중복체크</h1>
        <style>
            .mb-4{
                margin-top: 20px;
            }
        </style>
    </div>
        <div class="text-center">
            <?php
                $id = $_GET["id"];

                if(!$id){
                    echo("아이디를 입력해주세요.");
                }else{
                    $con = mysqli_connect("localhost", "user", "1234", "boram");

                    $sql = $con->prepare("SELECT num, id, password, name, gender, tel, birth, email from member where id = ?");

                    $sql->bind_param("s", $id);

                    $sql->execute();
                
                    $result = $sql->get_result();

                    $num_match = mysqli_num_rows($result);


                    $num_record = mysqli_num_rows($result);

                    if($num_record){
                        echo $id."아이디는 중복됩니다.<br>";
                        echo "다른 아이디를 사용해주세요.";
                    }else{
                        echo $id." 아이디는 사용 가능합니다.";
                    }
                    $sql->close();
                    mysqli_close($con);
                }
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="text-center">
            <button onclick="javascript:self.close()" class="btn btn-secondary btn-user">창 닫기</button>
        </div>
    </div>

</body>
</html>