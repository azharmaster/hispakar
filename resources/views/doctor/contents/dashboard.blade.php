@extends('layouts.doctor')

@section('content')

@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

<!-- script for chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- css for radial chart / chart patient by gender -->
<link rel="stylesheet" href="{{ asset('files/assets/pages/chart/radial/css/radial-1.css') }}" type="text/css" media="all">

<!-- Include the FullCalendar library -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>


<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Welcome, Doctor {{ $name }}!</h5>
                        
                        <span>Room: {{ $roomName ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/doctor/dashboard"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/doctor/dashboard">Dashboard</a> </li>
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
                        <div class="col-md-4 mr-0 ml-0">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-20 f-w-600">Appointments</h6>
                                            
                                            <div class="row d-flex justify-content-between ">
                                                <h2 class="f-w-700 text-c-blue ml-3">{{ $totalApt }}</h2>
                                                <i class="fas fa-calendar-check bg-c-blue" style="margin-top: -8px; margin-right: -18px"></i>
                                            </div>
                                            
                                            <p class="m-b-0 mt-2">Last Updated: {{ $timeDifference }}</p>
                
                                        </div>
                                        <div class="col-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./card -->

                        <div class="col-md-4 mr-0 ml-0">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-20 f-w-600">Patients</h6>
                                            
                                            <div class="row d-flex justify-content-between ">
                                                <h2 class="f-w-700 text-c-green ml-3">{{ $totalPatient }}</h2>
                                                <i class="fas fa-hospital-user bg-c-green" style="margin-top: -8px; margin-right: -18px"></i>
                                            </div>
                                            
                                            <p class="m-b-0 mt-2">Last Updated: {{ $timePDifference }}</p>
            
                                        </div>
                                        <div class="col-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./card -->

                        <div class="col-md-4 mr-0 ml-0">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-20 f-w-600">Nurses</h6>
                                            
                                            <div class="row d-flex justify-content-between ">
                                                <h2 class="f-w-700 text-c-red ml-3">{{ $totalNurse }}</h2>
                                                <i class="fas fa-stethoscope bg-c-red" style="margin-top: -8px; margin-right: -18px"></i>
                                            </div>
                                            
                                            <p class="m-b-0 mt-2">Last Updated: {{ $timeNDifference }}</p>
                
                                            </div>
                                        <div class="col-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./card -->
    
                         <!-- Start Table -->
                         <!-- <div class="col-md-6">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Patient's Attendance</h5>
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
                                            <thead>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Date-Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($aptDs->isEmpty())
                                                    <tr>
                                                        <td colspan="3">No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach ($aptDs as $aptD)
                                                        <tr>
                                                            <td>{{ $aptD->name }}</td>
                                                            <td>{{ $aptD->date }} {{ $aptD->time }}</td>
                                                            <td>
                                                                @if ($aptD->status === 1)
                                                                    <span class="badge badge-success">Attend</span>
                                                                @elseif ($aptD->status === 2)
                                                                    <span class="badge badge-danger">Absent</span>
                                                                @else
                                                                    <a href="/doctor/dashboard/{{ $aptD->appointment_id }}" title="Attend Appointment" 
                                                                        data-toggle="modal" data-target="#editModal-confirm-{{ $aptD->appointment_id }}">
                                                                        <i style="font-size:20px;" class="fa fa-check-circle text-success f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                    </a>
                                                                    <a href="/doctor/cdashboard/{{ $aptD->appointment_id }}" title="Absent Appointment"
                                                                        data-toggle="modal" data-target="#absentModal-absent-{{ $aptD->appointment_id }}">
                                                                        <i style="font-size:20px;" class="fa fa-times-circle text-danger f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- End table -->

                        <!-- Today's apt -->
                        <div class="col-md-6">
                            <div class="card new-cust-card" style="height: 450px">
                                <div class="card-header">
                                    <h5>Today's Appointment / {{ $currentDate }}</h5>
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
                                <div class="scroll-widget">
                                    @php
                                        $currentTime = \Carbon\Carbon::now('Asia/Kuala_Lumpur');
                                    @endphp

                                    @if ($aptDs->isEmpty())
                                        <div class="text-center">No appointments today</div>
                                    @else
                                        @foreach ($aptDs as $aptD)
                                            @php
                                                // Convert the appointment time to Carbon objects for start and end times
                                                $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $aptD->time);
                                                $endTime = $startTime->copy()->addMinutes(30); // Assuming each appointment is 30 minutes

                                                // Check if the appointment is in the past, ongoing, or in the future
                                                $isPastAppointment = $currentTime->greaterThan($endTime);
                                                $isCurrentTimeInRange = $currentTime->between($startTime, $endTime);
                                            @endphp
                                            <div class="align-middle m-b-25">
                                                <!-- if apt status = 2 (cancel), button add apt record takde -->
                                                @if ($aptD->appointment_status == '2')
                                                    <!-- <img src="{{ $aptD->patient_image ? asset('storage/profilePic/' . $aptD->patient_image) : asset('files/assets/images/profilePic/unknown.jpg') }}" alt="user image" class="img-radius img-40 align-top m-r-15"> -->
                                                    <img src="https://img.freepik.com/premium-vector/aesthetic-cute-muslim-girl-with-hijab-flat-detailed-avatar-vector-illustration-beautiful-muslim_677428-604.jpg?w=2000" class="img-radius img-40 align-top m-r-15">

                                                    <div class="d-inline-block">
                                                        <h6>{{ $aptD->name }}</h6>
                                                        <p class="text-muted m-b-0">Consultation</p>
                                                        
                                                        @if ($aptD->appointment_status == '2')
                                                            <span class="status badge badge-danger mb-2 align-top" style="font-size: 12px;">Cancel</span>
                                                        @else
                                                            @php
                                                                // Convert the appointment time to Carbon objects for start and end times
                                                                $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $aptD->time);
                                                                $endTime = $startTime->copy()->addMinutes(30); // Assuming each appointment is 30 minutes

                                                                // Check if the appointment is in the past, ongoing, or in the future
                                                                $currentTime = \Carbon\Carbon::now('Asia/Kuala_Lumpur');
                                                                $isPastAppointment = $currentTime->greaterThan($endTime);
                                                                $isCurrentTimeInRange = $currentTime->between($startTime, $endTime);
                                                            @endphp

                                                            <button class="status btn btn-sm
                                                                @if ($isPastAppointment)
                                                                    btn-danger
                                                                @elseif ($isCurrentTimeInRange)
                                                                    btn-success
                                                                @else
                                                                    btn-warning
                                                                @endif
                                                                mb-2 align-top">
                                                                @if ($isPastAppointment)
                                                                    Appointment Passed
                                                                @elseif ($isCurrentTimeInRange)
                                                                    Now
                                                                @else
                                                                    Next: {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                                                                @endif
                                                            </button>
                                                        @endif
                                                    </div>

                                                <!-- if medrecord status = 1 (done), Dr dah siap isi medical record & akan keluar badge done -->
                                                @elseif ($aptD->medrecord_status == '1')
                                                    <!-- <img src="{{ Auth::user()->image ? asset('storage/profilePic/' . Auth::user()->image) : asset('files/assets/images/profilePic/unknown.jpg') }}" alt="user image" class="img-radius img-40 align-top m-r-15"> -->
                                                    <img src="https://img.freepik.com/premium-vector/aesthetic-cute-muslim-girl-with-hijab-flat-detailed-avatar-vector-illustration-beautiful-muslim_677428-604.jpg?w=2000" class="img-radius img-40 align-top m-r-15">

                                                        <div class="d-inline-block">
                                                            <h6>{{ $aptD->name }}</h6>
                                                            <p class="text-muted m-b-0">Consultation</p>
                                                            
                                                            <span class="status badge badge-primary mb-2 align-top" style="font-size: 12px;">Done</span>
                                                        </div>
                                                    </a>

                                                @else
                                                    <a href="/doctor/appointmentReport/{{ $aptD->appointment_id }}">
                                                    <!-- <img src="{{ Auth::user()->image ? asset('storage/profilePic/' . Auth::user()->image) : asset('files/assets/images/profilePic/unknown.jpg') }}" alt="user image" class="img-radius img-40 align-top m-r-15"> -->
                                                    <img src="https://img.freepik.com/premium-vector/aesthetic-cute-muslim-girl-with-hijab-flat-detailed-avatar-vector-illustration-beautiful-muslim_677428-604.jpg?w=2000" class="img-radius img-40 align-top m-r-15">

                                                        <div class="d-inline-block">
                                                            <h6>{{ $aptD->name }}</h6>
                                                            <p class="text-muted m-b-0">Consultation</p>
                                                            
                                                            @if ($aptD->appointment_status == '2')
                                                                <span class="status badge badge-danger mb-2 align-top" style="font-size: 12px;">Cancel</span>
                                                            @else
                                                                @php
                                                                    // Convert the appointment time to Carbon objects for start and end times
                                                                    $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $aptD->time);
                                                                    $endTime = $startTime->copy()->addMinutes(30); // Assuming each appointment is 30 minutes

                                                                    // Check if the appointment is in the past, ongoing, or in the future
                                                                    $currentTime = \Carbon\Carbon::now('Asia/Kuala_Lumpur');
                                                                    $isPastAppointment = $currentTime->greaterThan($endTime);
                                                                    $isCurrentTimeInRange = $currentTime->between($startTime, $endTime);
                                                                @endphp

                                                                <button class="status btn btn-sm
                                                                    @if ($isPastAppointment)
                                                                        btn-danger
                                                                    @elseif ($isCurrentTimeInRange)
                                                                        btn-success
                                                                    @else
                                                                        btn-warning
                                                                    @endif
                                                                    mb-2 align-top">
                                                                    @if ($isPastAppointment)
                                                                        Appointment Passed
                                                                    @elseif ($isCurrentTimeInRange)
                                                                        Now
                                                                    @else
                                                                        Next: {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                                                                    @endif
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="modal-footer border-0" style="position: absolute; bottom: 0; left: 0; right: 0;">
                                    <a href="{{ route('doctor.appointmentList', ['date' => $currentDate]) }}" class="text-mute">
                                        <i class="fas fa-bars m-r-10"></i>View More
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        <!--apt attendance statistic -->
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card  custom-card" style="height: 450px">
                                <div class="card-header">
                                    <h5>Appointment Attendance Statistics</h5>
                                </div>
                                <div class="card-block p-4">
                                    <div style="width: 410px; height: 280px; margin: auto;">
                                        <canvas id="chartAttendance"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/apt attendance statistic -->

                       
                        <div class="col-xl-4 col-md-6">
                            <!-- patient by gender -->
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Patients by Gender</h5>
                                </div>

                                <div class="card-block">
                                    <div class="row">
                                        <div class="col mb-4 text-center d-flex justify-content-center">
                                            <canvas id="chartByGender" style="max-width: 100px"></canvas>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-center">
                                            <div class="s-caption mt-2 mr-2"><i class="fas fa-female mr-2" style="font-size:  22px; color: #FF69B4;"></i></div>
                                            <div class="s-cont d-inline-block">
                                                <h5 class="f-w-700 m-b-0">{{ $totalfemale }}</h5>
                                                <p class="m-b-0">Female</p>
                                            </div>
                                        </div>
                                        <div class="col-6 b-l-default d-flex justify-content-center">
                                            <div class="s-caption mt-2 mr-2"><i class="fas fa-male mr-2 text-primary" style="font-size:  22px"></i></div>
                                            <div class="s-cont d-inline-block">
                                                <h5 class="f-w-700 m-b-0">{{ $totalmale }}</h5>
                                                <p class="m-b-0">Male</p>
                                            </div>
                                        </div>
                                        <!-- col -->
                                    </div>
                                </div>
                            </div>
                            <!-- /patient by gender -->
                            
                            <!-- medicine -->
                            <div class="card latest-update-card" style="min-height: 455px">
                                <div class="card-header">
                                    <h5>Medicine Supply</h5>
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

                                                <!-- define color -->
                                                @php $colors = ['danger', 'warning']; $counter = 0; @endphp 

                                                <!-- loop medicine -->
                                                @foreach($medicines as $medicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $medicine->id }}"
                                                class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $medicine->name }}</a>
                                                
                                                <!-- increment for color -->
                                                @php $counter++; @endphp 
                                                
                                                @endforeach

                                                <!-- dummy -->
                                                @foreach($medicines as $medicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $medicine->id }}"
                                                class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $medicine->name }}</a>
                                                <!-- increment for color -->
                                                @php $counter++; @endphp 
                                                @endforeach
                                                <!-- ./dummy -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0" style="position: absolute; bottom: 0; left: 0; right: 0;">
                                        <a href="/doctor/medicineList" class="btn btn-primary2 waves-effect" data-dismiss="modal">See All</a>
                                    </div>
                                </div>
                                <!-- End card block-->
                            </div>
                            <!-- medicine -->
                        </div>
                        <!-- End Latest Activity -->

                        <!-- <div class="col-md-12 col-xl-6">
                            <div class="card sale-card " style="height: 450px;">
                                <div class="card-header">
                                    <h5>Patients by Age</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="chartByAge"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                       
                       
                        <!-- Calendar -->
                        <div class="col-xl-8 col-md-12 ">
                            <div class="card" style="min-height: 600px">
                                <div class="card-header">
                                    <h5 class="m-b-5">Calendar</h5>
                                    <div class="card-block p-b-0">
                                        <div class="row m-b-50">
                                            <div class="col">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Calendar -->
    
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="styleSelector">
</div>

