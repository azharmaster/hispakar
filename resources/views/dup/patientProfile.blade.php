@php
    $userType = Auth::check() ? Auth::user()->usertype : null;
@endphp

@extends($userType == 2 ? 'layouts.doctor' : ($userType == 3 ? 'layouts.nurse' : ($userType == 1 ? 'layouts.admin' : '')))

<style>
    /* Height for screens larger than 768px / for full width */
    @media screen and (min-width: 768px) {
        .doc-pro-left {
            max-height: 500px;
        }
    }

    /* Height for screens smaller than 768px / responsive smaller screen */
    @media screen and (max-width: 767px) {
        .doc-pro-right {
            height: 197px;
        }

        .chartAttendance {
            max-width: 250px;
        }

        .chartByAge {
            margin-top: -1000px
        }
    }

    .hr-0 {
        border-bottom: none;
        border-top: none;
    }

    .list-group-no-border .list-group-item {
        border: none;
    }

</style>



@foreach($patientdetails as $patientdetail)


<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Profile Patient</h5>
                        <span>{{ $patientdetail->name }}'s Profile </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{ Auth::user()->usertype == 1 ? '/admin/dashboard' : (Auth::user()->usertype == 3 ? '/nurse/dashboard' : '/doctor/dashboard') }}">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ Auth::user()->usertype == 1 ? '/admin/patientList' : (Auth::user()->usertype == 3 ? '/nurse/patientList' : '/doctor/patientList') }}">
                            Patient Details
                        </a>
                    </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card doc-pro-left">
                                <div class="card-block" style="margin-left: 30px;">
                                    <button type="button" class="btn btn-mat waves-effect waves-light  d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-patient" title="Add Doctor">
                                        <i class="fas fa-cog"></i>

                                    </button>
                                    
                                   <div class="d-flex flex-column align-items-center text-center mr-10">
                                   <div class="parent-container2 mr-10" style="width: 135px; height: 135px; ">
                                            <div class="pic-holder" style="background-image: url({{ $patientdetail->image ? asset('storage/profilePic/' . $patientdetail->image) : asset('files/assets/images/profilePic/unknown.jpg') }}); border: 2px solid white;"></div>
                                    </div>                                        
                                        <div class="mt-3">
                                        <h4 class="font-weight-bold" style="margin-left: 5px;">{{ $patientdetail->name }}</h4>
                                            <p class="text-secondary mb-1">{{ $patientdetail->phoneno }}</p>
                                            <p class="text-muted font-size-sm">{{ $patientdetail->email }}</p>
                                            <p class="text-muted font-size-sm">{{ $patientdetail->address }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center text-sm-left" style="margin-left: 3px;">
                                            <ul class="list-group list-group-no-border list-group-horizontal">
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="bg-c-white text-success d-none d-sm-block me-12">
                                                        <i class="fas fa-ruler-vertical" style="margin-right: 4px;"></i>
                                                        <span class="badge data-badge height-badge">{{$patientdetail->height}} cm</span>
                                                    </h6>
                                                </li>

                                                <li class="list-group-item justify-content-between align-items-center">
                                                    <h6 class="bg-c-white text-primary d-none d-sm-block">
                                                        <i class="fas fa-weight mb-10" style="margin-right: 4px;"></i>
                                                        <span class="badge data-badge weight-badge">{{$patientdetail->weight}} kg</span> 
                                                    </h6>
                                                </li>

                                                <li class="list-group-item justify-content-between align-items-center">
                                                    <h6 class="bg-c-white text-danger d-none d-sm-block">
                                                        <i class="fas fa-id-card" style="margin-right: 4px;"></i>                
                                                        <span class="text-muted text-center"><span class="badge data-badge blood-badge">{{$patientdetail->bloodtype}}</span>
                                                    </h6>                                                    
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center text-sm-left" style="margin-right: 10px; margin-left: -10px;">
                                            <ul class="list-group list-group-no-border list-group-horizontal">

                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="bg-c-white text-info d-none d-sm-block me-12">
                                                    </h6>
                                                </li>

                                                <li class="list-group-item justify-content-between align-items-center">
                                                    <h6 class="bg-c-white sptext-badge d-none d-sm-block">
                                                    </h6>
                                                </li>

                                                <li class="list-group-item justify-content-between align-items-center">
                                                    <h6 class="bg-c-white stresstext-badge d-none d-sm-block">
                                                    </h6>
                                                </li>

                                            
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <div class="row">
                            <div class="col-6">
                                    <a data-toggle="modal" data-target="#nextaptModal">
                                        <div class="card comp-card doc-pro-right" style="height:203px;">
                                            <div class="card-body">
                                                <div class="row align-items-center">

                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600">Doctor In-Charge</h6>

                                                        <div class="d-flex flex-row justify-content-between mt-4">
                                                            <div class="row d-flex align-items-center">
                                                            @foreach ($doctorNames as $doctorName)

                                                                <h2 class="f-w-700 text-success ml-3" style="font-size: 20px; max-height: 80px;">{{$doctorName}}</h2>
                                                                @endforeach

                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user-md bg-c-green d-none d-sm-block" style="margin-top: -8px; margin-left: 30px;"></i>
                                                            </div>
                                                        </div>


                                                        <p class="m-b-0 mt-3" style="margin-top: 50px;">Appointed Doctor</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </a>

                                </div>

                                <div class="col-6" >
                                    <a data-toggle="modal" data-target="#todayAppointmentModal">
                                        <div class="card comp-card bg-c-blue doc-pro-right " style="height:203px;">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white">Medical Service</h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                        <div class="row d-flex align-items-center">
                                                            <div class="col-9">
                                                                @if ($medRecords)
                                                                    <h2 class="f-w-700 text-white ml-3" style="font-size: 18px; max-height: 80px; margin-bottom: 0;">
                                                                        {{ optional($medRecords->medservice)->type }}
                                                                    </h2>
                                                                @else
                                                                    <h2 class="f-w-700 text-white ml-3">N/A</h2>
                                                                @endif
                                                            </div>
                                                            <div class="col-3">
                                                                <i class="fas fa-hand-holding-medical bg-c-white text-primary d-none d-sm-block"></i>
                                                            </div>
                                                        </div>
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white">Previous Medical Record</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#totalpatientModal">
                                        <div class="card comp-card bg-c-blue doc-pro-right" style="height:170px">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white ">Past Appointments</h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">{{ $totalPastAppointments  }}</h2>
                                                            <a type="button"  class="past-appt-modal-trigger" data-toggle="modal" data-target="#addModal-pastappt"><i class="fas fa-file-alt bg-c-white text-primary d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i></a>
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white">Total Past Appointments</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->

                                <div class="col-6" hidden>
                                    <a data-toggle="modal" data-target="#todayAppointmentModal">
                                        <div class="card comp-card bg-c-green doc-pro-right ">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white">Weight</h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">65</h2>
                                                            <i class="fas fa-weight bg-c-white text-success d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white">Weight Record</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->
                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#medicalrecordModal">
                                        <div class="card comp-card bg-c-green doc-pro-right" style="height:170px">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white mb-0">Health Status</h6>

                                                        <div class="row justify-content-between align-items-center" style="margin-left:-15px;">
                                                            <a href="#" class="bpm-modal-trigger" data-toggle="modal" data-target="#addModal-datapatient">
                                                                <i class="fas fa-heartbeat text-white" >
                                                                    <span class="badge data-badge bpm-badge"></span>
                                                                </i>
                                                            </a>
                                                            
                                                            <span>
                                                            <a href="#" class="sp-modal-trigger" data-toggle="modal" data-target="#addModal-dataoxygen">

                                                                <i class="fas fa-thumbs-up mb-10" >
                                                                    <span class="badge data-badge sp-badge"></span>
                                                                </i>

                                                                </a>
                                                            </span>

                                                            <span>
                                                            <a href="" class="pi-modal-trigger" data-toggle="modal" data-target="#addModal-dataindex">

                                                            <i class="fas fa-heart mb-10">
                                                                <span class="badge data-badge stress-badge"></span>
                                                            </i>
                                                            </a>
                                                            </span>
                                                         
                                                        </div>
                                                        <p class="m-b-0 mt-3 text-white">Heart rate, Oxygen Saturation, Stress Level</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->

                            

                                <!-- ./card -->

                            </div>
                        </div>
                        <!-- ./profile details-->

                        <!-- Medicine -->

                        <div class="col-md-12 col-xl-6">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Previous Medicine</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">
                                    <div class="scroll-widget">
                                        <div class="row">
                                            <div class="col-md-12">


                                                @php $colors = ['danger', 'warning']; $counter = 0; @endphp

                                                <!-- loop medicine -->
                                                @foreach($listmedicines as $listmedicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $listmedicine->id }}" class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $listmedicine->name }}</a>

                                                <!-- increment for color -->
                                                @php $counter++; @endphp

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--chart -->

                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card" style="height:390px;">
                                <div class="card-header">
                                    <h5>Operations per Month</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="myChart" width="680" height="340" style="display: block; box-sizing: border-box; height: 272px; width: 544px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Start Table -->
                        <div class="col-md-12">


                            <div class="card table-card history">
                                <div class="card-header">
                                    <h5>History</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block p-b-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$appointment->doctor_name}}</td>
                                                    <td>{{$appointment->descs}}</td>
                                                    <td>{{$appointment->date}} {{$appointment->time}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- View Medicine Modal -->
@foreach ($listmedicines as $listmedicine)
<div class="modal fade" id="viewModal-medicine-{{ $listmedicine->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content card-outline card-border-primary">
            <div class="modal-header border-0">
                <h5 class="modal-title">Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Name</th>
                            <td>{{ $listmedicine->name }}</td>
                        </tr>
                        <tr>
                            <th>Stock left</th>
                            <td>{{ $listmedicine->stock }}</td>
                        </tr>
                        <tr>
                            <th>Price per item</th>
                            <td>RM {{ number_format($listmedicine->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $listmedicine->desc }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="modal-footer border-0" style="margin-top: -12px">
                <button type="button" class="btn btn-primary2 waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- ./ View Medicine Modal -->


<!-- Add Patient Modal -->
<div class="modal fade" id="addModal-datapatient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient BPM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Dropdown button -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="timePeriodDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Today 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="timePeriodDropdown">
                    <a class="dropdown-item bpm-dropdown-item" href="#" id="today-option">Today</a>
                    <a class="dropdown-item bpm-dropdown-item" href="#" id="week-option">This Week</a>
                    <a class="dropdown-item bpm-dropdown-item" href="#" id="month-option">This Month</a>
                    </div>
                </div>

                <!-- Content for Today -->
                <div id="today-content" class="content">
                    <canvas id="bpmChartToday"></canvas>
                </div>

                <!-- Content for This Week -->
                <div id="week-content" class="content" style="display: none;">
                    <canvas id="bpmChartWeek"></canvas>
                </div>

                <!-- Content for This Month -->
                <div id="month-content" class="content" style="display: none;">
                    <canvas id="bpmChartMonth"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- end Add Patient Modal -->

<div class="modal fade" id="addModal-dataoxygen" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient SpO2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Dropdown button -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="spo2-timePeriodDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Today 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="spo2-timePeriodDropdown">
                    <a class="dropdown-item spo2-dropdown-item" href="#" id="spo2-today-option">Today</a>
                    <a class="dropdown-item spo2-dropdown-item" href="#" id="spo2-week-option">This Week</a>
                    <a class="dropdown-item spo2-dropdown-item" href="#" id="spo2-month-option">This Month</a>
                    </div>
                </div>
                <!-- Content for Today -->
              
                <div id="spo2-today-content" class="content">
                    <canvas id="spChartToday"></canvas>
                </div>

                <!-- Content for This Week -->
                <div id="spo2-week-content" class="content" style="display: none;">
                    <canvas id="spChartWeek"></canvas>
                </div>

                <!-- Content for This Month -->
                <div id="spo2-month-content" class="content" style="display: none;">
                    <canvas id="spChartMonth"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addModal-dataindex" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient PI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Dropdown button -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="pi-timePeriodDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Today 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="spo2-timePeriodDropdown">
                    <a class="dropdown-item pi-dropdown-item" href="#" id="pi-today-option">Today</a>
                    <a class="dropdown-item pi-dropdown-item" href="#" id="pi-week-option">This Week</a>
                    <a class="dropdown-item pi-dropdown-item" href="#" id="pi-month-option">This Month</a>
                    </div>
                </div>
                <!-- Content for Today -->
              
                <div id="pi-today-content" class="content">
                    <canvas id="piChartToday"></canvas>
                </div>

                <!-- Content for This Week -->
                <div id="pi-week-content" class="content" style="display: none;">
                    <canvas id="piChartWeek"></canvas>
                </div>

                <!-- Content for This Month -->
                <div id="pi-month-content" class="content" style="display: none;">
                    <canvas id="piChartMonth"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- end Add Patient Modal -->

<div class="modal fade" id="addModal-pastappt" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card card-outline card-border-primary custom-thinner-outline">
            <div class="modal-header hr-0">
                <h5 class="modal-title">Past Appointments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <table id="dataTable-1" class="table table-bordered" style="width: 100%">
                     <thead style="text-align: center;">
                        <tr>
                            <th>#</th>
                            <th>Doctor</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                        <tbody style="text-align: center;">
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$appointment->doctor_name}}</td>
                                    <td>{{ ucfirst($appointment->descs) }}</td>
                                    <td>{{$appointment->date}} {{$appointment->time}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                </table>
            </div>
            
            <div class="modal-footer hr-0">
                <button type="button" class="btn btn-primary2 waves-effect " data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<!-- end Add Patient Modal -->
@endforeach

@include('doctor.includes.dtScripts')

<script>

    const ctx = document.getElementById('myChart');
    //const label = Utils.months({count: 7});

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                    label: "New",
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#4099ff',
                    backgroundColor: '#4099ff'
                },

            ]
        }
    })

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
        }
    })

    

