@extends('layouts.patient')

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

          <!-- Start Dashboard -->
          <div class="pcoded-content">
            <div class="page-header card">
              <div class="row align-items-end">
                <div class="col-lg-8">
                  <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                      <h5>Welcome, {{$name}}!</h5>
                      <span>Are you feeling great today?</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                      <li class="breadcrumb-item">
                        <a href="/patient/dashboard">
                          <i class="feather icon-home"></i>
                        </a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="/patient/dashboard">Dashboard</a>
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
                    <div class="col-md-4">
                          <div class="card comp-card" style="height:140px">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col">
                                  <h6 class="m-b-25"> Queue No.</h6>
                                @if ($aptDs->isEmpty())
                                    <h4 class="f-w-700 text-c-green">N/A</h4>
                                @else
                                    @foreach ($aptDs as $aptD)
                                        <h4 class="f-w-700 text-c-green">{{ $aptD->queueid }}</h4>
                                    @endforeach
                                @endif

                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-user-friends bg-c-green" style="margin-top: 22px;"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-4" >
                          <div class="card comp-card">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col">
                                  <h6 class="m-b-25">Room</h6>
                                  @if ($aptDs->isEmpty())
                                    <h4 class="f-w-700 text-c-green">N/A</h4>
                                  @else
                                  @foreach ($aptDs as $aptD)
                                      <h4 class="f-w-700 text-c-yellow">{{ $aptD->room_name ?? 'N/A' }}</h4>

                                  @endforeach
                                  @endif
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-door-open bg-c-yellow"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                          <div class="card comp-card" style="height:140px">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col">
                                  <h6 class="m-b-25">Upcoming Appointment</h6>
                                  <h4 class="f-w-700 text-c-blue"><div id="countdown"></div></h4>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-calendar-check bg-c-blue"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-md-4" hidden>
                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Days to Appointment</h6>
                                <h4 class="f-w-700 text-c-green"><div id="countdownday"></div></h4>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-solid fa-bell bg-c-green"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4" hidden>
                        <a title="Confirmation Appointment" data-toggle="modal" data-target="#viewAptModal">
                          <div class="card comp-card">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col">
                                  <h6 class="m-b-25"> Next Apppointment</h6>
                                  <h4 class="f-w-700 text-c-red">To be confirmed</h4>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-solid fa-stethoscope bg-c-red"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-md-4">
                      @foreach($listDoctors as $listDoctor)
                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Your Doctor</h6>
                                <div class="row align-items-center">
                                  <div class="col-auto">
                                    <!-- <img src="{{ $listDoctor->image ? asset('storage/profilePic/' . $listDoctor->image) : asset('files/assets/images/profilePic/unknown.jpg') }}" class="img-radius" style="width: 90px; height: 90px;"> -->
                                    <!-- <img src="{{ asset('storage/profilePic/avatar-4-1.jpg') }}" class="img-radius" style="width: 90px; height: 90px;"> -->
                                    <img src="https://png.pngtree.com/png-vector/20230903/ourmid/pngtree-man-avatar-isolated-png-image_9935818.png" class="img-radius" style="width: 90px; height: 90px;">

                                    
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5">{{$listDoctor->name}} </h6>
                                    <p class="m-b-5">Contact: {{$listDoctor->phoneno}}</p>
                                    <h6 class="m-b-25"><span class="badge badge-primary">{{$listDoctor->dept_name}}</span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Your Data</h6>
                                <div class="row align-items-center">
                                  @foreach($detailpatients as $detailpatient)
                                  @php
                                  
                                  $Height=$detailpatient->height;
                                  $HeightUnit='centimeter'; //inch foot meter
                                  $Weight=$detailpatient->weight;
                                  $WeightUnit='kilogram'; //pound

                                  $HInches = ($HeightUnit=='centimeter')?$Height*0.393701:(($HeightUnit=='foot')?$Height*12:(($HeightUnit=='meter')?$Height*39.3700787:$Height));
                                  
                                  $WPound = ($WeightUnit=='kilogram')?$Weight*2.2:$Weight;
                                  $BMIIndex = round($WPound/($HInches*$HInches)* 703,2);

                                 
                                  if ($BMIIndex < 18.5) {
                                    $Message="Underweight";
                                  } else if ($BMIIndex <= 24.9) {
                                    $Message="Normal";
                                  } else if ($BMIIndex <= 29.9) {
                                    $Message="Overweight";
                                  } else {
                                    $Message="Obese";
                                  }
                                  @endphp
                                  <div class="col">
                                    <h6 class="m-b-7"><span class="data-label">Weight</span><br> <span class="font-weight-bold">{{$detailpatient->weight}} kg</span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">Height</span><br> <span class="font-weight-bold">{{$detailpatient->height}} cm</span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">BMI</span><br> <span class="font-weight-bold">{{$Message}}</span></span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">Blood</span><br> <span class="font-weight-bold">{{$detailpatient->bloodtype}}</span></h6>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>

                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Live Data</h6>
                                <div class="row align-items-center">
                                  <div class="col">
                                  <h6 class="m-b-5"><span class="data-label">Sp02</span><br> <span class="font-weight-bold"><span class="badge data-badge blood-badge" id="spo2Span">%</span></span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">Heart Rate</span><br> <span class="font-weight-bold"><span class="badge data-badge height-badge" id="bpmSpan"></span></span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">PI</span><br> <span class="font-weight-bold"><span class="badge data-badge badge-warning" id="piSpan"></span></span></h6>
                                  
                                    <!-- <span id="bpmSpan"></span><br>
