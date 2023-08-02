@extends('layouts.doctor')

@section('content')

<!-- Success Alert -->
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
                    <i class="fas fa-regular fa-pills bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Medicines</h5>
                        <span>Below is the list of all medicines.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/doctor/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/doctor/medicineList">Medicines</a>
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
                                    <h5 id="tableTitle">List of Medicines</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-medicine" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                    <table id="dataTable1" class="table table-bordered table-responsive-sm">
                                            <thead>
                                                <tr class="text-left">
                                                    <th style="width: 10px;">#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th >Quantity</th>
                                                    <th>Price/Item</th>
                                                    <th style="width: 10px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( $medicines->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach ($medicines as $medicine)
                                                        <tr class="text-left" >
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $medicine->name }}</td>
                                                            <td>{{ $medicine->desc }}</td>
                                                            <td class="text-center">{{ $medicine->stock }}</td>
                                                            <td class="text-center">RM {{ number_format($medicine->price, 2) }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-center">
                                                                    <!-- Edit Medicine Icon -->
                                                                    <a title="Edit Medicine" data-toggle="modal" data-target="#editModal-medicine-{{ $medicine->id }}">
                                                                        <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                    </a>
                                                                    
                                                                    <!-- Delete Medicine Icon -->
                                                                    <a title="Delete Medicine" data-target="#deleteModal-medicine-{{ $medicine->id }}" data-toggle="modal">
                                                                        <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red delete-btn"></i>
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

@include('dup.medicineModal')

@endsection