</script>

@php
    $titles = [
        1 => "Past Appointments",
    ];
@endphp

<script type="text/javascript">
    $(document).ready(function () {
        @for ($i = 1; $i <= 4; $i++)
            @if (isset($titles[$i]))
                var title = "{{ $titles[$i] }}";

                var table = $('#dataTable-{{ $i }}').DataTable({
                    responsive: true,
                    autoWidth: true,
                    "dom": 'Bfrtip',
                    "buttons": [
                        {
                            extend: 'print',
                            title: title,
                            customize: function(win) {
                                $(win.document.body).find('h1').css('text-align', 'center');
                                $(win.document.body).find('h1').css('margin', '50px 0');
                                $(win.document.body).find('h1').css('font-size', '30px');
                            }
                        },
                        {
                            extend: 'pdf',
                            title: title
                        },
                        {
                            extend: 'excel',
                            title: title
                        },
                    ],
                });

                table.buttons().container().appendTo('#breezeBasicTable .row.col-md-6:eq(0)');
            @endif
        @endfor
    });
</script>

<script>
// Function to display BPM data for today in a chart and open the modal
function displayBpmDataToday(userType) {
    // Initial chart creation
    const ctx = document.getElementById('bpmChartToday').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Heart Rate',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Patient BPM Chart (Today)'
                }
            }
        },
    });

    // Function to update chart data
    function updateChart(response) {
        if (response.status === 'success') {
            var datas = response.data.map(entry => entry.bpm);
            var datasy = response.data.map(entry => entry.Date_created);

            // Update the chart data
            myChart.data.labels = datasy;
            myChart.data.datasets[0].data = datas;
            myChart.update();
        } else {
            // Handle error
        }
    }

    // Make an AJAX request to fetch BPM data for today
    function fetchData() {
        console.log('AJAX URL:', url); // Add this line for debugging

        $.ajax({
            url: '/' + userType + '/getBpmData',
            method: 'GET',
            data: {
                timePeriod: 'today',
            },
            success: updateChart,
            error: function (xhr, status, error) {
                // Handle AJAX error
                console.error('AJAX Error: ' + status, error);
            }
        });
    }

    // Display initial data
    fetchData();

    // Set interval to update the chart every second
    setInterval(fetchData, 1000);

    // Show the modal containing the chart
    $('#addModal-datapatient').modal('show');
}

