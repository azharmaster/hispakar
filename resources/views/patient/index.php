<!DOCTYPE html>
<html lang="en">
<head>
  <title>PAKAR HIS | Dashboard </title>


  <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs.">
  <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
  <meta name="author" content="colorlib">

  <link rel="icon" href="../files/assets/images/favicon-1.ico" type="image/x-icon">

  <link href="../css-2?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="../css-3?family=Quicksand:500,700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min-1.css">

  <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min-1.css" type="text/css" media="all">

  <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather-1.css">

  <link rel="stylesheet" type="text/css" href="../files/assets/css/font-awesome-n.min-1.css">

  <link rel="stylesheet" href="../files/bower_components/chartist/css/chartist-1.css" type="text/css" media="all">

  <link rel="stylesheet" type="text/css" href="../files/assets/css/style-1.css">
  <link rel="stylesheet" type="text/css" href="../files/assets/css/widget-1.css">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <style>
    .data-label {
      font-size: 15px;
    }
    .data-badge {
      font-size: 12px;
      padding: 4px 8px;
      border-radius: 10px;
    }
    .weight-badge {
      background-color: #007bff;
      color: #fff;
    }
    .height-badge {
      background-color: #28a745;
      color: #fff;
    }
    .blood-badge {
      background-color: #dc3545;
      color: #fff;
    }
    @media (min-width: 768px) {
      .table-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
      }
    }


  </style>
</head>

