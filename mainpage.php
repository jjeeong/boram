<?php
// userid를 받아옴(로그인상태 체크를 위해)
session_start();

if (isset($_SESSION["userid"]))
  $userid = $_SESSION["userid"];
else {
  $userid = "";
}
?>

<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="ko">

<head>

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

</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  <main>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span></button>
          <a class="navbar-brand" href="mainpage.php">BORAM</a>
        </div>
        <div class="collapse navbar-collapse" id="custom-collapse">
          <ul class="nav navbar-nav navbar-right">

            <?php
            // 로그아웃 상태면 상단에 Login이 뜨고, 로그인 상태면 상단에 Logout이 뜸
            if (!$userid) {
            ?>
              <li class="dropdown"><a class="dropdown-toggle" href="login_form.html" data-toggle="dropdown">로그인</a>
                <ul class="dropdown-menu">
                  <li><a href="login_form.html">로그인</a></li>
                </ul>
              </li>
            <?php
            } else {
              $logged = $userid;
            ?>
              <li class="dropdown"><a class="dropdown-toggle" href="mypage.php" data-toggle="dropdown"><?= $logged ?>님</a>
                <ul class="dropdown-menu">
                  <li><a href="mypage.php">프로필수정</a></li>
                  <li><a href="logout.php">로그아웃</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="mypage.php" data-toggle="dropdown">마이페이지</a>
                <ul class="dropdown-menu">
                  <li><a href="mypage.php">마이페이지</a></li>
                </ul>
              </li>
            <?php
            }
            ?>

          </ul>
        </div>
    </nav>

    <section class="bg-dark-30 showcase-page-header module parallax-bg" data-background="assets/images/mainpage_img/main_banner.jpg">
      <div class="titan-caption">
        <div class="caption-content">
          <div class="font-alt mb-30 titan-title-size-1">Powerful. Multipurpose.</div>
          <div class="font-alt mb-40 titan-title-size-4">BORAM</div><a class="section-scroll btn btn-border-w btn-round" href="#demos">See Demos</a>
        </div>
      </div>
    </section>
    <div class="main showcase-page">

      <!-- Owl Carousel 슬라이더 -->

      <div class="owl-carousel" id="myCarousel">
        <div class="item">
          <!-- 첫 번째 슬라이드 내용 -->
          <section class="module-medium" id="demos">
            <div class="container">
              <div class="row multi-columns-row">
                <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="squart.html" onclick="checkLogin()">
                    <div class="content-box-image"><img src="assets/images/main_exercise/main_demo.jpg" alt="Main Demo"></div>
                    <h3 class="content-box-title">스쿼트</h3>
                  </a></div>
              </div>
            </div>
          </section>
          <div class="container">
            <!-- 슬라이드 내용 추가 -->
          </div>
        </div>
        <div class="item">
          <!-- 두 번째 슬라이드 내용 -->
          <section class="module-medium" id="demos">
            <div class="container">
              <div class="row multi-columns-row">

                <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="lunge.html" onclick="checkLogin()">
                    <div class="content-box-image"><img src="assets/images/main_exercise/lunge.png" alt="Agency"></div>
                    <h3 class="content-box-title">런지</h3>
                  </a></div>
              </div>
            </div>
            <!-- 슬라이드 내용 추가 -->

        </div>
        <div class="item">
          <!-- 두 번째 슬라이드 내용 -->
          <section class="module-medium" id="demos">
            <div class="container">
              <div class="row multi-columns-row">

                <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="lateral_raise.html" onclick="checkLogin()">
                    <div class="content-box-image"><img src="assets/images/main_exercise/raise.jpg" alt="Portfolio"></div>
                    <h3 class="content-box-title">래터럴 레이즈</h3>
                  </a></div>
              </div>
            </div>
          </section>
          <!-- 슬라이드 내용 추가 -->

        </div>
        <!-- 다른 슬라이드 추가 -->
        <div class="item">
          <!-- 첫 번째 슬라이드 내용 -->
          <section class="module-medium" id="demos">
            <div class="container">
              <div class="row multi-columns-row">
                <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="event.html" onclick="checkLogin()">
                    <div class="content-box-image"><img src="assets/images/main_exercise/balloon.jpg" width="700px" height="1500px" alt="Main Demo"></div>
                    <h3 class="content-box-title">이벤트</h3>
                  </a></div>
              </div>
            </div>
          </section>
          <div class="container">
            <!-- 슬라이드 내용 추가 -->
          </div>
        </div>

      </div>
    </div>


    <div class="comments">
      <div class="ex_char">

        <h4 class=" font-alt">운동시간</h4>
      </div>
      <!-- Area Chart -->
      <hr>
      <div class="card shadow mb-4">
      <div class="ss">
        <div class="col-xl-8 c"></div>
          <div class="col-xl-8 b">
            <div class="card-body">
              <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
    <style>
    .ex_char {
      position: relative;
      left: 10%;
    }
    .ss{
      width: 100rem;
      height: 20rem;
      position: relative;
      left: 25%;
    }
    @media (min-width: 768px) and (max-width: 1024px) {
      .ss{
        width: 70rem;
        height: 20rem;
        position: relative;
        left: 10%;
      }
    }
    @media (max-width: 768px){
      .ss{
        width: 50rem;
        height: 20rem;
        position: relative;
        left: 10%;
      }
    }
  </style>

    <!-- 이전/다음 버튼 -->
    <div class="owl-nav">
      <div class="owl-prev"><i class="bi bi-chevron-left"></i></div>
      <div class="owl-next"><i class="bi bi-chevron-right"></i></div>
    </div>

    </script>
    </div>
    </div>
    </section>

    </div>
    <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>

  </main>


  <?php include('footer.php'); ?>

  <script>
    function checkLogin() {
      <?php
      if (!$userid) {
      ?>
        // 로그인되지 않은 경우 경고 메시지 표시
        alert("로그인을 하지 않으면 기록이 저장되지 않습니다.");
        return false; // 링크가 클릭되지 않도록 함
      <?php
      }
      ?>
    }
  </script>
</body>

<!-- Bootstrap core JavaScript-->
<!-- 운동 시간 기록 Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- 운동 시간 기록 Page level custom scripts -->
<script src="js/demo/chart-bar.php"></script>

</html>