@extends('layouts.admin')

@section('content')

<!-- script for chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- css for radial chart / chart patient by gender -->
<link rel="stylesheet" href="{{ asset('files/assets/pages/chart/radial/css/radial-1.css') }}" type="text/css" media="all">

<!-- Include the FullCalendar library -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<!-- Start Content -->
<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>WELCOME ADMIN</h5>
                        <span>Welcome to admin</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
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

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/doctorList"><div class="card prod-p-card card-b-primary">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Doctors</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totaldoc}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-md text-white" style="margin-top: 15px; background-color: #4099FF"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-primary m-r-10">+{{$totaldoc2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/nurseList"><div class="card prod-p-card card-b-danger">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Nurses</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totalnurse}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-nurse text-white" style="margin-top: 15px; background-color: #FF5370"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-danger m-r-10">+{{$totalnurse2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/patientList"><div class="card prod-p-card card-b-success">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Patients</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totalpatient}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-injured text-white" style="margin-top: 15px; background-color: #2ED8B6"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-success m-r-10">+{{$totalpatient2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/departmentList"><div class="card prod-p-card card-b-info">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Departments</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totaldept}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-building text-white" style="margin-top: 15px; background-color: #00BCD4"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-info m-r-10">+{{$totaldept2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/medicineList"><div class="card prod-p-card card-b-primary">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Medicines</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totalmedicine}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tablets text-white" style="margin-top: 15px; background-color: #4099FF"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-primary m-r-10">+{{$totalmedicine2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/roomList"><div class="card prod-p-card card-b-danger">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Rooms</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totalroom}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clinic-medical text-white" style="margin-top: 15px; background-color: #FF5370"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-danger m-r-10">+{{$totalroom2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/appointmentList"><div class="card prod-p-card card-b-success">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Appoiments</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totalapt}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check text-white" style="margin-top: 15px; background-color: #2ED8B6"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-success m-r-10">+{{$totalapt2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->

                        <div class="col-xl-3 col-md-6">
                            <a href="/admin/serviceList"><div class="card prod-p-card card-b-info">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-10">
                                        <div class="col">
                                            <h6 class="m-b-5">Services</h6>
                                            <h2 class="m-b-0 f-w-700 mt-2">{{$totalservice}}</h2>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-stethoscope text-white" style="margin-top: 15px; background-color: #00BCD4"></i> 
                                        </div>
                                    </div>
                                    <p class="m-b-0 mt-3" style="font-size: 13px"><span class="label label-info m-r-10">+{{$totalservice2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div></a>
                        </div>
                        <!-- ./card -->
                      
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Patients by Age</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="myChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Patients by Department</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Patients by Gender</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="myChart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Med Supply -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Medicine Supply</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i
                                                    class="feather icon-chevron-left open-card-option"></i></li>
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
                                                @foreach($medicines as $medicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $medicine->id }}"
                                                class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $medicine->name }} {{$medicine->stock}}</a>
                                                
                                                <!-- increment for color -->
                                                @php $counter++; @endphp 
                                                
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Med Supply -->

                       

                        

                      

                        <!-- Latest Activity 
                        <div class="col-xl-4 col-md-6">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Latest Activity</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i
                                                    class="feather icon-chevron-left open-card-option"></i></li>
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
                                        <div class="latest-update-box">
                                            <div class="row p-t-20 p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-primary update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Rescheduled appointment</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!"
                                                            class="text-c-blue"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-primary update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Referred to specialist</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!"
                                                            class="text-c-blue"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-success update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Urgent Care</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a
                                                            href="#!" class="text-c-green"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-danger update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Your Manager Posted.</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!"
                                                            class="text-c-red"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-primary update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Showcases</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!"
                                                            class="text-c-blue"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-success update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Miscellaneous</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a
                                                            href="#!" class="text-c-green"> More</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        End Latest Activity -->

                        <!-- Calendar -->
                        <div class="col-xl-8 col-md-6 ">
                            <div class="card">
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
                        <!-- Start Table -->
                        <div class="col-md-4">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Available Doctor</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i
                                                    class="feather icon-chevron-left open-card-option"></i></li>
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
                                                    <th>Name</th>
                                                    <th>Department</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($doctors as $doctor)
                                                        @php
                                                            $currentDate = now()->format('Y-m-d');
                                                        @endphp
                                                <tr>
                                                    <td>{{$doctor->name}} </td>
                                                    <td>{{$doctor->dept_name}} </td>
                                                    <td> 
                                                        @if($doctor->available == 1)
                                                        <span class="badge badge-success">Available</span>
                                                        @else
                                                        <span class="badge badge-danger">Not Available</span>
                                                        @endif</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->




                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="styleSelector">
</div>

</div>
</div>
</div>
</div>
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
<!-- ./ View Medicine Modal -->

<!-- Script to render the calendar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($calendarEvents), // Add the events here
        });
        calendar.render();
    });
</script>

<!-- chart -->
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
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Male',
                data: {!! json_encode($maleData) !!},
            },
            {
                label: 'Female',
                data: {!! json_encode($femaleData) !!}
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
                    text: 'Chart.js Line Chart'
                }
            }
        },
    });
</script>

@endsection