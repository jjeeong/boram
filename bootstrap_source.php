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
            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <?= $logged ?>님
              </a>
              <ul class="dropdown-menu">
                <li class="dropdown"><a class="dropdown-toggle" href="logout.php" data-toggle="dropdown">로그아웃</a>
              </ul>
        </div>
      </div>
    </nav>
    <main>
      <section class="home-section home-parallax home-fade home-full-height bg-dark-30" id="home" data-background="assets/images/mainpage_img/main_banner.jpg">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-alt mb-30 titan-title-size-1">source</div>
            <div class="font-alt mb-40 titan-title-size-3"><span class="rotate">bootstrap | images | easter egg</span>
            </div><a class="section-scroll btn btn-border-w btn-circle" href="#about">Learn More</a>
          </div>
        </div>
      </section>
      <div class="main">
        <section id="about">
          <hr class="divider-w">
          <section class="module" id="services">
            <div class="container">
              <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                  <h2 class="module-title font-alt">source</h2>
                  <div class="module-subtitle font-serif"></div>
                </div>
              </div>

              <div class="row multi-columns-row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-tools"></span></div>
                    <h3 class="features-title font-alt"><a href="https://themewagon.com/themes/titan/">titan master</a>
                    </h3>
                    <p>전체 디자인에 사용된 부트스트랩입니다.</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-tools"></span></div>
                    <h3 class="features-title font-alt"><a href="https://startbootstrap.com/previews/sb-admin-2">sbadmin2</a></h3>
                    <p>그래프, 로그인, 회원가입 디자인에 사용된 부트스트랩입니다.</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-calendar"></span></div>
                    <h3 class="features-title font-alt"><a href="https://fullcalendar.io/">fullcalendar</a></h3>
                    <p>운동기록에 사용된 풀캘린더입니다.</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-genius"></span></div>
                    <h3 class="features-title font-alt"><a href="https://teachablemachine.withgoogle.com/">teachablemachiner</a></h3>
                    <p>Boram AI를 학습하기 위해 사용한 Tensorflow movenet기반의 머신입니다.</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-gears"></span></div>
                    <h3 class="features-title font-alt">MySQL</h3>
                    <p>로그인 및 회원가입을 위한 member table, 운동 및 기록을 위한 health table로 구성되어 있습니다.</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-gears"></span></div>
                    <h3 class="features-title font-alt">Visual Studio Code</h3>
                    <p>js, php, html, css</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-megaphone"></span></div>
                    <h3 class="features-title font-alt">TTS</h3>
                    <p>Boram 헬스 TTS입니다.</p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="features-item">
                    <div class="features-icon"><span class="icon-lifesaver"></span></div>
                    <h3 class="features-title font-alt">sdf</h3>
                    <p>사이트 아이콘입니다.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </section>

        <section class="module bg-dark-60" data-background="assets/images/section-6.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="video-box">
                  <div class="video-box-icon"><a class="video-pop-up" href="https://www.youtube.com"><span class="icon-video"></span></a></div>
                  <div class="video-title font-alt">Presentation</div>
                  <div class="video-subtitle font-alt">시청해주세요</div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <ul class="filter font-alt" id="filters">
                  <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>
                  <li><a class="wow fadeInUp" href="#" data-filter=".mainpage" data-wow-delay="0.2s">mainpage</a></li>
                  <li><a class="wow fadeInUp" href="#" data-filter=".joinpage" data-wow-delay="0.4s">joinpage</a></li>
                  <li><a class="wow fadeInUp" href="#" data-filter=".exercise" data-wow-delay="0.6s">exercise</a></li>
                  <li><a class="wow fadeInUp" href="#" data-filter=".event" data-wow-delay="0.6s">event</a></li>
                  <li><a class="wow fadeInUp" href="#" data-filter=".icon" data-wow-delay="0.6s">icon</a>
                  </li>
                </ul>
              </div>
            </div>
            <ul class="works-grid works-grid-gut works-grid-4 works-hover-w" id="works-grid">
              <li class="work-item mainpage webdesign"><a href="portfolio_single_featured_image1.html">
                  <div class="work-image"><img src="assets/images/mainpage_img/main_banner.jpg" alt="Portfolio Item" /></div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">mainpage</h3>
                    <div class="work-descr"><a href="https://www.pexels.com/ko-kr/photo/416747/">출처</a></div>
                  </div>
                </a></li>
              <li class="work-item joinpage "><a href="portfolio_single_featured_image2.html">
                  <div class="work-image"><img src="assets/images/regist/woman-1834827_1280.jpg" alt="Portfolio Item" />
                  </div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">joinpage</h3>
                    <div class="work-descr"><a href="https://pixabay.com/photos/woman-yoga-coast-exercise-fitness-1834827/">출처</a></div>
                  </div>
                </a></li>
              <li class="work-item mainpage "><a href="portfolio_single_featured_slider1.html">
                  <div class="work-image"><img src="assets/images/main_exercise/raise.jpg" alt="Portfolio Item" /></div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">mainpage_lateral_raise</h3>
                    <div class="work-descr"><a href="https://www.pexels.com/ko-kr/photo/6339687/">출처</a></div>
                  </div>
                </a></li>
              <li class="work-item mainpage "><a href="portfolio_single_featured_slider2.htmll">
                  <div class="work-image"><img src="assets/images/main_exercise/lunge.png" alt="Portfolio Item" /></div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">mainpage_lunge</h3>
                    <div class="work-descr"><a href="https://pixabay.com/photos/action-jump-woman-exercise-figure-1850677/">출처</a></div>
                  </div>
                </a></li>
              <li class="work-item illustration "><a href="portfolio_single_featured_video1.html">
                  <div class="work-image"><img src="assets/images/main_exercise/main_demo.jpg" alt="Portfolio Item" />
                  </div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">mainpage_squat</h3>
                    <div class="work-descr"><a href="https://kr.freepik.com/free-photo/woman-doing-squats-and-exercising-outdoors-street_15709320.htm">출처</a></div>
                  </div>
                </a></li>

              <li class="work-item exercise "><a href="portfolio_single_featured_video1.html">
                  <div class="work-image">
                    <video width="280" height="380" autoplay>
                      <source src="assets/images/videos/squartEx.mp4" type="video/mp4"></video>
                  </div>

                  <div class="work-caption font-alt">
                    <h3 class="work-title">squart_exercise</h3>
                    <div class="work-descr"><a href="https://www.pexels.com/ko-kr/video/8837221/">출처</a></div>
                  </div>
                </a></li>

                <li class="work-item exercise "><a href="portfolio_single_featured_video2.html">
                <div class="work-image">
                    <video width="280" height="380" autoplay>
                      <source src="assets/images/videos/raiseEx.mp4" type="video/mp4"></video>
                  </div>

                  <div class="work-caption font-alt">
                    <h3 class="work-title">lateral_raise_exercise</h3>
                    <div class="work-descr"><a href="https://www.pexels.com/ko-kr/video/5319102/">출처</a></div>
                  </div>
                </a></li>

                <li class="work-item exercise "><a href="portfolio_single_featured_video3.html">
                <div class="work-image">
                    <video width="280" height="380" autoplay>
                      <source src="assets/images/videos/lungeEx.mp4" type="video/mp4"></video>
                  </div>

                  <div class="work-caption font-alt">
                    <h3 class="work-title">lunge_exercise</h3>
                    <div class="work-descr"><a href="https://www.pexels.com/ko-kr/video/5025833/">출처</a></div>
                  </div>
                </a></li>

              <li class="work-item mainpage "><a href="portfolio_single_featured_image1.html">
                  <div class="work-image"><img src="assets/images/main_exercise/balloon.jpg" alt="Portfolio Item" />
                  </div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">balloon</h3>
                    <div class="work-descr"><a href="https://pixabay.com/photos/balloons-colorful-multicolored-1869790/">출처</a></div>
                  </div>
                </a></li>
              <li class="work-item icon"><a href="portfolio_single_featured_image2.html">
                  <div class="work-image"><img src="assets/images/favicons/daram.png" alt="Portfolio Item" />
                  </div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">Boram_site_icon</h3>
                    <div class="work-descr"><a href="https://kr.freepik.com/icon/squirell_8415926#fromView=search&term=다람쥐&page=6&position=62&track=ais">출처</a></div>
                  </div>
                </a></li>
                <li class="work-item event"><a href="portfolio_single_featured_image2.html">
                  <div class="work-image"><img src="assets/images/videos/arabesque.jpg" alt="Portfolio Item" />
                  </div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">arabesque_event</h3>
                    <div class="work-descr">출처: 짱구는 못말려 극장판 | 핸더랜드의 대모험</div>
                  </div>
                </a></li>
                <li class="work-item event"><a href="portfolio_single_featured_image2.html">
                  <div class="work-image"><img src="assets/images/videos/ma_heart.png" alt="Portfolio Item" />
                  </div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title">ma_heart_event</h3>
                    <div class="work-descr"><a href="https://news.nate.com/view/20230708n12454">출처</a></div>
                  </div>
                </a></li>
            </ul>
          </div>
        </section>



        <hr class="divider-w">
        <section class="module bg-dark-60 pt-0 pb-0 parallax-bg testimonial" data-background="assets/images/testimonial_bg.jpg">
          <div class="testimonials-slider pt-140 pb-140">
            <ul class="slides">
              <li>
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="module-icon"><span class="icon-quote"></span></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                      <blockquote class="testimonial-text font-alt">I am alone, and feel the charm of existence in this
                        spot, which was created for the bliss of souls like mine.</blockquote>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                      <div class="testimonial-author">
                        <div class="testimonial-caption font-alt">
                          <div class="testimonial-title">Jack Woods</div>
                          <div class="testimonial-descr">SomeCompany INC, CEO</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="module-icon"><span class="icon-quote"></span></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                      <blockquote class="testimonial-text font-alt">I should be incapable of drawing a single stroke at
                        the present moment; and yet I feel that I never was a greater artist than now.</blockquote>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                      <div class="testimonial-author">
                        <div class="testimonial-caption font-alt">
                          <div class="testimonial-title">Jim Stone</div>
                          <div class="testimonial-descr">SomeCompany INC, CEO</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="module-icon"><span class="icon-quote"></span></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                      <blockquote class="testimonial-text font-alt">I am so happy, my dear friend, so absorbed in the
                        exquisite sense of mere tranquil existence, that I neglect my talents.</blockquote>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                      <div class="testimonial-author">
                        <div class="testimonial-caption font-alt">
                          <div class="testimonial-title">Adele Snow</div>
                          <div class="testimonial-descr">SomeCompany INC, CEO</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <?php include('footer.php'); ?>
</body>

</html>