<!-- attend apt form -->
@foreach ($aptDs as $aptD)
    <div class="modal fade" id="editModal-confirm-{{ $aptD->appointment_id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure this person attend the appointment?</p>
                    <table class="table table-bordered">
                        <tr style="font-weight: bold;">
                            <td>Name</td>
                            <td>IC</td>
                        </tr>
                        <tr style="color: green;">
                            <td>{{ $aptD->name }}</td>
                            <td>{{ $aptD->ic }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">No</button>
                    <form action="/doctor/dashboard/{{ $aptD->appointment_id }}" method="POST" style="display: inline">
                        @csrf
                        <button type="submit" class="btn btn-success waves-effect waves-light">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end attend apt form -->

<!-- absent apt form -->
@foreach ($aptDs as $aptD)
    <div class="modal fade" id="absentModal-absent-{{ $aptD->appointment_id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure this person absent the appointment?</p>
                    <table class="table table-bordered">
                        <tr style="font-weight: bold;">
                            <td>Name</td>
                            <td>IC</td>
                        </tr>
                        <tr style="color: red;">
                            <td>{{ $aptD->name }}</td>
                            <td>{{ $aptD->ic }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">No</button>
                    <form action="/doctor/cdashboard/{{ $aptD->appointment_id }}" method="POST" style="display: inline">
                        @csrf
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end absent apt form -->

<!-- View Medicine Modal -->
@foreach ($medicines as $medicine)
<div class="modal fade" id="viewModal-medicine-{{ $medicine->id }}" tabindex="-1" role="dialog">
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
                    <table class="table table-bordered table-responsive" >
                        <tr>
                          <th>Name</th>
                          <td>{{ $medicine->name }}</td>
                        </tr>
                        <tr>
                          <th>Stock left</th>
                          <td>{{ $medicine->stock }}</td>
                        </tr>
                        <tr>
                          <th>Price per item</th>
                          <td>RM {{ number_format($medicine->price, 2) }}</td>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <td>{{ $medicine->desc }}</td>
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
<!-- bbh -->

<script>
  //Chart Attendance Statistic
    const currentDate = new Date();
  
    // Calculate the labels for the past five months and the current month
    const labels = [];
    for (let i = 4; i >= 0; i--) {
        const date = new Date(currentDate);
        date.setMonth(date.getMonth() - i);
        const month = date.toLocaleString('default', { month: 'long' });
        labels.push(month);
    }

    // Dummy data for the bar chart
    const barChartData = {
        labels: labels,
        datasets: [
            {
                label: 'Attend',
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)', // Add border color here
                borderWidth: 1, // Adjust border width as needed
                data: @json($totalattend), // Use the data from the controller
            },
            {
                label: 'Cancelled',
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)', // Add border color here
                borderWidth: 1, // Adjust border width as needed
                data: @json($totalcancel), // Replace this with the actual data for the past five months
            },
        ],
    };

    // Configuration options for the bar chart
    const barChartOptions = {
      barThickness: 10,
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true, // Start the y-axis from 0
          max: Math.max(...barChartData.datasets.flatMap((dataset) => dataset.data)) + 1, // Set the maximum value of the y-axis to the highest value in the data
          ticks: {
            stepSize: 1, // Display only integer values on the y-axis
          },
        },
      },
      plugins: {
        legend: {
          labels: {
            usePointStyle: true, // Use point-style icons instead of text labels
          },
        },
      },
    };

    // Create and render the bar chart
    const ctx1 = document.getElementById('chartAttendance').getContext('2d');
    const barChart = new Chart(ctx1, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions,
    });
