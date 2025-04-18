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

    $dailyCounts = array(); // 날짜별 운동 횟수를 저장할 배열 초기화

    // 데이터베이스에서 데이터 가져오기
    while ($row = mysqli_fetch_assoc($result)) {
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $count = $row['count'];

        $exercise_type = "";
        $event_color = "";

        switch ($row['type']) {
            case 1:
                $exercise_type = "스쿼트";
                $event_color = "#364F6B"; // 스쿼트에 대한 색상
                break;
            case 2:
                $exercise_type = "런지";
                $event_color = "#3FC1C9"; // 런지에 대한 색상
                break;
            case 3:
                $exercise_type = "래터럴 레이즈";
                $event_color = "#FC5185"; // 레이즈에 대한 색상
                break;
            default:
                $exercise_type = "기타 운동";
                $event_color = "#F5F5F5"; // 레이즈에 대한 색상
        }

        // 시간 차이 계산
        $time_diff = strtotime($end_time) - strtotime($start_time);

        // 시간 차이를 시간과 분으로 변환
        $hours = floor($time_diff / 3600);
        $minutes = floor(($time_diff % 3600) / 60);
        $seconds = $time_diff % 60;

        // 'title' 값을 변경하여 '운동 종류 | 카운트 | 운동 시간' 형식으로 지정
        $exercise_type_with_count_and_time = $exercise_type . " | " . $count . "개 | " . $hours . "시간 " . $minutes . "분 " . $seconds . "초";

        // 이벤트를 위해 데이터 포맷팅
        $event = array(
            'title' => $exercise_type_with_count_and_time,
            'start' => $start_date,
            'end' => $end_date,
            'description' => '운동 시간: ' . $hours . ' 시간 ' . $minutes . ' 분',
            'color' => $event_color  
        );

         // 'start_date'를 키로 사용하여 운동 횟수를 배열에 저장
        $exerciseDate = $row['start_date'];
        if (!isset($dailyCounts[$exerciseDate])) {
            $dailyCounts[$exerciseDate] = 0;
        }
        $dailyCounts[$exerciseDate] += $row['count'];

        $backgroundColor = generateBackgroundColorFromCount($dailyCounts[$exerciseDate]);

        $backgroundEvent = array(
            'start' => $start_date,
            'display' => 'background', // 배경으로 표시
            'backgroundColor' => $backgroundColor, // 배경색 지정
        );


        // 이벤트를 이벤트 배열에 추가
        array_push($events, $backgroundEvent, $event);    
    }


    // 배경색을 결정하는 함수
    function generateBackgroundColorFromCount($count) {
      if ($count == 0) {
          return "rgba(255, 0, 0, 0)"; // 0개
      } else if ($count < 10) {
          return "rgba(255, 0, 0, 0.75)"; // 1-9개
      } else if ($count < 20) {
          return "rgba(255, 0, 0, 0.5)"; // 10-19개
      } else if ($count < 30) {
          return "rgba(255, 125, 0, 1)"; // 20-29개
      } else if ($count < 40) {
          return "rgba(255, 125, 0, 0.75)"; // 30-39개
      } else if ($count < 50) {
          return "rgba(255, 205, 0, 1)"; // 50개 이하까지 빨강 계열(할수록 점점 연해짐)
      } else if ($count < 60) {
          return "rgba(255, 205, 0, 0.75)"; // 50개부터 파랑 계열(할수록 점점 진해짐)
      } else if ($count < 70) {
          return "rgba(0, 220, 255, 0.75)"; // 60-69개
      } else if ($count < 80) {
          return "rgba(0, 220, 255, 1)"; // 70-79개
      } else if ($count < 90) {
          return "rgba(0, 35, 255, 0.5)"; // 80-89개
      } else if ($count < 100) {
        return "rgba(0, 35, 255, 0.75)"; // 90-99개
      } else {
          return "rgba(0, 35, 255, 1)"; // 100개 이상 진한 파랑
      }
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);
  
    // events 배열에 각 이벤트 추가
    $eventsJSON = json_encode($events);
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<div>
  
<?php if (isset($days_difference)) { ?>
            <p>두 날짜 사이의 일 수: <?php echo $days_difference; ?>일</p>
        <?php } ?>
        <?php if (isset($hours_difference) && isset($minutes_difference) && isset($seconds_difference)) { ?>
            <p>두 날짜 사이의 시간: <?php echo $hours_difference; ?>시간 <?php echo $minutes_difference; ?>분 <?php echo $seconds_difference; ?>초</p>
        <?php } ?>
    </div>
    
<!-- 풀캘린더 -->
<script src="/boram/fullcalendar/dist/index.global.js"></script>

<script>
   // PHP 변수를 JavaScript에서 사용합니다.
   var events = <?php echo $eventsJSON; ?>;
  // 이제 'events'에는 원하는 형식의 데이터가 포함됩니다.
  console.log(events); // 콘솔에서 데이터를 확인할 수 있습니다.
  // 이 'events' 데이터를 JavaScript 코드에서 사용할 수 있습니다.

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      titleFormat: { year: 'numeric', month: 'long' },
      locale: 'ko',
      customButtons: {
        today: {
          text: '오늘', // "today" 버튼 텍스트를 "오늘"로 변경
          click: function () {
            calendar.gotoDate(new Date()); // "today" 버튼을 클릭했을 때의 동작 (오늘 날짜로 이동)
          }
        },
        dayGridWeek: {
          text: '주 별',
          click: function () {
            calendar.changeView('dayGridWeek');
          }
        },
        dayGridMonth: {
          text : '월 별',
          click: function () {
            calendar.changeView('dayGridMonth');
          }
        },
        dayGridDay: {
          text: '일 별',
          click: function () {
            calendar.changeView('dayGridDay');
          }
        }
      },
      navLinks: true, // can click day/week names to navigate views
      editable: false, // false일 시 데이터 드래그가 막힘
      dayMaxEvents: true, // allow "more" link when too many events
      events: events
      

    });

    calendar.render();
  });

</script>

<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 1100px;
        margin: 0 auto;
    }

    #myAreaChart {
        height: 400px; /* 차트 길이 */
    }

</style>
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
        <section class="module-small">
          <div class="container">
            <div class="row">
              <div class="col-sm-4 col-md-3 sidebar">
                <div class="widget">
                </div>
                <div class="widget">
                  <h5 class="widget-title font-alt">마이페이지</h5>
                  <ul class="icon-list">
                    <li><a href="#">운동 기록</a></li>
                  </ul>
                  <ul class="icon-list">
                    <li><a href="#">운동 시간</a></li>
                  </ul>
                </div>

              </div>
              <div class="col-sm-8 col-sm-offset-1">
                <div class="post">
                  <div class="post-header font-alt">
                    <h1 class="post-title">운동 기록</h1>
                    <div id="calendar" class= "post-thumbnail"></div>
                  </div> 
                </div>

                <div class="comments">
                  <h4 class="comment-title font-alt">운동시간</h4>
                  <!-- Area Chart -->
                  <div class="card shadow mb-4">            
                    <div class="card-body">
                      <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                      </div>         
                    </div>
                  </div>
                </div>
        </div>
    </section>
  </body>
</html>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-bar.php"></script>
<script src="js/demo/chart-bar.php"></script>

<?php include('footer.php'); ?>