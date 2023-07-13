<!DOCTYPE html>
<html lang="en">

<head>
    @include('patient.includes.head')
    <style>
    .data-label {
      font-size: 15px;
    }
    .data-badge {
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 10px;
    }
    .weight-badge {
      background-color: #007bff;
      color: #fff;
    }
    .height-badge {
      background-color: #28a745;
      color: #fff;
    }
    .blood-badge {
      background-color: #dc3545;
      color: #fff;
    }
    @media (min-width: 768px) {
      .table-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
      }
    }


  </style>
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('patient.includes.header')
            @include('patient.includes.chatSidebar')
            @include('patient.includes.showChat_inner')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('patient.includes.sidebar')

                    <!-- Begin Page Content -->
                    @yield('content')
                    <!-- End of Main Content -->


                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>

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
</html>