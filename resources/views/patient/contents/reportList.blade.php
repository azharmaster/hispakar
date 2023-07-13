@extends('layouts.patient')

@section('content')
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-file-medical bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Medical Reports</h5>
                        <span>Below is the list of all reports.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class=" breadcrumb breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="../patient/index.php"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="../patient/reportList.php">Medical Reports</a> </li>
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
                        <div class="card">
                            <div class="card-header">
                                <h5>List of Report</h5>
                                <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                            </div>
                            <div class="card-block">
                            <?php include '../files/assets/printComponent.php' ?> 
                                    <div class="col-12">
                                        <h2 class="text-center mb-5"  id="tableTitle" hidden>
                                            <b>Appointment History</b>
                                        </h2>
                                    </div>
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable1" class="table table-hover table-bordered nowrap">
                                        <thead>
                                          <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>IC</th>
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
                                            <td>Fever</td>
                                            <td>
                                                <a title="Download Record" href="../patient/patientPage.php?p=report">
                                                    <i style="font-size:22px;" class="fas fa-file-download f-w-600 f-16 text-c-blue"></i>
                                                </a>

                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
v>
 id="styleSelector"></div>

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

@include('patient.includes.dtScripts')

@endsection