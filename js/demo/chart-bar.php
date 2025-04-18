// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// 데이터 가져오기
var exerciseData = <?php

                      // userid를 받아옴(로그인상태 체크를 위해)
                      session_start();

                      if (isset($_SESSION["userid"])) 
                          $userid = $_SESSION["userid"];
                      else {
                          $userid = "";
                      }

                      $logged = $userid;

                      $con = mysqli_connect("localhost", "user", "1234", "boram"); // 데이터베이스에 연결
                      $sql = "SELECT DATE_FORMAT(start_date, '%m-%d') AS date, SUM(TIMESTAMPDIFF(SECOND, start_time, end_time)) AS total_seconds 
                              FROM health 
                              WHERE id = '$userid'
                              GROUP BY start_date
                              ORDER BY start_date DESC
                              LIMIT 7"; // 데이터베이스에서 날짜별 운동시간 합계 가져오기
                      $result = mysqli_query($con, $sql); // 쿼리 실행
                      $exercise_data = array(); // 데이터 배열 초기화
                      while ($row = mysqli_fetch_assoc($result)) {
                          $exercise_data[$row['date']] = $row['total_seconds']; // 데이터 처리
                      }
                      echo json_encode($exercise_data); // 데이터를 JSON 형식으로 변환하여 출력
                      mysqli_close($con); // 데이터베이스 연결 닫기
                  ?>;

// Area Chart Example
var ctx = document.getElementById("myAreaChart"); // 차트를 그릴 캔버스 요소 가져오기
var myLineChart = new Chart(ctx, {
  type: 'bar', // 차트 유형 설정
  data: {
    labels: <?php
                      $con = mysqli_connect("localhost", "user", "1234", "boram"); // 데이터베이스에 연결
                      $sql = "SELECT DATE_FORMAT(start_date, '%m-%d') AS date
                              FROM health 
                              WHERE id = '$userid'
                              GROUP BY start_date
                              ORDER BY start_date DESC
                              LIMIT 7"; // 데이터베이스에서 날짜별 날짜 가져오기
                      $result = mysqli_query($con, $sql); // 쿼리 실행
                      $dates = array(); // 데이터 배열 초기화
                      while ($row = mysqli_fetch_assoc($result)) {
                          array_push($dates, $row['date']); // 데이터 처리
                      }
                      echo json_encode($dates); // 데이터를 JSON 형식으로 변환하여 출력
                      mysqli_close($con); // 데이터베이스 연결 닫기
                  ?>,
    datasets: [{
      label: "운동시간", // 데이터셋 레이블 설정
      lineTension: 0.3,
      <!-- backgroundColor: "rgba(78, 115, 223, 0.05)", -->
      backgroundColor: "#353535", <!-- 그래프 색상 임시 -->
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: Object.values(exerciseData), // 데이터 설정
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          callback: function(value, index, values) {
            var minutes = Math.floor(value / 60);
            var seconds = value - minutes * 60;
            return minutes + "분 " + seconds + "초";
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          var value = tooltipItem.yLabel;
          var minutes = Math.floor(value / 60);
          var seconds = value - minutes * 60;
          return datasetLabel + ':' + minutes + '분 ' + seconds + '초';
        }
      }
    }
  }
});