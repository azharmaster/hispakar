@extends('layouts.doctor')

@section('content')

@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

<!-- Start Content -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-calendar-check bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Appointments</h5>
                        <span>Below is the list of all appointments.</span>
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
                            <a href="doctor.php">Appointments</a>
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
                                    <h5 id="tableTitle">List of Appointments</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive" style="page-break-before:avoid;">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>IC</th>
                                                    <th>Patient Name</th>
                                                    <th>Date-Time</th>
                                                    <th>Description</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( $appointments->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach($appointments as $appointment)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <!-- joined table -->
                                                            <td>{{ $appointment->patient_ic}}</td>
                                                            <td>{{ $appointment->patient_name}}</td>
                                                            <td>{{ $appointment->date}} - {{ $appointment->time}}</td>
                                                            <td>{{ $appointment->desc}}</td>
                                                            <td style="text-align: center;">
                                                                <a title="Edit Room" data-toggle="modal" data-target="#editModal">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a title="Delete Room" data-toggle="modal" data-target="#deleteModal">
                                                                    <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                                </a>
                                                            </td>
            
                                                        </tr>
                                                    @endforeach
                                                @endif
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
<!-- end content -->

<!-- Add Appointment form -->
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
  <!-- end add Appointment form -->

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


@endsection

