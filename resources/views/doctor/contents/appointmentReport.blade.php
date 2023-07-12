<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-hospital-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Check Up Report</h5>
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
                            <a href="doctor.php">Check Up</a>
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
                            <!-- Start Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Patient Info</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Edit
                                    </button>
                                </div>
                                <div class="card-block">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <td>John Doer</td>
                                            <th>Birth Date</th>
                                            <td>23 August 1987</td>
                                        </tr>
                                        <tr>
                                            <th>Weight</th>
                                            <td>70 kg</td>
                                            <th>Height</th>
                                            <td>175 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Medical History</th>
                                            <td colspan="3">Type 2 Diabetes, High Blood Pressure</td>
                                        </tr>
                                        <tr>
                                            <th>Prescribed Medication</th>
                                            <td colspan="3">
                                                <ul>
                                                    <li>Paracetamol</li>
                                                    <li>Insulin</li>
                                                    <li>Biguanides</li>
                                                    <li>Alpha-glucosidase inhibitors</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
    
                                </div>
                            <!-- End table -->
                        </div>
                    </div>
    
                        <div class="col-sm-12">
                            <!-- Start Card -->
                            <div class="card">
                                <div class="card-block">
                                </div>
                                <div class="card-header">
                                    <h5>Check Up Description</h5>
                                    <span>Description of Patient's health </span>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col">
                                            <textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"></textarea>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="card-header">
                                    <h5>Medicine Prescription</h5>
                                    <span>Medicines included</span>
                                </div>
                                <div class="card-block">
                                    <table class="table table-bordered" id="medTable">
                                        <tr>
                                            <th>Medicine 1</th>
                                            <td>
                                            <select name="medName" id="medName">
                                                <option value="paracetamol">Paracetamol</option>
                                                <option value="paracetamol">Insulin</option>
                                                <option value="paracetamol">Biguanides</option>
                                                <option value="">Alpha-glucosidase inhibitors</option>
    
                                            </select>
                                            </td>
                                            <td>
                                            <select name="quantity" id="quantity">
                                                <option value="paracetamol">1 pill</option>
                                                <option value="paracetamol">2 pill</option>
                                            </select>
                                            </td>
                                            <td class="text-align-center"><span onclick="deleteRow(this)"><i class="fas fa-trash-alt text-danger"></i></span></td>
                                        </tr>
                                    </table>
                                    <div class="form-group row">
                                        <div class="col">
                                            <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" onclick="addMedRow()">
                                                Add Medicine
                                            </button>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="checkbox" id="scheduleNext" name="scheduleNext" onclick="scheduleNext()">
                                            <label class="col-sm-4 col-form-label">Schedule Next Appointment</label>
                                            <input class="form-control" type="date" id="dateForm" disabled>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <div class="col">
                                            <a href="appointments.php">
                                                <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                                    Submit
                                                </button>
                                            </a>
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

<script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

<script type="text/javascript" src="../files/assets/js/script.min-1.js"></script>

<script type="text/javascript" src="../files/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/datedropper/js/datedropper.min-1.js"></script>

<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr-1.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars-1.js"></script>

<script src="../files/bower_components/datatables.net/js/jquery.dataTables.min-1.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/jszip.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/pdfmake.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/vfs_fonts-1.js"></script>
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

<script>
    var table = document.getElementById("medTable");
    var medNum = 1;
        
    function addMedRow(){
        medNum++;
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0).outerHTML = "<th>Medicine " + medNum + "</th>";
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
            
        cell2.innerHTML = "<select><option>Paracetamol</option><option>Alpha-glucosidase inhibitors</option></select>";
        cell3.innerHTML = "<select><option>1 unit</option><option>2 unit</option></select>";
        cell4.innerHTML = "<span onclick='deleteRow(this)'><i class='fas fa-trash-alt text-danger'></i></span>";
    }

    function getRowIndex(table, columnIndex, cells) {
        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].cells;
            if (columnIndex < cells.length && cells[columnIndex] === cell) {
            return i;
            }
        }
        return -1; // Return -1 if the cell is not found in the specified column
    }

    function deleteRow(x){
        medNum--;
        table.deleteRow(-1);
    }

    function scheduleNext(){
        var checkBox = document.getElementById("scheduleNext");
        var dateForm = document.getElementById("dateForm");

        if(checkBox.checked == false){
            dateForm.disabled = true;
        }else {
            dateForm.disabled = false;
        }
    }
</script>