</script>

<script>
  // Patient Pie Chart by Gender
  // Dummy data for the pie chart
  const data = {
    labels: ['Male', 'Female'],
    datasets: [{
      data: [{{ $totalmale }}, {{ $totalfemale }}], 
      backgroundColor: ['#36A2EB', '#FF6384'], // Colors for Male and Female respectively
      borderColor: '#FFFFFF', // Add border color here
      borderWidth: 3, // Adjust border width as needed
      hoverBackgroundColor: ['#2093D0', '#E8546F'], // Hover colors for Male and Female respectively
    }]
  };

  // Configuration options for the pie chart
  const options = {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false, // Hide the legend
        },
        labels: false, // Hide the labels
      },
    };

  // Create and render the pie chart
  const ctx = document.getElementById('chartByGender').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'pie',
    data: data,
    options: options,
  });

</script>

<script>
  // Chart Patient By Ages
  // Dummy data for the pie chart
  const pieChartData = {
    labels: ['0-20', '21-40', '41-60', '61+'],
    datasets: [{
      data: [{{ $children }}, {{ $teenage }}, {{ $adult }}, {{ $older }}],
      backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'],
      borderColor: '#FFFFFF', // Add border color here
      borderWidth: 3, // Adjust border width as needed
      hoverBackgroundColor: ['#2093D0', '#E8546F', '#E6C117', '#35A7A7'], // Add hover background color here
    }],
  };

  // Configuration options for the pie chart
  const pieChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          fontColor: '#333',
          fontSize: 12,
          boxWidth: 12,
        },
      },
    },
  };

  // Create and render the pie chart
  const ctx2 = document.getElementById('chartByAge').getContext('2d');
  const pieChart = new Chart(ctx2, {
    type: 'pie',
    data: pieChartData,
    options: pieChartOptions,
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($calendarEvents) // Add the events here
        });
        calendar.render();
    });
</script>

@endsection