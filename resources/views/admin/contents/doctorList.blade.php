@extends('layouts.admin')

@section('content')
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
                                <a href="../admin/index.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="../admin/doctorList.php">Doctors</a> </li>
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
                                        <h5>List of Doctor</h5>
                                        <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                        <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                            <i class="fas fa-solid fa-plus"></i>
                                                Add
                                        </button>
                                    </div>
                                    <div class="card-block">
                                   
                                    include('files.assets.printComponent')


                                            <div class="col-12">
                                                <h2 class="text-center mb-5"  id="tableTitle" hidden>
                                                    <b>List of Doctors</b>
                                                </h2>
                                            </div>
                                        <div class="dt-responsive table-responsive">
                                            <table id="dataTable1" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Speacialised</th>
                                                        <th>Contact No</th>
                                                        <th style="width: 80px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>1</td>
                                                        <td>1911</td>
                                                        <td>John Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>2</td>
                                                        <td>1912</td>
                                                        <td>John</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button> -->
                                                            <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fas fa-trash"></i>
                                                            </button> -->
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <td>3</td>
                                                        <td>1913</td>
                                                        <td>Doe</td>
                                                        <td>Heart Surgery</td>
                                                        <td>0199237856</td>
                                                        <td>
                                                            <a title="Edit Doctor" data-toggle="modal" data-target="#editModal">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <a title="Delete Doctor" data-toggle="modal" data-target="#deleteModal">
                                                                <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
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
</div>
    <div id="styleSelector"></div>
<!-- Add Doctor form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="id" id="id" placeholder="ABC1234">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="John Doe">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px; font-weight:bold;">Gender:</span>
                        <select class="form-control" style="width: 350px;" name="gender" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Address :</span>
                        <input type="text" style="width:350px;" class="form-control" name="address" id="address" placeholder="New York">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Contact :</span>
                        <input type="text" style="width:350px;" class="form-control" name="contact" id="contact" placeholder="0134567891">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Email :</span>
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
<!-- end Add Doctor form -->

<!-- Edit Doctor form -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="id" id="id" value="1">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="John Doe">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px; font-weight:bold;">Gender:</span>
                        <select class="form-control" style="width: 350px;" name="gender" id="gender" value="Male">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Address :</span>
                        <input type="text" style="width:350px;" class="form-control" name="address" id="address" value="Malaysia">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Contact :</span>
                        <input type="text" style="width:350px;" class="form-control" name="contact" id="contact" value="0199237856">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Email :</span>
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
<!-- end edit Doctor form -->

<!-- delete Doctor form -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Doctor</h5>
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
<!-- end delete Doctor form -->

@include('admin.includes.dtScripts')

@endsection