<body>

  <div class="loader-bg">
    <div class="loader-bar"></div>
  </div>

  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <?php include 'includes/header.php'?>
      <?php include 'includes/chatSidebar.php'?>
      <?php include 'includes/showChat_inner.php' ?>

      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          <?php include 'includes/sidebar.php'?>
          <!-- Start Dashboard -->
          <div class="pcoded-content">
            <div class="page-header card">
              <div class="row align-items-end">
                <div class="col-lg-8">
                  <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                      <h5>Welcome John!</h5>
                      <span>Are you feeling great today?</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                      <li class="breadcrumb-item">
                        <a href="index.php">
                          <i class="feather icon-home"></i>
                        </a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="../patient/index.php">Dashboard</a>
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
                        <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                          <div class="card comp-card">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col">
                                  <h6 class="m-b-25">New Appointments</h6>
                                  <h4 class="f-w-700 text-c-blue">1</h4>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-calendar-check bg-c-blue"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-md-4">
                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Days to Appointment</h6>
                                <h4 class="f-w-700 text-c-green">2 Days</h4>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-solid fa-bell bg-c-green"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <a title="Confirmation Appointment" data-toggle="modal" data-target="#viewAptModal">
                          <div class="card comp-card">
                            <div class="card-body">
                              <div class="row align-items-center">
                                <div class="col">
                                  <h6 class="m-b-25"> Appointment Confirmation</h6>
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
                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Your Doctor</h6>
                                <div class="row align-items-center">
                                  <div class="col-auto">
                                    <img src="../files/assets/images/avatar-4-1.jpg" class="img-radius" style="width: 90px; height: 90px;">
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5">Dr. Nik Ahmad</h6>
                                    <p class="m-b-5">Contact: 0178923546</p>
                                    <h6 class="m-b-25"><span class="badge badge-primary">Therapist</span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card comp-card">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col">
                                <h6 class="m-b-25">Your Data</h6>
                                <div class="row align-items-center">
                                  <div class="col">
                                    <h6 class="m-b-7"><span class="data-label">Weight</span><br> <span class="font-weight-bold"><span class="badge data-badge weight-badge">60 kg</span></span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">Height</span><br> <span class="font-weight-bold"><span class="badge data-badge height-badge">170 cm</span></span></h6>
                                  </div>
                                  <div class="col">
                                    <h6 class="m-b-5"><span class="data-label">Blood Type</span><br> <span class="font-weight-bold"><span class="badge data-badge blood-badge">A+</span></span></h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Med Supply -->
                      <div class="col-xl-4 col-md-8">
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
                                  <div class="btn btn-danger m-1">Paracetemol</div>
                                  <div class="btn btn-warning m-1">Ibuprofen</div>
                                  <div class="btn btn-warning m-1">Antibiotics</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>   
                      <!-- End Med Supply -->

                      <!-- Latest Activity -->
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

                      <!-- Start Table -->
                      <div class="col-md-6">
                      <!-- <div class="table-container"> -->
                        <!-- <div class="card table-card available-doctors">
                          <div class="card-header">
                          <h5>Available Doctors</h5>
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
                                  <th>Name</th>
                                  <th>ID</th>
                                  <th>Location</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Haley Kennedy	</td>
                                    <td>N0011</td>
                                    <td>#PHD001</td>
                                  </tr>
                                  <tr>
                                    <td>Rhona Davidson</td>
                                    <td>N0034</td>
                                    <td>#PHD002</td>
                                  </tr>
                                  <tr>
                                    <td>Sofa</td>
                                    <td>N0123</td>
                                    <td>#PHD001</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div> -->

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
                                  <th>Name</th>
                                  <th>ID</th>
                                  <th>Description</th>
                                  <th>Date</th>
                                </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                  <tr>
                                    <td>1911</td>
                                    <td>John Doe</td>
                                    <td>Fever</td>
                                    <td>22-06-2023</td>
                                  </tr>
                                  <tr>
                                    <td>1911</td>
                                    <td>John Doe</td>
                                    <td>Fever</td>
                                    <td>22-06-2023</td>
                                  </tr>
                                  <tr>
                                    <td>1911</td>
                                    <td>John Doe</td>
                                    <td>Fever</td>
                                    <td>22-06-2023</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      <!-- </div> -->
                      </div>
                      <!-- End table -->

                      <!-- Calendar -->
                      <div class="col-xl-6 col-md-12 ">
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
              <div class="col-md-6">
                <div class="form-group">
                    <label for="id" class="input-group-addon" style="font-weight:bold;">IC Number :</label>
                    <input type="text" class="form-control" name="id" id="id" value="490912-05-1856">
                </div>
                <div class="form-group">
                    <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                    <input type="text" class="form-control" name="name" id="name" value="John Doe">
                </div>
                <div class="form-group">
                    <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address" class="input-group-addon" style="font-weight:bold;">Address :</label>
                    <input type="text" class="form-control" name="address" id="address" value="Malaysia">
                </div>
                <div class="form-group">
                    <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact :</label>
                    <input type="text" class="form-control" name="contact" id="contact" value="0199237856">
                </div>  
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="desc" class="input-group-addon" style="font-weight:bold;">Description :</label>
                    <input type="text" class="form-control" name="desc" id="desc" value="Fever">
                </div>
                <div class="form-group">
                    <label for="doctor" class="input-group-addon" style="font-weight:bold;">Doctor In-Charge:</label>
                    <input type="text" class="form-control" name="doctor" id="doctor" value="Dr. Nik Ahmad">
                </div>
                <div class="form-group">
                    <label for="date" class="input-group-addon" style="font-weight:bold;">Appointment Date & Time :</label>
                    <input type="datetime-local" class="form-control" name="date" id="date">
                </div>
                <div class="form-group">
                    <label for="location" class="input-group-addon" style="font-weight:bold;">Location :</label>
                    <input type="text" class="form-control" name="location" id="location" value="Room 1">
                </div>
                <div class="form-group">
                    <label for="location" class="input-group-addon" style="font-weight:bold;">Level :</label>
                    <input type="text" class="form-control" name="location" id="location" value="Level 2">
                </div>
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

  <!-- View confirmation Appointment form -->
  <div class="modal fade" id="viewAptModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> Appointment Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="form-group">
                <label for="id" class="input-group-addon" style="font-weight:bold;">IC Number :</label>
                <input type="text" class="form-control" name="id" id="id" value="490912-05-1856" readonly>
            </div>
            <div class="form-group">
                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                <input type="text" class="form-control" name="name" id="name" value="John Doe" readonly>
            </div>
            <div class="form-group">
                <label for="desc" class="input-group-addon" style="font-weight:bold;">Description :</label>
                <input type="text" class="form-control" name="desc" id="desc" value="Fever" readonly>
            </div>
            <div class="form-group">
                <label for="doctor" class="input-group-addon" style="font-weight:bold;">Doctor In-Charge:</label>
                <input type="text" class="form-control" name="doctor" id="doctor" value="Dr. Nik Ahmad" readonly>
            </div>
            <div class="form-group">
                <label for="date" class="input-group-addon" style="font-weight:bold;">Appointment Date & Time :</label>
                <input type="datetime-local" class="form-control" name="date" id="date" readonly>
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon" style="font-weight:bold;">Are you sure want to confirm this appointment? :</span>
              <select class="form-control" style="width: 350px;" name="confirm" id="confirm">
                <option selected="selected">Choose</option>
                <option value="yes">Yes (Confirm)</option>
                <option value="no">No (Cancel)</option>
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
  <!-- end view confirmation Appointment form -->

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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min-1.js"></script><script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min-1.js"></script>

  <script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

  <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

  <script src="../files/assets/pages/chart/float/jquery.flot-1.js"></script>
  <script src="../files/assets/pages/chart/float/jquery.flot.categories-1.js"></script>
  <script src="../files/assets/pages/chart/float/curvedLines-1.js"></script>
  <script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min-1.js"></script>

  <script src="../files/bower_components/chartist/js/chartist-1.js"></script>

  <script src="../files/assets/pages/widget/amchart/amcharts-1.js"></script>
  <script src="../files/assets/pages/widget/amchart/serial-1.js"></script>
  <script src="../files/assets/pages/widget/amchart/light-1.js"></script>

  <script src="../files/assets/js/pcoded.min-1.js"></script>
  <script src="../files/assets/js/vertical/vertical-layout.min-1.js"></script>
  <script type="text/javascript" src="../files/assets/pages/dashboard/custom-dashboard.min-1.js"></script>
  <script type="text/javascript" src="../files/assets/js/script.min-1.js"></script>

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

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
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
      });
      calendar.render();
    });

  </script>

</body>
</html>
