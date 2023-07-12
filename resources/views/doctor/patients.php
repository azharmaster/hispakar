<!DOCTYPE html>
<html lang="en">
<head>
    <title> PAKAR HIS | Patients </title>


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
    <link rel="stylesheet" type="text/css" href="../files/bower_components/sweetalert/css/sweetalert-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/component-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons-1.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/font-awesome-n.min-1.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont-1.css">
    <link rel="stylesheet" href="../files/bower_components/chartist/css/chartist-1.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/style-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/widget-1.css">

    <!-- Data tables -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min-1.css">
    <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min-1.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../files/assets/css/style-1.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/pages-1.css">

    <!-- print css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/print.css">

</head>
<body onafterprint="hideLogo()">

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php include('includes/header.php') ?>
        </div>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <?php include('includes/sidebar.php')   ?>

                <!-- Start Dashboard -->
                <div class="pcoded-content" id="content">
                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                                    <div class="d-inline">
                                        <h5>Patients</h5>
                                        <span>Below is the list of all patients.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class=" breadcrumb breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">
                                                <i class="feather icon-home"></i>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="doctor.php">Patients</a>
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
                                        <div class="col-sm-12">
                                            <!-- Start Table -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>List of Patient</h5>
                                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                                        <i class="fas fa-solid fa-plus"></i>    
                                                            Add 
                                                    </button>
                                                </div>
                                                <div class="card-block"> 
                                                    <?php include '../files/assets/printComponents.php' ?> 
                                                    <div class="col-12">
                                                        <h2 class="text-center mb-5"  id="tableTitle" hidden>
                                                            <b>Patient List</b>
                                                        </h2>
                                                    </div>                                      
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="dataTable1" class="table table-bordered">
                                                            <!-- <a class="dt-button buttons-print" tabindex="0" aria-controls="basic-btn" href="#">
                                                                <span>Print</span>
                                                            </a>          
                                                            <a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="basic-btn" href="#">
                                                                <span>PDF</span>
                                                            </a>
                                                            <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="basic-btn" href="#">
                                                                <span>Excel</span>
                                                            </a>
                                                            <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="basic-btn" href="#">
                                                                <span>Copy</span>
                                                            </a>    -->
                                                            <thead>
                                                                <tr style="text-align: center;">
                                                                    <th>#</th>
                                                                    <th>ID</th>
                                                                    <th>Name</th>
                                                                    <th>Contact No</th>
                                                                    <th>Description</th>
                                                                    <th style="width: 80px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr style="text-align: center;">
                                                                    <td>1</td>
                                                                    <td>1911</td>
                                                                    <td>John Doe</td>
                                                                    <td>0199237856</td>
                                                                    <td>Heart Disease</td>
                                                                    <td>
                                                                        <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button> -->
                                                                        <a title="Edit Patient" data-toggle="modal" data-target="#editModal">
                                                                        <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                        </a>
                                                                        <a title="Delete Patient" data-toggle="modal" data-target="#deleteModal">
                                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                                        </a>
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Add Patient form -->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">ID :</span>
                            <input type="text" style="width:350px;" class="form-control" name="id" id="id" placeholder="ABC1234">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Name :</span>
                            <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="John Doe">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width: 150px;">Gender:</span>
                            <select class="form-control" style="width: 350px;" name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Address :</span>
                            <input type="text" style="width:350px;" class="form-control" name="address" id="address" placeholder="New York">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Contact :</span>
                            <input type="text" style="width:350px;" class="form-control" name="contact" id="contact" placeholder="0134567891">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Email :</span>
                            <input type="email" style="width:350px;" class="form-control" name="email" id="email" placeholder="johndoe@gmail.com">
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

    <!-- Edit Patient form -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">ID :</span>
                            <input type="text" style="width:350px;" class="form-control" name="id" id="id" value="1">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Name :</span>
                            <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="John Doe">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width: 150px;">Gender:</span>
                            <select class="form-control" style="width: 350px;" name="gender" id="gender" value="Male">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Address :</span>
                            <input type="text" style="width:350px;" class="form-control" name="address" id="address" value="Malaysia">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Contact :</span>
                            <input type="text" style="width:350px;" class="form-control" name="contact" id="contact" value="0199237856">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Email :</span>
                            <input type="email" style="width:350px;" class="form-control" name="email" id="email" value="john@gmail.com">
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end edit Patient form -->

    <!-- delete Patient form -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;"> Are you sure want to delete this user? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light ">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end delete Patient form -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min-1.js"></script><script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min-1.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min-1.js"></script>
    <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min-1.js"></script>
    <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min-1.js"></script>

    <script src="../files/assets/jquery/jquery.min.js"></script>

    <script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

    <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

    <script type="text/javascript" src="../files/assets/js/script.min-1.js"></script>


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

<script type="text/javascript" src="../files/assets/printScript.js" ></script>
</script>
</body>
</html>
