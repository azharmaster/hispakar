@extends('layouts.nurse')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Start Dashboard -->
<div class="pcoded-content">
  <div class="page-header card">
      <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">
                  <i class="feather icon-home bg-c-blue"></i>
                  <div class="d-inline">
                      <h5>WELCOME NURSE</h5>
                      <span>Have a great day !</span>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="page-header-breadcrumb">
                  <ul class="breadcrumb breadcrumb-title">
                      <li class="breadcrumb-item">
                          <a href="index.html"><i class="feather icon-home"></i></a>
                      </li>
                      <li class="breadcrumb-item">
                          <a href="#!">Dashboard</a>
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

                    <div class="col-md-3 mr-0 ml-0">
                      <div class="card comp-card">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col">
                              <h6 class="m-b-20 f-w-600">Rooms</h6>
                              
                              <div class="row d-flex justify-content-between ">
                                <h2 class="f-w-700 text-c-yellow ml-3">{{ $totalroom }}</h2>
                                <i class="fas fas fa-door-open bg-c-yellow" style="margin-top: -8px; margin-right: -18px"></i>
                              </div>
                              
                              <p class="m-b-0 mt-2">Total available rooms</p>
 
                            </div>

                            <div class="col-auto">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ./card -->

                    <div class="col-md-3 mr-0 ml-0">
                      <div class="card comp-card">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col">
                              <h6 class="m-b-20 f-w-600">Patients</h6>
                              
                              <div class="row d-flex justify-content-between ">
                                <h2 class="f-w-700 text-c-green ml-3">{{ $totalpatient }}</h2>
                                <i class="fas fa-hospital-user bg-c-green" style="margin-top: -8px; margin-right: -18px"></i>
                              </div>
                              
                              <p class="m-b-0 mt-2">Total patients</p>
 
                            </div>
                            <div class="col-auto">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ./card -->

                    <div class="col-md-3 mr-0 ml-0">
                      <div class="card comp-card">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col">
                              <h6 class="m-b-20 f-w-600">Doctors</h6>
                              
                              <div class="row d-flex justify-content-between ">
                                <h2 class="f-w-700 text-c-blue ml-3">{{ $totaldoc }}</h2>
                                <i class="fas fa-stethoscope bg-c-blue" style="margin-top: -8px; margin-right: -18px"></i>
                              </div>
                              
                              <p class="m-b-0 mt-2">Total doctors</p>
 
                            </div>
                            <div class="col-auto">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ./card -->
                    
                    <div class="col-md-3 mr-0 ml-0">
                      <div class="card comp-card">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col">
                              <h6 class="m-b-20 f-w-600">Appointment</h6>
                              
                              <div class="row d-flex justify-content-between ">
                                <h2 class="f-w-700 text-c-red ml-3">{{ $totalapt }}</h2>
                                <i class="fas fa-calendar-check bg-c-red" style="margin-top: -8px; margin-right: -18px"></i>
                              </div>
                              
                              <p class="m-b-0 mt-2">Pending appointments</p>
 
                            </div>
                            <div class="col-auto">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ./card -->

                <!-- Start Table -->
                <div class="col-md-8">
                  <div class="card table-card card-outline card-border-primary custom-thinner-outline" style="height: 450px">
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
                        <table id="notOverflow" class="table table-hover m-b-0">
                          <thead>
                          <tr>
                            <th>Time</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Department</th>
                          </tr>
                          </thead>
                          <tbody>
                            @php
                              $today = now()->format('Y-m-d'); // date today
                              $todaysAppointments = $appointments->where('date', $today)->sortBy('time')->take(5);
                            @endphp

                            @if ($todaysAppointments->isEmpty())
                                <tr>
                                    <td colspan="4">No appointment today</td>
                                </tr>
                            @else
                                @foreach ($todaysAppointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->time }}</td>
                                        <td>{{ $appointment->patient->name }}</td>
                                        <td>{{ $appointment->doctor->name }}</td>
                                        <td>{{ $appointment->department->name }}</td>
                                    </tr>
                                @endforeach
                            @endif

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer border-0" style="position: absolute; bottom: 0; left: 0; right: 0;">
                      <a href="/nurse/appointmentList" class="btn btn-primary2 waves-effect" data-dismiss="modal">See All</a>
                    </div>
                  </div>
                  <!-- End card -->
                </div>
                <!-- End col -->

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
                        <a href="/nurse/medicineList" class="btn btn-primary2 waves-effect" data-dismiss="modal">See All</a>
                      </div>
                    </div>
                    <!-- End card block-->
                  </div>
                  <!-- End card -->
                </div>   
                <!-- End col Med Supply -->

                <div class="col-md-12 col-xl-6">
                  <div class="card sale-card card-outline card-border-primary custom-thinner-outline custom-card" style="height: 400px;">
                    <div class="card-header">
                      <h5>Appointment attend Statistics</h5>
                    </div>
                    <div class="card-block p-4">
                      <div style="max-width: 600px; height: 280px; margin: auto;">
                        <canvas id="myChart5"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              
                <script>
                  // Dummy data for the bar chart
                  const barChartData = {
                    labels: ['March', 'April', 'May', 'June'],
                    datasets: [{
                      label: 'Attend',
                      backgroundColor: '#3AA946', // Green
                      data: [80, 81, 56, 55],
                    },
                    {
                      label: 'Cancelled',
                      backgroundColor: '#DE3A18', // Red
                      data: [40, 68, 45, 30, 76, 62],
                    }]
                  };
              
                  // Configuration options for the bar chart
                  const barChartOptions = {
                    barThickness: 10,
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    },
                    plugins: {
                      legend: {
                        labels: {
                          usePointStyle: true, // Use point-style icons instead of text labels
                        }
                      }
                    }
                  };
              
                  // Create and render the bar chart
                  const ctx1 = document.getElementById('myChart5').getContext('2d');
                  const barChart = new Chart(ctx1, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                  });
                </script>

                <div class="col-md-12 col-xl-6">
                  <div class="card sale-card card-outline card-border-primary custom-thinner-outline" style="height: 400px;">
                    <div class="card-header">
                      <h5>Patients by Age</h5>
                    </div>
                    <div class="card-block">
                      <div>
                        <canvas id="myChart4"></canvas>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                  // Dummy data for the pie chart
                  const pieChartData = {
                    labels: ['0-20', '21-40', '41-60', '61-80', '81+'],
                    datasets: [{
                      data: [25, 30, 20, 15, 10],
                      backgroundColor: ['#4CAF50', '#2196F3', '#FF5722', '#FFC107', '#9C27B0'],
                      hoverBackgroundColor: ['#8BC34A', '#42A5F5', '#FF7043', '#FFD54F', '#BA68C8'],
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
                  const ctx2 = document.getElementById('myChart4').getContext('2d');
                  const pieChart = new Chart(ctx2, {
                    type: 'pie',
                    data: pieChartData,
                    options: pieChartOptions,
                  });
                </script>


                <!-- Issues -->
                <div class="col-xl-4 col-md-6">
                  <div class="card latest-update-card">
                      <div class="card-header">
                          <h5>Major Issues</h5>
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
                                  <div class="row p-t-20 p-b-30">
                                      <div class="col-auto text-right update-meta p-r-0">
                                          <i class="b-primary update-icon ring"></i>
                                      </div>
                                      <div class="col p-l-5">
                                          <a href="#!"><h6>Rescheduled appointment</h6></a>
                                          <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                      </div>
                                  </div>
                                  <div class="row p-b-30">
                                      <div class="col-auto text-right update-meta p-r-0">
                                          <i class="b-primary update-icon ring"></i>
                                      </div>
                                      <div class="col p-l-5">
                                          <a href="#!"><h6>Referred to specialist</h6></a>
                                          <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                      </div>
                                  </div>
                                  <div class="row p-b-30">
                                      <div class="col-auto text-right update-meta p-r-0">
                                          <i class="b-success update-icon ring"></i>
                                      </div>
                                      <div class="col p-l-5">
                                          <a href="#!"><h6>Urgent Care</h6></a>
                                          <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                      </div>
                                  </div>
                                  <div class="row p-b-30">
                                      <div class="col-auto text-right update-meta p-r-0">
                                          <i class="b-danger update-icon ring"></i>
                                      </div>
                                      <div class="col p-l-5">
                                          <a href="#!"><h6>Your Manager Posted.</h6></a>
                                          <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
                                      </div>
                                  </div>
                                  <div class="row p-b-30">
                                      <div class="col-auto text-right update-meta p-r-0">
                                          <i class="b-primary update-icon ring"></i>
                                      </div>
                                      <div class="col p-l-5">
                                          <a href="#!"><h6>Showcases</h6></a>
                                          <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-auto text-right update-meta p-r-0">
                                          <i class="b-success update-icon ring"></i>
                                      </div>
                                      <div class="col p-l-5">
                                          <a href="#!"><h6>Miscellaneous</h6></a>
                                          <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- End Latest Activity -->


                <!-- Calendar -->
                <div class="col-xl-8 col-md-12 ">
                  <div class="card">
                      <div class="card-header">
                      <h5 class="m-b-5">Calendar</h5>
                        <div class="card-block p-b-0">
                            <div class="row m-b-50">
                                <div class="col">
                                  <div id="calendar" style="max-width: 600px; height: auto;"></div>
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

</div>
</div>
</div>
</div>

<!-- Add Patient form -->
<div class="modal fade" id="assign-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">ID :</span>
                            <input type="text" style="width:350px;" class="form-control" name="id" id="id" placeholder="ABC1234" disabled>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Name :</span>
                            <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="John Doe" disabled>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width: 150px;">Room No:</span>
                            <select class="form-control" style="width: 350px;" name="gender" id="gender">
                                <option value="room1">Room 1</option>
                                <option value="room2">Room 2</option>
                                <option value="room3">Room 3</option>
                                <option value="room4">Room 4</option>
                                <option value="room5">Room 5</option>
                                <option value="room6">Room 6</option>
                            </select>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light">Submit</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end Add Patient form -->


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

@endsection