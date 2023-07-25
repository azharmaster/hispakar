<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Dr. Nik Ahmad</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-4">
                                        <img src="../files/assets/images/dr-1.jpg" width="170" alt="User-Profile-Image">
                                        <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#editProfileModal" style="width: 170px;">Edit Profile</button>
                                        </div>
                                        <div class="col-8">
                                            <h3>Dr Nik Ahmad</h3>
                                            <h6>Oncologist, Surgeon</h6>
                                            <hr>
                                            <h6><i class="fas fa-graduation-cap text-primary mr-3"></i>MB BCH. BAO (HONS) LRCSI LRCPI</h6>
                                            <hr>
                                            <p class="mb-2"><i class="fas fa-phone mr-3 text-primary"></i> 03-23438484</p>
                                            <i class="far fa-envelope mr-3 text-primary"></i><span>nik@doctor.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <div class="row">
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-blue">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Total Patient</h5>
                                            <h4 class="f-w-700 text-white">34</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-hospital-user bg-c-white text-primary"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-green">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Experience</h5>
                                            <h4 class="f-w-700 text-white">10 years</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-briefcase bg-c-white text-success"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-green">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Operations</h5>
                                            <h4 class="f-w-700 text-white">73</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-hospital bg-c-white text-success"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4">Patients Attending</h5>
                                            <h4 class="f-w-700 text-success">5 patients</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-plus bg-c-green"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
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
                                    <canvas id="myChart2" width="680" height="340" style="display: block; box-sizing: border-box; height: 272px; width: 544px;"></canvas>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                            <div class="card-header">
                            <h5>Operations per Month</h5>
                            </div>
                            <div class="card-block">
                                <div>
                                    <canvas id="myChart" width="680" height="340" style="display: block; box-sizing: border-box; height: 272px; width: 544px;"></canvas>
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
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="John Doe">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px;">Specialization: </span>
                        <input type="text" style="width:350px;" class="form-control" name="specialization" id="specialization" value="Malaysia">
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
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Credentials :</span>
                        <textarea type="email" style="width: 100%;" class="form-control" name="cred" id="cred" value="john@gmail.com"></textarea>
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
<script type="text/javascript" src="../files/assets/printScript.js"></script>

<script>
    const ctx = document.getElementById('myChart');
    //const label = Utils.months({count: 7});
  
    new Chart(ctx,  {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [
            {
            label: "New",
            data: [12, 19, 3, 5, 2, 3],
            borderColor: '#4099ff',
            backgroundColor: '#4099ff'
            },

        ]
    }})

const ctx2 = document.getElementById('myChart2');
  
new Chart(ctx2,  {
    type: 'bar',
    data: {
    labels: ['Newborn', 'Infant', 'Child', 'Adolescent', 'Old Age'],
    datasets: [
        {
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1,
        backgroundColor: ['#FFB1C1','#7FB5B5','#EC7C26','#3E5F8A','#1E5945','#57A639'],
        },

    ]
}})
</script>
