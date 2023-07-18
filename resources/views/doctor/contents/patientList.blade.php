@extends('layouts.doctor')

@section('content')

@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
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
                                    <h5 id="tableTitle">List of Patient</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Contact No</th>
                                                    <th>Gender</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( $patients->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach($patients as $patient)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $patient->name }}</td>
                                                            <td>{{ $patient->phoneno }}</td>
                                                            <td>{{ $patient->gender }}</td>
                                                            <td>
                                                                <a title="Edit Patient" data-toggle="modal" data-target="#editModal-{{ $patient->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/doctor/patientList/{{ $patient->id }}" title="Delete Patient" data-toggle="modal" data-target="#deleteModal-{{ $patient->id }}">
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


<!-- Add Patient form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/doctor/patientList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                            <input type="text" class="form-control" name="ic" id="name" placeholder="550402050449">
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option selected="">Select Gender </option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                            <input type="text" class="form-control" name="phoneno" id="contact" placeholder="0199237856">
                        </div> 
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                            <input type="date" class="form-control" name="dob" id="name">
                        </div>
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Address :</label>
                            <input type="text" class="form-control" name="address" id="contact" placeholder="K-238, Taman Pandan, Puncak Alam">
                        </div> 
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Weight :</label>
                            <input type="float" class="form-control" name="weight" id="contact" placeholder="46.7">
                        </div> 
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Height :</label>
                            <input type="float" class="form-control" name="height" id="contact" placeholder="1.77">
                        </div> 

                        <div class="form-group">
                            <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type :</label>
                            <select class="form-control" name="bloodtype">
                                <option selected="select">Select </option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                            <input type="email" class="form-control" name="email" id="name" placeholder="johndoe@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Password :</label>
                            <input type="text" class="form-control" name="password" id="name" value="1234" readonly>
                        </div>
                        <input type="hidden" style="width:350px;" class="form-control" name="usertype" value="4">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- end Add Patient form -->

<!-- Edit Patient form -->
@foreach ($patients as $patient)
<div class="modal fade" id="editModal-{{ $patient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/doctor/patientList/{{ $patient->id }}" method="POST">
             @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $patient->id }}">

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                                <input type="text" class="form-control" name="ic" id="name" value="{{ $patient->ic }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $patient->name }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" {{ $patient->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $patient->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                                <input type="text" class="form-control" name="phoneno" id="contact" value="{{ $patient->phoneno }}">
                            </div> 
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                                <input type="date" class="form-control" name="dob" id="name" value="{{ $patient->dob }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Address :</label>
                                <input type="text" class="form-control" name="address" id="contact" value="{{ $patient->address }}">
                            </div> 
                            
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Weight :</label>
                                <input type="float" class="form-control" name="weight" id="contact" value="{{ $patient->weight }}">
                            </div> 
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Height :</label>
                                <input type="float" class="form-control" name="height" id="contact" value="{{ $patient->height }}">
                            </div> 

                            <div class="form-group">
                                <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type:</label>
                                <select class="form-control" name="bloodtype">
                                    <option value="A+" {{ $patient->bloodtype === 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $patient->bloodtype === 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $patient->bloodtype === 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $patient->bloodtype === 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ $patient->bloodtype === 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ $patient->bloodtype === 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ $patient->bloodtype === 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ $patient->bloodtype === 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                                <input type="email" class="form-control" name="email" id="name" value="{{ $patient->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button name="submit" class="btn btn-success waves-effect waves-light ">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- end edit Patient form -->

<!-- delete Patient form -->
@foreach ($patients as $patient)
<div class="modal fade" id="deleteModal-{{ $patient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 15px;"> Are you sure want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <form action="/doctor/patientList/{{ $patient->id }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button name="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end delete Patient form -->

@endsection



