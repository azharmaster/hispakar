<!-- Start Navigation -->
<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="">
                    <a href="/doctor/dashboard" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="">
                    <a href="/doctor/scheduleList" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fas fa-solid fa-calendar"></i></span>
                        <span class="pcoded-mtext">Schedule</span>
                    </a>
                </li>

                <li class="">
                    <a href="/doctor/patientList" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fas fa-regular fa-hospital-user"></i></span>
                        <span class="pcoded-mtext">Patients</span>
                    </a>
                </li>

                <li class="">
                    <a href="/doctor/appointmentList" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="fas fa-solid fa-calendar-check"></i>
                    </span>
                    <span class="pcoded-mtext">Appointments</span>
                    </a>
                </li>

                <li class="">
                    <a href="/doctor/medicines" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="fas fa-regular fa-capsules"></i>
                    </span>
                    <span class="pcoded-mtext">Medicine</span>
                    </a>
                </li>

                <li class="">
                    <a href="/doctor/reports" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                    <i class="fas fa-regular fa-file-medical"></i>
                    </span>
                    <span class="pcoded-mtext">Reports</span>
                    </a>
                </li>

                <br>

                <li class="">
                    <a href="{{ route('logout') }}" class="waves-effect waves-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="pcoded-micon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>  
            </ul>
        </div>
    </div>
</nav>
<!-- End Navigation -->