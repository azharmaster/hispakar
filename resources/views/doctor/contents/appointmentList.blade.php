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
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Dept Name</th>
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
                                                            <td>{{ $appointment->doctor_name }}</td>
                                                            <td>{{ $appointment->patient_name }}</td>
                                                            <td>{{ $appointment->dept_name }}</td>
                                                            <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                                            <td>{{ $appointment->status }}</td>
                                                             <td>
                                                                <a href="/doctor/appointmentReport/{{ $appointment->id }}" title="Edit Appointment">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/doctor/appointmentList/{{ $appointment->id }}" title="Delete Room" data-target="#deleteModal-{{ $appointment->id }}" data-toggle="modal">
                                                                    <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red delete-btn"></i>
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

<!-- Add Appointments form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Appointments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/doctor/appointmentList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                   
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Patient :</span>
                        <select class="form-control" style="width:350px;" name="patientid">
                        <option value="">Choose Patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor :</span>
                        <select class="form-control" style="width:350px;" name="docid">
                        <option value="">Choose Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Department :</span>
                       
                        <select class="form-control" style="width:350px;" name="deptid">
                            <option value="">Choose Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <input type="date" style="width:350px;" class="form-control" name="date" id="date" placeholder="">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="time" id="time" placeholder="">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Status :</span>
                        <select style="width:350px;" class="form-control" name="status" id="status">
                            <option value="">Status</option>
                            <option value="0">Not Available</option>
                            <option value="1">Available</option>
                        </select>
                        
                    </div>
                    
                        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button  name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

                    
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end Add Appointments form -->


@foreach ($appointments as $appointment)
<!-- Edit Appointments form -->
<div class="modal fade" id="editModal-{{ $appointment->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Appointments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/doctor/appointmentList/{{ $appointment->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">

                <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Patient ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="patientid" id="patientid" value="{{ $appointment->patientid }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="docid" id="docid" value="{{ $appointment->docid }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Department ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="deptid" id="deptid" value="{{ $appointment->deptid }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <input type="date" style="width:350px;" class="form-control" name="date" id="date" value="{{ $appointment->date }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="time" id="time" value="{{ $appointment->time }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Status :</span>
                        <input type="text" style="width:350px;" class="form-control" name="status" id="status" value="{{ $appointment->status }}">
                    </div>
                        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button  name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit Patient form -->
@endforeach


<!-- delete Patient form -->
@foreach ($appointments as $appointment)
    <div class="modal fade" id="deleteModal-{{ $appointment->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this room?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/doctor/appointmentList/{{ $appointment->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end delete Patient form -->


@endsection

