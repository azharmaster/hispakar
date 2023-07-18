@extends('layouts.nurse')

@section('content')

<!-- Success aler -->
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
                            <a href="/nurse/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="/nurse/patientList">
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
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-patient" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive" style="width:100%">
                                        <table id="dataTable1" class="table table-bordered table-responsive-sm">
                                            <thead class="text-left">
                                                <tr>
                                                    <th style="width: 10px;">#</th>
                                                    <th>Name</th>
                                                    <th>Contact No</th>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th style="width: 10px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">
                                                @if ( $patients->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach($patients as $patient)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $patient->name }}</td>
                                                            <td>{{ $patient->phoneno }}</td>
                                                            <td>{{ $patient->age }}</td>
                                                            <td>{{ $patient->gender }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <!-- Edit Room -->
                                                                    <a title="Edit Patient" data-toggle="modal" data-target="#editModal-patient-{{ $patient->id }}">
                                                                        <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                    </a>
                                                                    <!-- Delete Room -->
                                                                    <a title="Delete Patient" data-toggle="modal" data-target="#deleteModal-patient-{{ $patient->id }}">
                                                                        <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                                    </a>
                                                                </div>
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

@include('dup.patientModal')

@include('nurse.includes.dtScripts')

@endsection
