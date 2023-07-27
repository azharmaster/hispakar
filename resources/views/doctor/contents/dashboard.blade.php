@extends('layouts.doctor')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Welcome, Doctor {{ $name }}!</h5>
                        <span>Current room: {{ $roomName }}</span>
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
    
                        <div class="col-md-4">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Appointments</h6>
                                            <h3 class="f-w-700 text-c-blue"> {{ $totalApt }}</h3>
                                            <p class="m-b-0">Last Updated: {{ $timeDifference }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check bg-c-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Patients</h6>
                                            <h3 class="f-w-700 text-c-green">{{ $totalPatient }}</h3>
                                            <p class="m-b-0">Last Updated: {{ $timePDifference }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plus-square bg-c-green"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Nurses</h6>
                                            <h3 class="f-w-700 text-c-red">{{ $totalNurse }}</h3>
                                            <p class="m-b-0">Last Updated: {{ $timeNDifference }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-home bg-c-red"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="card new-cust-card">
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
    
                                <div class="card-block">
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
                                                <a href="/doctor/appointmentList">
                                                <img src="{{ Auth::user()->image ? asset('storage/profilePic/' . Auth::user()->image) : asset('files/assets/images/profilePic/unknown.jpg') }}" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                    <div class="d-inline-block">
                                                        <h6>{{ $aptD->name }}</h6>
                                                        <p class="text-muted m-b-0">Consultation</p>
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
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Start Table -->
                        <!-- <div class="col-md-6">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>To Be Approved</h5>
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
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Haley Kennedy</td>
                                                    <td>24/6/23-10:30</td>
                                                    <td>Follow up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>24/6/23-11:00</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>24/6/23-11:30</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jena Gaines</td>
                                                    <td>24/6/23-12:00</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Quinn Flynn</td>
                                                    <td>24/6/23-12:30</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- End table -->
    
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card  custom-card" style="height: 400px;">
                                <div class="card-header">
                                    <h5>Appointment Attendance Statistics</h5>
                                </div>
                                <div class="card-block p-4">
                                    <div style="width: 440px; height: 280px; margin: auto;">
                                        <canvas id="chartAttendance"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
    
    
                        <div class="col-md-12 col-xl-6">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Patients by Gender</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row p-t-10 p-b-10">
                                        
                                        <div class="col">
                                            <canvas id="chartByGender" style="max-width: 100px"></canvas>
                                        </div>
                                        <!-- col -->
                                        
                                        <div class="col mt-3">
                                            <div>
                                                <div class="d-flex justify-content-between mr-4">
                                                    <i class="fas fa-male mr-2 text-primary" style="font-size:  21px"></i> {{ $totalmale }}
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-between mr-4">
                                                    <i class="fas fa-female mr-2" style="font-size:  21px; color: #FF69B4;"></i> {{ $totalfemale }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->
                                    </div>
                                </div>
                            </div>
                        <!--card -->
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card " style="height: 400px;">
                                <div class="card-header">
                                    <h5>Patients by Age</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="chartByAge"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <!-- Med Supply -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card latest-update-card card-outline card-border-primary custom-thinner-outline"  style="height: 450px">
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
                                        <a href="/doctor/medicines" class="btn btn-primary2 waves-effect" data-dismiss="modal">See All</a>
                                    </div>
                                </div>
                                <!-- End card block-->
                            </div>
                            <!-- End card -->
                        </div>   
                        <!-- End col Med Supply -->
    

                        <!-- Calendar -->
                        <div class="col-xl-8 col-md-12 ">
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
    
    
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="styleSelector">
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