<span id="spo2Span"></span><br>
<span id="piSpan"></span><br>
<span id="dateSpan"></span><br> -->
                                  </div>
                                  
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>

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
                                    <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $listmedicine->id }}"
                                    class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $listmedicine->name }}</a>
                                    
                                    <!-- increment for color -->
                                    @php $counter++; @endphp 
                                    
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    

                       <!-- Calendar -->
                       <div class="col-xl-8 col-md-12 ">
                        <div class="card">
                            <div class="card-header">
                            <h5 class="m-b-5">Doctor's Appointments</h5>
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

                      <div class="col-xl-8 col-md-12 ">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Data Patient</h5>
                                </div>
                                <div class="card-block">
                                <canvas id="bpmChartToday"></canvas>
                                </div>
                            </div>
                        </div>

                      <!-- Latest Activity -->
                      <div class="col-xl-4 col-md-6">
                        <div class="card latest-update-card">
                          <div class="card-header">
                            <h5>Notification</h5>
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
                              <div class="latest-update-box">
                              @foreach($notify as $notify)
                                <div class="row p-t-20 p-b-30">
                                  <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-primary update-icon ring"></i>
                                  </div>
                                  <div class="col p-l-5">
                                    <a href="#!"><h6>Rescheduled appointment</h6><a href="#!" class="text-c-blue"> More</a></a>
                                  </div>
                                </div>
                               @endforeach
                                
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Latest Activity -->

                      <!-- Start Table -->
                      <div class="col-md-8">
                      

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
                                  <th>Doctor</th>
                                  <th>Description</th>
                                  <th>Service</th>
                                  <th>Date</th>
                                </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                @foreach ($appointments as $appointment)
                                  <tr>
                                    <td>{{$appointment->doctor_name}}</td>
                                    <td>{{$appointment->descs}}</td>
                                    <td>{{$appointment->type_service}}</td>
                                    <td>{{$appointment->date}} {{$appointment->time}}</td>
                                  </tr>
                                @endforeach

                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      <!-- </div> -->
                      </div>
                      <!-- End table -->

                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="styleSelector"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- View Appointment form -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">View Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-5">
                <img class="img-fluid" src="{{ asset('files/assets/images/V1375_generated.jpg') }}" width="350px" >
              </div>
              <div class="col-7">
                <table border="0" style="font-size: 25px;">
                @foreach($aptlatests as $aptlatest)
                  <tr>
                    <td>Doctor </td>
                    <td>:</td>
                    <td class="text-uppercase"> {{$aptlatest->doctor_name}}</td>
                  </tr>
                  <tr>
                    <td>Department </td>
                    <td>:</td>
                    <td > {{$aptlatest->dept_name}}</td>
                  </tr>
                  <tr>
                    <td>Date </td>
                    <td>:</td>
                    <td> {{$aptlatest->date}}</td>
                  </tr>
                  <tr>
                    <td>Time </td>
                    <td>:</td>
                    <td> {{$aptlatest->time}}</td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end view Appointment form -->

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
                    <table class="table table-bordered table-responsive" >
                        <tr>
                          <th>Name</th>
                          <td>{{ $listmedicine->name }}</td>
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

