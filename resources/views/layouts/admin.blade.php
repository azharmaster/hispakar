<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('admin.includes.header')
            @include('admin.includes.chatSidebar')
            @include('admin.includes.showChat_inner')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('admin.includes.sidebar')

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

    
    <!--scripts from dtScripts -->
    <script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min-1.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/jszip.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/extensions/buttons/js/buttons.flash.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/extensions/buttons/js/jszip.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/extensions/buttons/js/vfs_fonts-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min-1.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min-1.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min-1.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min-1.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min-1.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min-1.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/data-table-custom-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/printScript.js') }}"></script>
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
        labels: ['Newborn', 'Infant', 'Child', 'Adolescent', 'Old Age'],
        datasets: [{
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1,
                backgroundColor: ['#FFB1C1', '#7FB5B5', '#EC7C26', '#3E5F8A', '#1E5945', '#57A639'],
            },

        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        maintainAspectRatio: true,
    }
});

const ctx3 = document.getElementById('myChart3');

new Chart(ctx3, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June'],
        datasets: [{
                label: '# of Male',
                data: [120, 130, 143, 131, 123, 132],
            },

            {
                label: '# of Female',
                data: [132, 126, 134, 159, 156, 135]
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart.js Line Chart'
            }
        }
    },
})
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