<!DOCTYPE html>
<html lang="en">

<head>
    @include('doctor.includes.head')
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('doctor.includes.header')
            @include('doctor.includes.chatSidebar')
            @include('doctor.includes.showChat_inner')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('doctor.includes.sidebar')

                    <!-- Begin Page Content -->
                    @yield('content')
                    <!-- End of Main Content -->


                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--[if lt IE 10]>
      <div class="ie-warning">
          <h1>Warning!!</h1>
          <p>You are using an outdated version of Internet Explorer, please upgrade
              <br/>to any of the following web browsers to access this website.
          </p>
          <div class="iew-container">
              <ul class="iew-download">
                  <li>
                      <a href="http://www.google.com/chrome/">
                          <img src="./files/assets/images/browser/chrome.png" alt="Chrome">
                          <div>Chrome</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.mozilla.org/en-US/firefox/new/">
                          <img src="./files/assets/images/browser/firefox.png" alt="Firefox">
                          <div>Firefox</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://www.opera.com">
                          <img src="./files/assets/images/browser/opera.png" alt="Opera">
                          <div>Opera</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.apple.com/safari/">
                          <img src="./files/assets/images/browser/safari.png" alt="Safari">
                          <div>Safari</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                          <img src="./files/assets/images/browser/ie.png" alt="">
                          <div>IE (9 & above)</div>
                      </a>
                  </li>
              </ul>
          </div>
          <p>Sorry for the inconvenience!</p>
      </div>
  <![endif]-->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min-1.js"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min-1.js') }}"></script>

    <script src="{{ asset('files/assets/pages/waves/js/waves.min-1.js') }}"></script>

    <script type="text/javascript"
        src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js') }}"></script>

    <script src="{{ asset('files/assets/pages/chart/float/jquery.flot-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/chart/float/jquery.flot.categories-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/chart/float/curvedLines-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/chart/float/jquery.flot.tooltip.min-1.js') }}"></script>

    <script src="{{ asset('files/bower_components/chartist/js/chartist-1.js') }}"></script>

    <script src="{{ asset('files/assets/pages/widget/amchart/amcharts-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/widget/amchart/serial-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/widget/amchart/light-1.js') }}"></script>

    <script src="{{ asset('files/assets/js/pcoded.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/js/vertical/vertical-layout.min-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/pages/dashboard/custom-dashboard.min-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/script.min-1.js') }}"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
</body>

<script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Neurology', 'Oncology', 'Cardiology', 'Ophtalmology'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    const ctx2 = document.getElementById('myChart2');
  
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: ['January', 'March', 'April', 'May', 'June'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
      });
      calendar.render();
    });

  </script>

</html>