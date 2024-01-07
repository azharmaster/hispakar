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
                                                            <a type="button" data-toggle="modal" data-target="#addModal-pastappt"><i class="fas fa-file-alt bg-c-white text-primary d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i></a>
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
                                                            <a href="#" data-toggle="modal" data-target="#addModal-datapatient">
                                                                <i class="fas fa-heartbeat text-white" >
                                                                    <span class="badge data-badge bpm-badge">90 bpm</span>
                                                                </i>
                                                            </a>
                                                            
                                                            <span>

                                                            <i class="fas fa-thumbs-up mb-10" >
                                                                <span class="badge data-badge sp-badge">90 SpO2</span>
                                                            </i>
                                                            </span>

                                                            <span>
                                                            <i class="fas fa-heart mb-10">
                                                                <span class="badge data-badge stress-badge">Low</span>
                                                            </i>
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
                        <a class="dropdown-item" href="#" id="today-option">Today</a>
                        <a class="dropdown-item" href="#" id="week-option">This Week</a>
                        <a class="dropdown-item" href="#" id="month-option">This Month</a>
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


<!-- Add Patient Modal -->
<div class="modal fade" id="addModal-datapatient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
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
                        Select Time Period
                    </button>
                    <div class="dropdown-menu" aria-labelledby="timePeriodDropdown">
                        <a class="dropdown-item" href="#" id="today-option">Today</a>
                        <a class="dropdown-item" href="#" id="week-option">This Week</a>
                        <a class="dropdown-item" href="#" id="month-option">This Month</a>
                    </div>
                </div>

                <!-- Content for Today -->
                <div id="today-content" class="content" style="display: none;">
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

// $.ajax({
//   url: 'https://api.fitbit.com/1/user/-/activities/heart/date/2023-10-17/1d.json',
//   crossDomain: true,
//   headers: {
//     'accept': 'application/json',
//     'authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMjdHNUwiLCJzdWIiOiJCUkRERzkiLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJ3aHIgd251dCB3cHJvIHdzbGUgd2VjZyB3c29jIHdhY3Qgd294eSB3dGVtIHd3ZWkgd2NmIHdzZXQgd3JlcyB3bG9jIiwiZXhwIjoxNjk3NjQ2NDg0LCJpYXQiOjE2OTc1NjAwODR9.DBzPrnSoU8pnSec72rerOkUfhHegvPzZRVfzilDhUgM'
//   }
// }).done(function(response) {
//   console.log(response);
// });

