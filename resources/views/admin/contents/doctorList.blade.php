@extends('layouts.admin')

@section('content')

@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="fas fa-solid fa-stethoscope bg-c-blue"></i>
                            <div class="d-inline">
                                <h5>Doctors</h5>
                                <span>Below is the list of all doctors.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/admin/dashboard"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="/admin/doctorList">Doctors</a> </li>
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
                                        <h5 id="tableTitle" >List of Doctor</h5>
                                        <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                        <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                            <i class="fas fa-solid fa-plus"></i>
                                                Add
                                        </button>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="dataTable1" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Specialization</th>
                                                        <th>Gender</th>
                                                        <th style="width: 80px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ( $doctors->isEmpty() )
                                                        <tr>
                                                            <td>No data available</td>
                                                        </tr>
                                                    @else
                                                        @foreach($doctors as $doctor)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $doctor->name }}</td>
                                                            <td>{{ $doctor->phoneno }}</td>
                                                            <td>{{ $doctor->email }}</td>
                                                            <td>{{ $doctor->specialization }}</td>
                                                            <td>{{ $doctor->gender }}</td>
                                                            <td>
                                                                <a title="Edit Doctor" data-toggle="modal" data-target="#editModal-{{ $doctor->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/admin/doctorList/{{ $doctor->id }}" title="Delete Doctor" data-target="#deleteModal-{{ $doctor->id }}" data-toggle="modal">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    <div id="styleSelector"></div>
<!-- Add Doctor form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/admin/doctorList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

              <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Staff ID :</label>
                            <input type="text" class="form-control" name="staff_id" id="name" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                            <input type="text" class="form-control" name="ic" id="name" placeholder="560402050448" required>
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" required>
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
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                            <input type="date" class="form-control" name="dob" id="name" required>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                            <input type="email" class="form-control" name="email" id="name" placeholder="johndoe@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Password :</label>
                            <input type="text" class="form-control" name="password" id="name" value="1234" readonly>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact :</label>
                            <input type="text" class="form-control" name="phoneno" id="contact" placeholder="0199237856" required>
                        </div>  
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px; font-weight:bold;">Specialization :</span>
                            <input type="text" style="width:350px;" class="form-control" name="specialization" placeholder="Heart Surgery" required>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="input-group-addon" style="font-weight:bold;">Department :</label>
                            <select class="form-control" name="deptid">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" style="width:350px;" class="form-control" name="usertype" value="2">
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
<!-- end Add Doctor form -->

<!-- Edit Doctor form -->
@foreach ($doctors as $doctor)
<div class="modal fade" id="editModal-{{ $doctor->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/doctorList/{{ $doctor->id }}" method="POST">
             @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">

                            <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $doctor->id }}">

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Staff ID :</label>
                                <input type="text" class="form-control" name="staff_id" id="name" value="{{ $doctor->staff_id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                                <input type="text" class="form-control" name="ic" id="name" placeholder="560402050448" value="{{ $doctor->ic }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" value="{{ $doctor->name }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" {{ $doctor->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $doctor->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                                <input type="date" class="form-control" name="dob" id="name" value="{{ $doctor->dob }}">
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                                <input type="email" class="form-control" name="email" id="name" placeholder="johndoe@gmail.com" value="{{ $doctor->email }}">
                            </div>
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact :</label>
                                <input type="text" class="form-control" name="phoneno" id="contact" placeholder="0199237856" value="{{ $doctor->phoneno }}">
                            </div>  
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="width:150px; font-weight:bold;">Specialization :</span>
                                <input type="text" style="width:350px;" class="form-control" name="specialization" placeholder="Heart Surgery" value="{{ $doctor->specialization }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Department :</label>
                                <select class="form-control" name="deptid">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" style="width:350px;" class="form-control" name="usertype" value="2">
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
<!-- end edit Doctor form -->

<!-- delete Doctor form -->
@foreach ($doctors as $doctor)
    <div class="modal fade" id="deleteModal-{{ $doctor->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/admin/doctorList/{{ $doctor->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end delete Doctor form -->

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
</script>


@endsection