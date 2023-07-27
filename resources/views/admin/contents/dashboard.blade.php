@extends('layouts.admin')

@section('content')

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
                            <div class="card prod-p-card card-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Doctors</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totaldoc}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-md text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totaldoc2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Nurses</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totalnurse}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-nurse text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totalnurse2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-green">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Patients</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totalpatient}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-injured text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totalpatient2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-info">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Departments</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totaldept}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-building text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totaldept2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-primary">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Medicines</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totalmedicine}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tablets text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totalmedicine2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-green">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Rooms</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totalroom}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clinic-medical  text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totalroom2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Appoiments</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{$totalapt}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check  text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label label-danger m-r-10">+{{$totalapt2}}</span>From
                                        Previous Month</p>
                                </div>
                            </div>
                        </div>

                      
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

                        <!-- Start Progress Row -->
                        <!-- <div class="col-xl-12">
                      <div class="card proj-progress-card">
                      <div class="card-block">
                      <div class="row">
                      <div class="col-xl-3 col-md-6">
                      <h6>Published Project</h6>
                      <h5 class="m-b-30 f-w-700">532<span class="text-c-green m-l-10">+1.69%</span></h5>
                      <div class="progress">
                      <div class="progress-bar bg-c-red" style="width:25%"></div>
                      </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                      <h6>Completed Task</h6>
                      <h5 class="m-b-30 f-w-700">4,569<span class="text-c-red m-l-10">-0.5%</span></h5>
                      <div class="progress">
                      <div class="progress-bar bg-c-blue" style="width:65%"></div>
                      </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                      <h6>Successfull Task</h6>
                      <h5 class="m-b-30 f-w-700">89%<span class="text-c-green m-l-10">+0.99%</span></h5>
                      <div class="progress">
                      <div class="progress-bar bg-c-green" style="width:85%"></div>
                      </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                      <h6>Ongoing Project</h6>
                      <h5 class="m-b-30 f-w-700">365<span class="text-c-green m-l-10">+0.35%</span></h5>
                      <div class="progress">
                      <div class="progress-bar bg-c-yellow" style="width:45%"></div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div> -->
                        <!-- End Progress Row -->

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
                                                @foreach($medicines as $medicine)
                                                <div class="btn btn-danger m-1">{{$medicine->name}} {{$medicine->stock}}
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Med Supply -->

                        <!-- Start Table -->
                        <div class="col-md-8">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Available Nurses</h5>
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
                                                    <th>ID</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($nurses as $nurse)
                                                <tr>
                                                    <td>{{$nurse->name}} </td>
                                                    <td>{{$nurse->dept_name}} </td>
                                                    <td>#PHD001</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->

                        <!-- Latest Activity -->
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
                        <!-- End Latest Activity -->

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

</div>
</div>
</div>
</div>


<!--[if lt IE 10]>
      <div class="ie-warning">
          <h1>Warning!!</h1>
          <p>You are using an outdated version of Internet Explorer, please upgrade
              <br/>to any of the following web browsers to access this website.
          </p>
          <div class="iew-container">
              <ul class="iew-download">
                  <li>
                      <a href="http://www.google.com/chrome/">
                          <img src="./files/assets/images/browser/chrome.png" alt="Chrome">
                          <div>Chrome</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.mozilla.org/en-US/firefox/new/">
                          <img src="./files/assets/images/browser/firefox.png" alt="Firefox">
                          <div>Firefox</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://www.opera.com">
                          <img src="./files/assets/images/browser/opera.png" alt="Opera">
                          <div>Opera</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.apple.com/safari/">
                          <img src="./files/assets/images/browser/safari.png" alt="Safari">
                          <div>Safari</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                          <img src="./files/assets/images/browser/ie.png" alt="">
                          <div>IE (9 & above)</div>
                      </a>
                  </li>
              </ul>
          </div>
          <p>Sorry for the inconvenience!</p>
      </div>
  <![endif]-->

@endsection