<script>
        // Replace '{{ $countdownDate }}' with the countdown date passed from the controller
        const countdownDate = new Date('{{ $countdownDate }}').getTime();

        // Update the countdown every 1 second
        const countdownTimer = setInterval(function() {
            const now = new Date().getTime();
            const timeRemaining = countdownDate - now;

            // Calculate days, hours, minutes, and seconds
            const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            // Display the countdown
            document.getElementById('countdown').innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            document.getElementById('countdownday').innerHTML = `Countdown: ${days}d`;
            // If the countdown is over, display a message
            if (timeRemaining < 0) {
                clearInterval(countdownTimer);
                document.getElementById('countdown').innerHTML = 'Please create new appointments.';
                document.getElementById('countdownday').innerHTML = 'Please create new appointments.';
            }
        }, 1000);
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


<script>
    // Function to display BPM data for today in a chart and open the modal

    // Initial chart creation
    const ctx = document.getElementById('bpmChartToday').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'BPM',
                    data: [],
                    borderColor: 'rgba(236, 112, 99)',
                    borderWidth: 2,
                    fill: false,
                },
                {
                    label: 'SPO2',
                    data: [],
                    borderColor: 'rgba(84, 153, 199)',
                    borderWidth: 2,
                    fill: false,
                },
                {
                    label: 'PI',
                    data: [],
                    borderColor: 'rgba(88, 214, 141)',
                    borderWidth: 2,
                    fill: false,
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
                    text: 'Live Data Patient'
                }
            }
        },
    });

    // Function to update chart data
    function updateChart(response) {
        if (response.status === 'success') {
            // Consider only the last 10 entries
            var latestData = response.data.slice(-10);
            var bpmData = latestData.map(entry => entry.bpm);
            var spo2Data = latestData.map(entry => entry.spo2);
            var piData = latestData.map(entry => entry.pi);
            var datasy = latestData.map(entry => entry.Date_created);

            var latestDatas = response.data.slice(-1)[0];
        var bpmDatas = latestDatas.bpm;
        var spo2Datas = latestDatas.spo2;
        var piDatas = latestDatas.pi;
        var datasys = latestDatas.Date_created;


            // Update the chart data
            myChart.data.labels = datasy;
            myChart.data.datasets[0].data = bpmData;
            myChart.data.datasets[1].data = spo2Data;
            myChart.data.datasets[2].data = piData;
            myChart.update();

            document.getElementById('bpmSpan').innerText = 'BPM: ' + bpmDatas;
        document.getElementById('spo2Span').innerText = 'SPO2: ' + spo2Datas;
        document.getElementById('piSpan').innerText = 'PI: ' + piDatas;
        document.getElementById('dateSpan').innerText = 'Date: ' + datasys;
        } else {
            // Handle error
        }
    }
    

    // Make an AJAX request to fetch BPM data for today
    function fetchData() {
        $.ajax({
            url: '/patient/getBpmData',
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
</script>

@endsection