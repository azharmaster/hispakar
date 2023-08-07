@foreach($nursedetails as $nursedetail)

<!-- script for chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Height for screens larger than 768px / for full width */
    @media screen and (min-width: 768px) {
        /* add style*/
    }
    /* Height for screens smaller than 768px / responsive smaller screen */
    @media screen and (max-width: 767px) {
        .doc-pro-right {
            height: 197px; 
        }
        .chartAttendance{
            max-width: 250px;
        }
        .chartByAge{
            margin-top: -1000px
        }
    }
    .hr-0 {
        border-bottom: none;
        border-top: none;
    }

</style>

<style>
    /* Height for screens larger than 768px */
    @media screen and (min-width: 768px) {

    }
    /* Height for screens smaller than 768px */
    @media screen and (max-width: 767px) {
        .doc-pro-right {
            height: 197px; 
        }
        .chartAttendance{
            max-width: 250px;
        }
        .chartByAge{
            margin-top: -1000px
        }
    }
    .hr-0 {
        border-bottom: none;
        border-top: none;
    }

</style>

<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Profile Nurse</h5>
                        <span>{{ ucfirst($nursedetail->name) }}'s Profile </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/admin/doctorList">Doctor Details</a> </li>
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
                        <div class="col-12 col-sm-4">
                            <div class="card" style="min-height: 320px">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 mx-auto d-block d-flex justify-content-center ">
                                            <!--profile picture -->
                                            <div class="parent-container2 " style="width: 140px; height: 140px;">
                                                <div class="pic-holder" style="background-image: url({{ $nursedetail->image ? asset('storage/profilePic/' . $nursedetail->image) : asset('files/assets/images/profilePic/unknown.jpg') }}); border: 2px solid white;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 text-center text-sm-left mt-2">
                                            <h3 class="mb-3 pt-sm-0 text-center" style="word-wrap: break-word;" >{{ ucfirst($nursedetail->name) }}</h3>
                                            <h6 class="text-center">Department of {{ ucfirst($nursedetail->dept_name) }}</h6>
                                            <hr>
                                            <h6 class="text-center"><i class="fas fa-phone mr-3 text-primary mt-1"></i>{{ $nursedetail->phoneno }}</h6>
                                            <hr>
                                            <span class="d-flex justify-content-center"><i class="far fa-envelope mr-3 text-primary "></i>{{ $nursedetail->email }}</span>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 p-0">
                            <div class="row">
                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#totalpatientModal"> 
                                    <div class="card comp-card bg-c-blue doc-pro-right">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-20 f-w-600 text-white mr-4">Total Patients </h6>
                                                
                                                <div class="row d-flex justify-content-between mt-3">
                                                <h2 class="f-w-700 text-white ml-3">{{ $totalpatient }}</h2>
                                                <i class="fas fa-hospital-user bg-c-white text-primary d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                </div>
                                                
                                                <p class="m-b-0 mt-3 text-white">Total patients</p>
                
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
                                    <a data-toggle="modal" data-target="#todayAppointmentModal">                                    
                                    <div class="card comp-card bg-c-green doc-pro-right">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-20 f-w-600 text-white">Today's Appointments</h6>
                                                
                                                <div class="row d-flex justify-content-between mt-3">
                                                <h2 class="f-w-700 text-white ml-3">{{ $totalapttoday }}</h2>
                                                <i class="fas fa-hospital bg-c-white text-success d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                </div>
                                                
                                                <p class="m-b-0 mt-3 text-white">Total today's Appointments</p>
                
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
                                    <div class="card comp-card bg-c-green doc-pro-right">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-20 f-w-600 text-white">Medical Record</h6>
                                                
                                                <div class="row d-flex justify-content-between mt-3">
                                                <h2 class="f-w-700 text-white ml-3">{{ $totalrecord }}</h2>
                                                <i class="fas fa-hospital bg-c-white text-success d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                </div>
                                                
                                                <p class="m-b-0 mt-3 text-white">Total medical records</p>
                
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
                                    <a data-toggle="modal" data-target="#nextaptModal">                                    
                                    <div class="card comp-card doc-pro-right">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-b-20 f-w-600">Next Appointment</h6>
                                                
                                                <div class="row d-flex justify-content-between mt-3">
                                                <h2 class="f-w-700 text-success ml-3">{{ $totalnextapt }}</h2>
                                                <i class="fas fa-plus bg-c-green d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                </div>
                                                
                                                <p class="m-b-0 mt-3">Upcoming appointment</p>
                
                                            </div>
                
                                            <div class="col-auto">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <!-- ./card -->
                               
                            </div>
                        </div>
                        <!-- ./profile details-->

                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card  custom-card" style="height: 400px;">
                                <div class="card-header">
                                <h5>Appointment Attendance Statistics</h5>
                                </div>
                                <div class="card-block p-4">
                                <div class="chartAttendance" style="width: 440px; height: 280px; margin: auto;">
                                    <canvas id="chartAttendance"></canvas>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./card -->

                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card" style="height: 400px;">
                                <div class="card-header">
                                    <h5>Patients by Age</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-2 justify-content-end text-right" style="margin-left: -10px"> <!-- Updated class here -->
                                            <div class="label-main">
                                                <label class="label label-inverse-primary">Children</label>
                                            </div>
                                            <div class="label-main">
                                                <label class="label label-inverse-danger">Teenage</label>
                                            </div>
                                            <div class="label-main">
                                                <label class="label label-inverse-warning">Adult</label>
                                            </div>
                                            <div class="label-main">
                                                <label class="label label-inverse-info">Older</label>
                                            </div>
                                        </div>
                                        <div class="col-9 ml-3" style="margin-top: 0px">
                                            <canvas id="chartByAge"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./card -->
                        
                        <!-- Start Table -->
                        <div class="col-md-12 col-xl-6">
                            <div class="card table-card" style="height: 450px">
                            <div class="card-header">
                            <h5>Today's Medical records</h5>
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
                            <div class="card-block p-b-0" >
                                <div class="table-responsive">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Patient</th>
                                        <th>Desciption</th>
                                        <th>Invoice</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if ( $totalrecorddetails->isEmpty() )
                                            <tr>
                                                <td colspan="4" class="text-center">No data available</td>
                                            </tr>
                                        @else
                                        <!-- this query not for today yet -->
                                            @foreach($totalrecorddetails as $apt)
                                            <tr style="text-align: center;">
                                                <td>{{ \Carbon\Carbon::parse($apt->datetime)->format('H:i:s') }}</td>
                                                <td>{{ $apt->patient->name }}</td> 
                                                <td>{{ $apt->desc }}</td>
                                                <td> 
                                                    <a href="/nurse/report/{{ $apt->id }}" title="View Medical Record">
                                                        <i style="font-size:20px;" class="icon feather icon-eye f-w-600 f-16 m-r-15  text-c-yellow "></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="modal-footer border-0" style="position: absolute; bottom: 0; left: 0; right: 0;">
                                <a href="/nurse/appointmentList" class="text-mute"><i class="fas fa-bars m-r-10"></i>View More</a>
    
                            </div>
                            </div>
                            <!-- End card -->
                        </div>
                        <!-- End col -->

                        <!-- Start Table -->
                        <div class="col-md-12 col-xl-6">
                            <div class="card table-card" style="height: 450px">
                            <div class="card-header">
                            <h5>Today's Appointments</h5>
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
                            <div class="card-block p-b-0" >
                                <div class="table-responsive">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Time</th>
                                            <th>Patient Name</th>
                                            <th>Phone No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ( $totalapttodaydetails->isEmpty() )
                                            <tr>
                                                <td colspan="4" class="text-center">No data available</td>
                                            </tr>
                                        @else
                                            @foreach($totalapttodaydetails as $apt)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $apt->time }}</td>
                                                <td>{{ $apt->patient->name }}</td>
                                                <td>{{ $apt->patient->phoneno }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="modal-footer border-0" style="position: absolute; bottom: 0; left: 0; right: 0;">
                                <a href="/nurse/appointmentList" class="text-mute"><i class="fas fa-bars m-r-10"></i>View More</a>
    
                            </div>
                            </div>
                            <!-- End card -->
                        </div>
                        <!-- End col -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Total Patient Modal -->
<div class="modal fade" id="totalpatientModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card card-outline card-border-primary custom-thinner-outline">
            <div class="modal-header hr-0">
                <h5 class="modal-title">Patient List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <table id="dataTable-1" class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalpatientdetails as $patient)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ $patient->gender }}</td>
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

