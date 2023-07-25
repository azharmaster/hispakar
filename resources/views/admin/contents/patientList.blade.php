@extends('layouts.admin')

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
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-patient" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive" style="page-break-before:avoid;">
                                        <table id="dataTable1" class="table responsive table-bordered">
                                            <thead>
                                                <tr style="text-align: center;" style="page-break-inside: avoid;">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Contact No</th>
                                                    <th>Description</th>
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
                                                            <a title="Profile Doctor" data-toggle="modal" data-target="#profilepatient-{{ $patient->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-yellow"></i>
                                                                </a>
                                                                <a title="Edit Patient" data-toggle="modal" data-target="#editModal-patient-{{ $patient->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/admin/patientList/{{ $patient->id }}" title="Delete Patient" data-toggle="modal" data-target="#deleteModal-patient-{{ $patient->id }}">
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

@include('dup.patientModal')


@php
    $user = '';
    $userType = Auth::user()->usertype;

    if ($userType == 1) {
        $user = 'admin';
    } elseif ($userType == 2) {
        $user = 'doctor';
    } elseif ($userType == 3) {
        $user = 'nurse';
    } elseif ($userType == 4) {
        $user = 'patient';
    }
@endphp


<!-- end profile form -->
@foreach ($patients as $patient)
<div class="modal fade" id="profilepatient-{{ $patient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title">Profile Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            
            <div class="modal-body">
                <div class="container-fluid">
                <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-5">
                                        <img src="../files/assets/images/dr-1.jpg" width="170" alt="User-Profile-Image">
                                        </div>
                                        <div class="col-7">
                                            <h3>{{ $patient->name }} </h3>
                                            <hr>
                                            <span class="badge badge-warning">{{ $patient->height }} CM</span> <span class="badge badge-primary">{{ $patient->weight }} KG</span>
                                            <hr>
                                            <p class="mb-2"><i class="fas fa-phone mr-3 text-primary"></i>{{ $patient->phoneno }}</p>
                                            <i class="far fa-envelope mr-3 text-primary"></i><span>{{ $patient->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <div class="row">
                                <div class="col-12">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-blue">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Doctor Name</h5>

                                            <h4 class="f-w-700 text-white">12</h4>
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
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Operations</h5>
                                            <h4 class="f-w-700 text-white">12</h4>
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
                                            <h5 class="m-b-25 f-w-700 mb-4">Appointment </h5>
                                            <h4 class="f-w-700 text-success">12</h4>
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
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button name="submit" class="btn btn-success waves-effect waves-light ">Save changes</button>
            </div> -->
            
        </div>
    </div>
</div>
@endforeach
<!-- end profile form -->

@endsection