var d = (new Date()).toISOString().split('T')[0];
console.log(d);
$.ajax({
  url: 'https://api.fitbit.com/1/user/-/activities/heart/date/2023-10-17/1d.json',
  crossDomain: true,
  headers: {
    'accept': 'application/json',
    'authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMjdHNUwiLCJzdWIiOiJCUkRERzkiLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJ3aHIgd251dCB3cHJvIHdzbGUgd2VjZyB3c29jIHdhY3Qgd294eSB3dGVtIHd3ZWkgd2NmIHdzZXQgd2xvYyB3cmVzIiwiZXhwIjoxNzAyNTI2NzYyLCJpYXQiOjE3MDI0NDAzNjJ9.q_tdbcegG1VwQlFsGqtgcyRJtNjlyqIz3fGO4HNp5Zs'
  }
}).done(function(response) {

    
  var data1 = response['activities-heart-intraday']['dataset'];
  data1 = data1.slice(-10);
  console.log(data1);
  
  console.log(data1[data1.length-1]['time']);

  var datax1 = data1[0]['value'];
  var datax2 = data1[1]['value'];
  var datax3 = data1[2]['value'];
  var datax4 = data1[3]['value'];
  var datax5 = data1[4]['value'];
  var datax6 = data1[5]['value'];
  var datax7 = data1[6]['value'];
  var datax8 = data1[7]['value'];
  var datax9 = data1[8]['value'];
  var datax10 = data1[9]['value'];

  var datay1 = data1[0]['time'];
  var datay2 = data1[1]['time'];
  var datay3 = data1[2]['time'];
  var datay4 = data1[3]['time'];
  var datay5 = data1[4]['time'];
  var datay6 = data1[5]['time'];
  var datay7 = data1[6]['time'];
  var datay8 = data1[7]['time'];
  var datay9 = data1[8]['time'];
  var datay10 = data1[9]['time'];
    
    var datas = [datax1,datax2,datax3,datax4,datax5,datax6,datax7,datax8,datax9,datax10];
    var datasy = [datay1,datay2,datay3,datay4,datay5,datay6,datay7,datay8,datay9,datay10];


    const ctx3 = document.getElementById('myChart3');

new Chart(ctx3, {
    type: 'line',
    data: {
        labels: datasy,
        datasets: [{
            label: 'Heart Rate',
            data: datas,
        },
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
                text: 'Data Patient'
            }
        }
    },
});

});


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
function displayBpmDataToday() {
    // Make an AJAX request to fetch BPM data for today
    $.ajax({
        url: '/admin/getBpmData',
        method: 'GET',
        data: {
            timePeriod: 'today',
        },
        success: function (response) {
            if (response.status === 'success') {
                var datas = response.data.map(entry => entry.bpm);
                var datasy = response.data.map(entry => entry.Date_created);

                const ctx = document.getElementById('bpmChartToday').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: datasy,
                        datasets: [{
                            label: 'Heart Rate',
                            data: datas,
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

                // Show the modal containing the chart
                $('#addModal-datapatient').modal('show');
            } else {
                // Handle error
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

// Click event for the icon
$('a[data-toggle="modal"]').click(function () {
    // Show the content for Today
    $('#today-content').show();
    // Trigger your function to display BPM data for Today
    displayBpmDataToday();
    // Open the modal
    $('#addModal-datapatient').modal('show');
});



// Function to display BPM data for the current week in a chart and open the modal
function displayBpmDataWeek() {
    // Make an AJAX request to fetch BPM data for the current week
    $.ajax({
        url: '/admin/getBpmData', // Update this route to your BPM data endpoint
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
                // Handle error
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}

function displayBpmDataMonth() {
    // Make an AJAX request to fetch BPM data for the current week
    $.ajax({
        url: '/admin/getBpmData', // Update this route to your BPM data endpoint
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
                // Handle error
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error('AJAX Error: ' + status, error);
        }
    });
}


$(document).ready(function () { 

// Handle dropdown item click events
$('#today-option').click(function () {
    // Hide all content
    $('.content').hide();
    // Show the content for Today
    $('#today-content').show();
    // Trigger your function to display BPM data for Today
    displayBpmDataToday();
    // Open the modal
    $('#addModal-datapatient').modal('show');
});

$('#week-option').click(function () {
    // Hide all content
    $('.content').hide();
    // Show the content for This Week
    $('#week-content').show();
    // Trigger your function to display BPM data for This Week
    displayBpmDataWeek();
    // Open the modal
    $('#addModal-datapatient').modal('show');
});

$('#month-option').click(function () {
    // Hide all content
    $('.content').hide();
    // Show the content for This Month
    $('#month-content').show();
    // Trigger your function to display BPM data for This Month
    displayBpmDataMonth();
    // Open the modal
    $('#addModal-datapatient').modal('show');
});
});

// Update dropdown text based on user selection
$('.dropdown-item').on('click', function () {
var selectedText = $(this).text();
$('#timePeriodDropdown').text(selectedText);

// Handle chart display based on user selection
if ($(this).attr('id') === 'today-option') {
    displayBpmDataToday();
} else if ($(this).attr('id') === 'week-option') {
    displayBpmDataWeek();
} else if ($(this).attr('id') === 'month-option') {
    displayBpmDataMonth();
}

// Open the modal
$('#addModal-datapatient').modal('show');
});


</script>



