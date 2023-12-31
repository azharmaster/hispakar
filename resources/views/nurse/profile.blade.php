<!DOCTYPE html>
<html lang="en">
<head>
    <title>PAKAR HIS | Profile</title>


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

    <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min-1.css">
    <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min-1.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/style-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/widget-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/print.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   
    <!-- added PAKAR HIS css -->
    <link rel="stylesheet" href="../files/assets/css/HIS.css">
</head>

<body onafterprint="hideLogo()">

  <div class="loader-bg">
      <div class="loader-bar"></div>
  </div>

  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <!-- here -->
        <?php include 'includes/header.php'?>
        <?php include 'includes/chatSidebar.php'?>
        <?php include 'includes/showChat_inner.php' ?>
        <!-- here -->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <!-- Start Navigation -->
                <?php include 'includes/sidebar.php'?>
                <!-- End Navigation -->
                <!-- Start Dashboard -->
                <div class="pcoded-content" id="content">
                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="fas fa-solid fa-user bg-c-blue"></i>
                                    <div class="d-inline">
                                        <h5>Profile</h5>
                                        <span>John Doe's Profile Page</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class=" breadcrumb breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="../nurse/index.php"><i class="feather icon-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../nurse/profile.php">Profile</a> </li>
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
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-block">
                                                <!--profile picture -->
                                                <img src="../files/assets/images/avatar-4-1.jpg" class="img-radius" style="width: 140px; height: 140px;"> 
                                            </div>
                                            <h4 class="profile-username text-center">John Doe</h4>
                                            <p class="text-muted text-center">NURSE</p>
                                            <p class="text-muted text-center">Department of Surgery</p>
                                            <a data-toggle="modal" title="Edit Profile" href="#edit-profile" class="btn btn-mat waves-effect waves-light btn-info mx-auto" 
                                            ><i class="fas fa-pencil-alt"></i>&nbsp;<b>Edit Profile</b></a>

                                            <br><br>
 
                                        </div>
                                    </div>

                                    <!-- user details -->
                                    <div class="col-sm-8">
                                        <div class="card">
                                            <div class="card-block">
                                                <!--profile picture -->
                                               
                                            </div>
                                            <div class="form-horizontal ml-3">
                                              <div class="form-group row">
                                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">IC</label>
                                                  <div class="col-sm-7">
                                                  <input type="text" class="form-control form-control-border-bottom  profile" style="background-color: white; color: black;" id="exampleInputBorder" placeholder=".." disabled value="490706-05-1288">
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Name</label>
                                                  <div class="col-sm-7">
                                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="John Doe" id="inputName" placeholder="Name" disabled>
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Gender</label>
                                                  <div class="col-sm-7">
                                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="Male" id="inputName" placeholder="Name" disabled>
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Phone No.</label>
                                                  <div class="col-sm-7">
                                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="0149082376" id="inputName" placeholder="Name" disabled>
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputName2" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Email</label>
                                                  <div class="col-sm-7">
                                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" id="inputName2" value="johndoe@gmail.com" placeholder="Name" disabled>
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputExperience" style="font-weight: normal; color: black;"  class="col-sm-3 col-form-label">Address</label>
                                                  <div class="col-sm-7">
                                                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" id="inputName2" value="Pulau Pinang" placeholder="Name" disabled>
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
            </div>
            <div id="styleSelector"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- /.start edit profile modal-->
  <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" style="margin-left: 15px; margin-right:15px;">
        <form >
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <div class="col-sm-10">
                  <div class="profilepic" onclick="openFileUploader()">
                    <img class="profilepic__image" src="../files/assets/images/avatar-4-1.jpg" alt="Profile" />
                    <div class="profilepic__content">
                      <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                      <span class="profilepic__text">Choose Photo</span>
                    </div>
                  </div>
                  <input class="file-upload" type="file" accept="image/*" onchange="readURL(this)" />
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">IC</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-border profile" style="background-color: white;" id="exampleInputBorder" value="490706-05-1288" placeholder="..">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="John Doe"  id="inputName" placeholder="Name">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="21"  id="inputName" placeholder="Name">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="Male" id="inputName" placeholder="Name">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Phone No.</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="0149082376" id="inputName" placeholder="Name">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName2" style="font-weight: normal; " class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-border" id="inputName2" value="johndoe@gmail.com" placeholder="Name">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputExperience" style="font-weight: normal; "  class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="Pulau Pinang" placeholder="Location">
                </div>
              </div>
              <!-- /.form-group -->
            </div> <!-- /.row -->
          </div> <!-- /.body content -->
        </div> <!-- /.end modal content -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success">Save Changes</button>
        </div>
        </form>
      </div> <!-- /.end modal dialog -->
    </div> <!-- /.end edit profile modal-->
  </div>

   
  <script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min-1.js"></script>

  <script src="../files/assets/jquery/jquery.min.js"></script>

  <script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

  <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

  <script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr-1.js"></script>
  <script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars-1.js"></script>

  <script src="../files/bower_components/datatables.net/js/jquery.dataTables.min-1.js"></script>
  <script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min-1.js"></script>
  <script src="../files/assets/pages/data-table/js/jszip.min-1.js"></script>
  <script src="../files/assets/pages/data-table/js/pdfmake.min-1.js"></script>
  <script src="../files/assets/pages/data-table/js/vfs_fonts-1.js"></script>
  <script src="../files/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min-1.js"></script>
  <script src="../files/assets/pages/data-table/extensions/buttons/js/buttons.flash.min-1.js"></script>
  <script src="../files/assets/pages/data-table/extensions/buttons/js/jszip.min-1.js"></script>
  <script src="../files/assets/pages/data-table/extensions/buttons/js/vfs_fonts-1.js"></script>
  <script src="../files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min-1.js"></script>
  <script src="../files/bower_components/datatables.net-buttons/js/buttons.print.min-1.js"></script>
  <script src="../files/bower_components/datatables.net-buttons/js/buttons.html5.min-1.js"></script>
  <script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min-1.js"></script>
  <script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min-1.js"></script>
  <script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min-1.js"></script>

  <script src="../files/assets/pages/data-table/js/data-table-custom-1.js"></script>
  <script src="../files/assets/js/pcoded.min-1.js"></script>
  <script src="../files/assets/js/vertical/vertical-layout.min-1.js"></script>
  <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min-1.js"></script>
  <script type="text/javascript" src="../files/assets/js/script-1.js"></script>
  <script type="text/javascript" src="../files/assets/printScript.js"></script>

  <script>
    function openFileUploader() {
      $(".file-upload").click();
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.profilepic__image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>
