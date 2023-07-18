@extends('layouts.nurse')

@section('content')

<!-- Success alert for adding doctor -->
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
                                <a href="/nurse/dashboard"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="/nurse/doctorList">Doctors</a> </li>
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
                                        <h5 id="tableTitle">List of Doctor</h5>
                                        <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                        <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-doctor" title="Add Doctor">
                                            <i class="fas fa-solid fa-plus"></i>
                                                Add
                                        </button>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="dataTable1" class="table table-bordered nowrap">
                                                <thead>
                                                    <tr class="text-left">
                                                        <th style="width: 10px;">#</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Specialization</th>
                                                        <th style="width: 10px;">Gender</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if ( $doctors->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach ($doctors as $doctor)
                                                    <tr class="text-left">
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $doctor->name }}</td>
                                                        <td>{{ $doctor->phoneno }}</td>
                                                        <td>{{ $doctor->email }}</td>
                                                        <td>{{ $doctor->specialization }}</td>
                                                        <td>{{ $doctor->gender}}</td>
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

@endsection