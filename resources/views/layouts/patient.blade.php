<!DOCTYPE html>
<html lang="en">

<head>
    <title>PAKAR HIS | User</title>
    @include('layouts.includes.head')
</head>

<body onafterprint="hideLogo()">
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

    @include('layouts.includes.script')

</body>

</html>