// Function to display BPM data for the current week in a chart and open the modal
function displayBpmDataWeek(userType) {
    // Make an AJAX request to fetch BPM data for the current week
    $.ajax({
        url: '/' + userType + '/getBpmData', // Assuming the user type is passed as a parameter
        method: 'GET',
        data: {
            timePeriod: 'week',
        },
        success: function (response) {
            if (response.status === 'success') {
                var datas = response.data.map(entry => entry.bpm);
                var datasy = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('bpmChartWeek').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: datasy,
                        datasets: [{
                            label: 'Heart Rate',
                            data: datas,
                            borderColor: 'rgba(0, 123, 255, 1)', // Change color to primary (blue)
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient BPM Chart (This Week)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-datapatient').modal('show');
            } else {
                
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

function displayBpmDataMonth(userType) {
    // Make an AJAX request to fetch BPM data for the current week
    $.ajax({
        url: '/' + userType + '/getBpmData', // Assuming the user type is passed as a parameter
        method: 'GET',
        data: {
            timePeriod: 'month',
        },
        success: function (response) {
            if (response.status === 'success') {
                var datas = response.data.map(entry => entry.bpm);
                var datasy = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('bpmChartMonth').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: datasy,
                        datasets: [{
                            label: 'Heart Rate',
                            data: datas,
                            borderColor: 'rgba(40, 167, 69, 1)', // Change color to success/green
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient BPM Chart (This Month)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-datapatient').modal('show');
            } else {
              
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

$('.bpm-modal-trigger').click(function () {
    // Hide all content
    $('.content').hide();

    // Show the content for Today
    $('#today-content').show();

    // Trigger your function to display BPM data for Today
    displayBpmDataToday('admin');
    displayBpmDataToday('doctor');
    displayBpmDataToday('nurse');


    // Open the modal
    $('#addModal-datapatient').modal('show');

    // Set the default dropdown option to "Today"
    $('#timePeriodDropdown').text('Today');
    $('#timePeriodDropdown').data('selected-option-id', 'today');

    // Trigger a click event on the "Today" dropdown item to make it selected by default
    $('#today-option').click();
});

// Handle dropdown item click events
$('.bpm-dropdown-item').on('click', function () {
    var selectedText = $(this).text();
    $('#timePeriodDropdown').text(selectedText);

    // Store the selected option ID in the data attribute
    var selectedOptionId = $(this).attr('id').replace('-option', '');
    $('#timePeriodDropdown').data('selected-option-id', selectedOptionId);

    // Hide all content
    $('.content').hide();

    // Show the appropriate content based on the selected option
    $('#' + selectedOptionId + '-content').show();

    // Handle chart display based on user selection
    if (selectedOptionId === 'today') {
        displayBpmDataToday('admin');
        displayBpmDataToday('doctor');
        displayBpmDataToday('nurse');

    } else if (selectedOptionId === 'week') {
        displayBpmDataWeek('admin');
        displayBpmDataWeek('doctor');
        displayBpmDataWeek('nurse');

    } else if (selectedOptionId === 'month') {
        displayBpmDataMonth('admin');
        displayBpmDataMonth('doctor');
        displayBpmDataMonth('nurse');

    }

    // Open the modal
    $('#addModal-datapatient').modal('show');
});
</script>

<!-- display sp02 -->
<script>
function displaySpDataToday(userType) {
    // Make an AJAX request to fetch SpO2 data for today
    $.ajax({
        url: '/' + userType + '/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'today',
        },
        success: function (response) {
            if (response.status === 'success') {
                var spo2Data = response.data.map(entry => entry.spo2);
                var dateData = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('spChartToday').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'SpO2',
                            data: spo2Data,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient SpO2 Chart (Today)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-dataoxygen').modal('show');
            } else {
                // Handle error
                console.error('Error fetching SpO2 data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

function displaySpDataWeek(userType) {
    // Make an AJAX request to fetch SpO2 data for today
    $.ajax({
        url: '/' + userType + '/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'week',
        },
        success: function (response) {
            if (response.status === 'success') {
                var spo2Data = response.data.map(entry => entry.spo2);
                var dateData = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('spChartWeek').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'SpO2',
                            data: spo2Data,
                            borderColor: 'rgba(0, 123, 255, 1)', // Change color to primary (blue)
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient SpO2 Chart (This Week)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-dataoxygen').modal('show');
            } else {
                // Handle error
                console.error('Error fetching SpO2 data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

function displaySpDataMonth(userType) {
    // Make an AJAX request to fetch SpO2 data for today
    $.ajax({
        url: '/' + userType + '/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'month',
        },
        success: function (response) {
            if (response.status === 'success') {
                var spo2Data = response.data.map(entry => entry.spo2);
                var dateData = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('spChartMonth').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'SpO2',
                            data: spo2Data,
                            borderColor: 'rgba(40, 167, 69, 1)', // Change color to success/green
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient SpO2 Chart (This Month)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-dataoxygen').modal('show');
            } else {
                // Handle error
                console.error('Error fetching SpO2 data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}



$('.sp-modal-trigger').click(function () {
    // Hide all content
    $('.content').hide();

    // Show the content for Today
    $('#spo2-today-content').show();

    // Trigger your function to display BPM data for Today
    displaySpDataToday('admin');
    displaySpDataToday('doctor');
    displaySpDataToday('nurse');


    // Open the modal
    $('#addModal-dataoxygen').modal('show');

    // Set the default dropdown option to "Today"
    $('#spo2-timePeriodDropdown').text('Today');
    $('#spo2-timePeriodDropdown').data('selected-option-id', 'today');

    // Trigger a click event on the "Today" dropdown item to make it selected by default
    $('#spo2-today-option').click();
});

// Handle dropdown item click events
// SpO2 Today Option Click Event
$('#spo2-today-option').on('click', function () {
    handleSpo2DropdownClick('today');
});

// SpO2 Week Option Click Event
$('#spo2-week-option').on('click', function () {
    handleSpo2DropdownClick('week');
});

// SpO2 Month Option Click Event
$('#spo2-month-option').on('click', function () {
    handleSpo2DropdownClick('month');
});

function handleSpo2DropdownClick(selectedOption) {
    $('#spo2-timePeriodDropdown').text(capitalizeFirstLetter(selectedOption));
    $('#spo2-timePeriodDropdown').data('selected-option-id', selectedOption);

    // Hide all content
    $('.content').hide();

    // Show the appropriate content based on the selected option
    $('#spo2-' + selectedOption + '-content').show();

    // Handle chart display based on user selection
    if (selectedOption === 'today') {
        displaySpDataToday('admin');
        displaySpDataToday('doctor');
        displaySpDataToday('nurse');

    } else if (selectedOption === 'week') {
        displaySpDataWeek('admin');
        displaySpDataWeek('doctor');
        displaySpDataWeek('nurse');

    } else if (selectedOption === 'month') {
        displaySpDataMonth('admin');
        displaySpDataMonth('doctor');
        displaySpDataMonth('nurse');

    }

    // Open the modal
    $('#addModal-dataoxygen').modal('show');
}


function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


</script>

<script>
    function displayPiDataToday(userType) {
    // Make an AJAX request to fetch SpO2 data for today
    $.ajax({
        url: '/' + userType + '/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'today',
        },
        success: function (response) {
            if (response.status === 'success') {
                var piData = response.data.map(entry => entry.pi);
                var dateData = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('piChartToday').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'Pi',
                            data: piData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient Pi Chart (Today)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-dataindex').modal('show');
            } else {
                // Handle error
                console.error('Error fetching Pi data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

function displayPiDataWeek(userType) {
    // Make an AJAX request to fetch SpO2 data for today
    $.ajax({
        url: '/' + userType + '/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'week',
        },
        success: function (response) {
            if (response.status === 'success') {
                var piData = response.data.map(entry => entry.pi);
                var dateData = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('piChartWeek').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'Pi',
                            data: piData,
                            borderColor: 'rgba(0, 123, 255, 1)', // Change color to primary (blue)
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient Pi Chart (This Week)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-dataindex').modal('show');
            } else {
                // Handle error
                console.error('Error fetching Pi data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

function displayPiDataMonth(userType) {
    // Make an AJAX request to fetch SpO2 data for today
    $.ajax({
        url: '/' + userType + '/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'month',
        },
        success: function (response) {
            if (response.status === 'success') {
                var piData = response.data.map(entry => entry.pi);
                var dateData = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('piChartMonth').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dateData,
                        datasets: [{
                            label: 'Pi',
                            data: piData,
                            borderColor: 'rgba(40, 167, 69, 1)', // Change color to success/green
                            borderWidth: 2,
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Patient Pi Chart (This Month)'
                            }
                        }
                    },
                });

                // Show the modal containing the chart
                $('#addModal-dataindex').modal('show');
            } else {
                // Handle error
                console.error('Error fetching Pi data:', response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

$('.pi-modal-trigger').click(function () {
    // Hide all content
    $('.content').hide();

    // Show the content for Today
    $('#pi-today-content').show();

    // Trigger your function to display BPM data for Today
    displayPiDataToday('admin');
    displayPiDataToday('doctor');
    displayPiDataToday('nurse');


    // Open the modal
    $('#addModal-dataindex').modal('show');

    // Set the default dropdown option to "Today"
    $('#pi-timePeriodDropdown').text('Today');
    $('#pi-timePeriodDropdown').data('selected-option-id', 'today');

    // Trigger a click event on the "Today" dropdown item to make it selected by default
    $('#pi-today-option').click();
});

// Handle dropdown item click events
// SpO2 Today Option Click Event
$('#pi-today-option').on('click', function () {
    handlePiDropdownClick('today');
});

// SpO2 Week Option Click Event
$('#pi-week-option').on('click', function () {
    handlePiDropdownClick('week');
});

// SpO2 Month Option Click Event
$('#pi-month-option').on('click', function () {
    handlePiDropdownClick('month');
});

function handlePiDropdownClick(selectedOption) {
    $('#pi-timePeriodDropdown').text(capitalizeFirstLetter(selectedOption));
    $('#pi-timePeriodDropdown').data('selected-option-id', selectedOption);

    // Hide all content
    $('.content').hide();

    // Show the appropriate content based on the selected option
    $('#pi-' + selectedOption + '-content').show();

    // Handle chart display based on user selection
    if (selectedOption === 'today') {
        displayPiDataToday('admin');
        displayPiDataToday('doctor');
        displayPiDataToday('nurse');

    } else if (selectedOption === 'week') {
        displayPiDataWeek('admin');
        displayPiDataWeek('doctor');
        displayPiDataWeek('nurse');

    } else if (selectedOption === 'month') {
        displayPiDataMonth('admin');
        displayPiDataMonth('doctor');
        displayPiDataMonth('nurse');

    }

    // Open the modal
    $('#addModal-dataindex').modal('show');
}


function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


</script>

<script>
    function updateBadges(userType) {
        // Make an AJAX request
        $.ajax({
            url: '/' + userType + '/getLatestData',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log("AJAX Success:", response);

                if (response.status === 'success') {
                    // Update content inside the BPM badge
                    $('.bpm-badge').text(response.data.latestBpm + ' bpm');

                    // Update content inside the Spo2 badge
                    $('.sp-badge').text(response.data.latestSpo2 + ' SpO2');

                    $('.stress-badge').text(response.data.latestPi + ' Pi');

                } else {
                    // Handle error or no data scenario
                    $('.bpm-badge').text('N/A');
                    $('.sp-badge').text('N/A');
                    $('.stress-badge').text('N/A');

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle AJAX error
                console.error("AJAX Error:", textStatus, errorThrown);
                console.log("Response Text:", jqXHR.responseText);

              
            }
        });
    }

    // Call the function when needed for different user types
    updateBadges('admin');
    updateBadges('doctor');
    updateBadges('nurse');
</script>