<!-- today Appointment Modal -->
<div class="modal fade" id="todayAppointmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card card-outline card-border-primary custom-thinner-outline">
            <div class="modal-header hr-0">
                <h5 class="modal-title">Today's Appointment List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <table id="dataTable-2" class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Time</th>
                            <th>Patient Name</th>
                            <th>Phone No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalapttodaydetails as $apt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $apt->time }}</td>
                            <td>{{ $apt->patient->name }}</td>
                            <td>{{ $apt->patient->phoneno }}</td>
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

<!-- Medical Record Modal -->
<div class="modal fade" id="medicalrecordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card card-outline card-border-primary custom-thinner-outline">
            <div class="modal-header hr-0">
                <h5 class="modal-title">Medical Record List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <table id="dataTable-3" class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Datetime</th>
                            <th>Patient Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalrecorddetails as $apt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $apt->datetime }}</td>
                            <td>{{ $apt->patient->name }}</td>
                            <td>{{ $apt->desc }}</td>
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

<!-- Next Apt Modal -->
<div class="modal fade" id="nextaptModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content card card-outline card-border-primary custom-thinner-outline">
            <div class="modal-header hr-0">
                <h5 class="modal-title">Upcoming appointment List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <table id="dataTable-4" class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Time</th>
                            <th>Patient Name</th>
                            <th>Phone No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalnextaptdetails as $apt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $apt->time }}</td>
                            <td>{{ $apt->patient->name }}</td>
                            <td>{{ $apt->patient->phoneno }}</td>
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
                data: @json($totalcancel),
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
    // Chart Patient By Ages
    const pieChartData = {
      labels: ['0-12', '13-19', '20-64', '65+'],
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
    // Patient Donut Chart by Gender
    // Wait for the DOM content to load before initializing the chart
    document.addEventListener("DOMContentLoaded", function() {
      // Data for the donut chart
      const donutData = {
        datasets: [
          {
            data: [44, 55], // Replace these values with your data (male and female percentages)
            backgroundColor: ["#36A2EB", "#FF6384"], // Blue and Pink colors
            borderWidth: 0 // No borders
          }
        ],
        // Optional: Add labels for the tooltip
        labels: false,
      };
  
      // Options for the donut chart
      const donutOptions = {
        responsive: true,
        maintainAspectRatio: false,
        cutout: "70%", // Adjust the cutout value to control the size of the donut hole
        legend: {
          display: false // Hide legend
        }
      };
  
      // Get the canvas element and create the donut chart
      const donutChartCanvas = document.getElementById("chartByGender");
      new Chart(donutChartCanvas, {
        type: "doughnut",
        data: donutData,
        options: donutOptions
      });
    });
  </script>

<script>
    // calendar
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendarDoctor');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
    });
</script>

<!-- Include necessary JavaScript files for DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

@php
    $titles = [
        1 => "Patient List",
        2 => "Today's Appointment List",
        3 => "Medical Record List",
        4 => "Next Appointment List",
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
