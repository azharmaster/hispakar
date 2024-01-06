<!DOCTYPE html>
<html lang="en">

<head>
    <title>PAKAR HIS | Doctor</title>
    <link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style-1.css') }}">

    @include('layouts.includes.head')
</head>

<body onafterprint="hideLogo()">
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
    @include('layouts.includes.script')

</body>

</html>