<!--  
    Favicons
    =============================================
    -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/daram.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/daram.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/daram.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/daram.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/daram.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/daram.png">
    <!-- <link rel="manifest" href="/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/daram.png">
    <meta name="theme-color" content="#ffffff">

<?php
    // userid를 받아옴(로그인상태 체크를 위해)
    session_start();

    if (isset($_SESSION["userid"])) 
        $userid = $_SESSION["userid"];
    else {
        $userid = "";
    }

    $logged = $userid;

    $con = mysqli_connect("localhost", "user", "1234", "boram");

    // 데이터베이스에서 데이터 검색
    $sql = "SELECT * FROM health WHERE id = '$userid'";
    $result = mysqli_query($con, $sql);

    // 이벤트를 저장할 배열 초기화
    $events = array();

    // 검색한 데이터 처리
    while ($row = mysqli_fetch_assoc($result)) {
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];

        // 시간 차이 계산
        $time_diff = strtotime($end_time) - strtotime($start_time);

        // 시간 차이를 시간과 분으로 변환
        $hours = floor($time_diff / 3600);
        $minutes = floor(($time_diff % 3600) / 60);

        // 이벤트를 위해 데이터 포맷팅
        $event = array(
            'title' => '스쿼트',
            'start' => $start_date,
            'end' => $end_date,
            'description' => '운동 시간: ' . $hours . ' 시간 ' . $minutes . ' 분'
        );

        // 이벤트를 이벤트 배열에 추가
        array_push($events, $event);
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // 이제 $events 배열에 필요한 형식의 모든 이벤트가 포함되어 있습니다.
    // 필요한 경우 JSON으로 변환할 수 있습니다.
    $eventsJSON = json_encode($events);
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<div>

</head>

<?php include('header.php'); ?>

  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
              <a class="navbar-brand" href="mainpage.php">BORAM</a> 
          </div>

          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a class="dropdown-toggle" href="mainpage.php" data-toggle="dropdown">Home</a>
                <ul class="dropdown-menu">
                  <li><a href="mainpage.php">Home</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><?=$logged?>님</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="logout.php" data-toggle="dropdown">로그아웃</a>
            </ul>
          </div>
        </div>
      </nav>

      <div class="main">
      <section class="module bg-dark-60 about-page-header">
        <!-- <section class="module bg-dark-60 about-page-header" data-background="assets/images/team/"> -->
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">team</h2>
                <div class="module-subtitle font-serif">팀을 소개합니다.</div>
              </div>
            </div>
          </div>
        </section>
        
        
        <hr class="divider-w">
        <section class="module" id="team">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Meet Our Team</h2>
                <div class="module-subtitle font-serif">프로젝트를 함께 진행한 팀을 소개합니다.</div>
              </div>
            </div>
            <div class="row">
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-4">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team/jjang.jpg" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">모두들 수고했어!</h5>
                      <p class="font-serif">앞으로 남은 시간 잘 보내고 웃으면서 졸업하자!</p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">마수빈</div>
                    <div class="team-role">소프트웨어융합학과 3학년 202108001</div>
                  </div>
                </div>
              </div>
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-4">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team/pizeon.png" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">기억해조</h5>
                      <p class="font-serif">화이팅 고생많앗따!</p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">문정원</div>
                    <div class="team-role">소프트웨어융합학과 3학년 202108002</div>
                  </div>
                </div>
              </div>
              <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-4">
                <div class="team-item">
                  <div class="team-image"><img src="assets/images/team/ch.jpg" alt="Member Photo"/>
                    <div class="team-detail">
                      <h5 class="font-alt">야호 끝이다!</h5>
                      <p class="font-serif">저희 고양이 너무 귀엽죠?? 이제 끝났으니까 여행갈려구요 히히 사람들이 여기까지 눌러보지않곘지? </p>
                      <div class="team-social"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a></div>
                    </div>
                  </div>
                  <div class="team-descr font-alt">
                    <div class="team-name">황희리</div>
                    <div class="team-role">소프트웨어융합학과 3학년 202108009</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- <section class="module bg-dark-60" data-background="assets/images/section-6.jpg"> -->
        <section class="module bg-dark-60">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Scoreboard</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
            <div class="row multi-columns-row">
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="count-item mb-sm-40">
                  <div class="count-icon"><span class="icon-wallet"></span></div>
                  <h3 class="count-to font-alt" data-countto="6543"></h3>
                  <h5 class="count-title font-serif">Dollars raised for charity</h5>
                </div>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="count-item mb-sm-40">
                  <div class="count-icon"><span class="icon-wine"></span></div>
                  <h3 class="count-to font-alt" data-countto="8"></h3>
                  <h5 class="count-title font-serif">Cups of wine consumed</h5>
                </div>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="count-item mb-sm-40">
                  <div class="count-icon"><span class="icon-camera"></span></div>
                  <h3 class="count-to font-alt" data-countto="184"></h3>
                  <h5 class="count-title font-serif">Photographs taken</h5>
                </div>
              </div>
              <div class="col-sm-6 col-md-3 col-lg-3">
                <div class="count-item mb-sm-40">
                  <div class="count-icon"><span class="icon-map-pin"></span></div>
                  <h3 class="count-to font-alt" data-countto="32"></h3>
                  <h5 class="count-title font-serif">Locations covered</h5>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        
        <hr class="divider-d">
        
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>

    <?php include('footer.php'); ?>
    
  </body>
</html>