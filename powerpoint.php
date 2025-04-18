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
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/daram.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

<!-- jQuery (필요하다면) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    
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
    <section class="module" id="works">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h2 class="module-title font-alt">Production Direction And Goals</h2>
              <div class="module-subtitle font-serif"></div>
            </div>
          </div>
        </div>
      <div class="main">
        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <ul class="filter font-alt" id="filters">
                <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".Production" data-wow-delay="0.2s">Production Direction And Goals</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".PowerPoint" data-wow-delay="0.4s">PowerPoint</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".problu" data-wow-delay="0.4s">prosess&Blueprint</a></li>
                <li><a class="wow fadeInUp" href="#" data-filter=".Description" data-wow-delay="0.6s">Description</a></li>
                  </li>
                </ul>
              </div>
            </div>
            
            <ul class="works-grid works-grid-gut works-grid-3 works-hover-w" id="works-grid">
            <li class="work-item problu">
            <a href="assets/images/contents/process.jpg" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/process.jpg" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">prosess</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item problu">
            <a href="assets/images/contents/Blueprint.jpg" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/Blueprint.jpg" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Blueprint</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item Production">
            <a href="assets/images/contents/goals.jpg" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/goals.jpg" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Production Direction And Goals</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item Description">
            <a href="assets/images/contents/Description1.jpg" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/Description1.jpg" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Description 1</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item Description">
            <a href="assets/images/contents/Description2.jpg" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/Description2.jpg" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Description 2</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide1.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide1.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 1</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>
          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide2.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide2.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 2</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>
          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide3.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide3.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 3</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide4.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide4.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 4</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide5.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide5.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 5</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide6.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide6.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 6</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide7.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide7.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 7</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide8.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide8.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 8</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide9.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide9.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 9</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide10.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide10.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 10</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide11.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide11.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 11</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide12.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide12.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 12</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide13.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide13.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 13</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>

          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide14.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide14.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 14</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>
          <li class="work-item PowerPoint">
            <a href="assets/images/contents/remember_me/slide15.PNG" data-lightbox="image-group">
              <div class="work-image"><img src="assets/images/contents/remember_me/slide15.PNG" alt="Portfolio Item" /></div>
              <div class="work-caption font-alt">
                <h3 class="work-title">Boram 15</h3>
                <div class="work-descr">설명</div>
              </div>
            </a>
          </li>
          
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