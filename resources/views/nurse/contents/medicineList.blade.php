@extends('layouts.nurse')

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
                            <a href="#">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Medicines</a>
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
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-Medicine" title="Add Medicine">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive" style="overflow-x: visible; width:100%">
                                        <table id="dataTable1" class="table table-bordered nowrap table-responsive-sm">
                                            <thead>
                                                <tr class="text-left">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th>Price/Item</th>
                                                    <th style="width: 97px; text-align: center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($medicines as $medicine)
                                                <tr class="text-center" >
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td style="white-space: normal; word-wrap: break-word;"class="text-left">{{ $medicine->name }}</td>
                                                    <td class="text-left">{{ $medicine->desc }}</td>
                                                    <td style="text-align: center;">{{ $medicine->stock }}</td>
                                                    <td>RM {{ number_format($medicine->price, 2) }}</td>
                                                    <td>
                                                        <a title="Edit Medicine" data-toggle="modal" data-target="#editModal-{{ $medicine->id }}">
                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a href="/nurse/medicineList/{{ $medicine->id }}" title="Delete Medicine" data-target="#deleteModal-{{ $medicine->id }}" data-toggle="modal">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red delete-btn"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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

<!-- Add Medicine form -->
<div class="modal fade" id="addModal-Medicine" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/nurse/medicineList">
            {{csrf_field()}}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Name :</span>
                            <input type="text" style="width:350px;" class="form-control mt-2" name="name" id="name" placeholder="Name" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Quantity :</span>
                            <input type="number" style="width:350px;" class="form-control mt-2" name="stock" id="stock" placeholder="Stock" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Price per item :</span>
                            <input type="text" style="width:350px;" class="form-control mt-2" name="price" id="address" placeholder="Price" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Description :</span>
                            <textarea rows="5" style="width:350px;" class="form-control mt-2" name="desc" id="desc" placeholder="Enter description.." required></textarea>
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
<!-- end Add Medicine form -->

<!-- Edit Medicine form -->
@foreach ($medicines as $medicine)
<!-- Add Medicine form -->
<div class="modal fade" id="editModal-{{ $medicine->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Medicines</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/nurse/medicineList/{{ $medicine->id }}" method="POST">
             @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $medicine->id }}">

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Name :</span>
                        <input type="text" style="width:350px;" class="form-control mt-2" name="name" id="name" placeholder="Name" value="{{ $medicine->name }}" required>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Quantity :</span>
                        <input type="number" style="width:350px;" class="form-control mt-2" name="stock" id="stock" placeholder="Stock" value="{{ $medicine->stock }}" required>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px;">Price per item :</span>
                        <input type="number" step="0.01" style="width: 350px;" class="form-control mt-2" name="price" id="price" placeholder="Price" value="{{ $medicine->price }}" required>
                    </div>                                          
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px;">Description :</span>
                        <textarea rows="5" style="width: 350px;" class="form-control mt-2" name="desc" id="desc" required>{{ $medicine->desc }}</textarea>
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
<!-- end edit Medicine form -->

<!-- delete Medicine form -->
@foreach ($medicines as $medicine)
    <div class="modal fade" id="deleteModal-{{ $medicine->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete medicine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this medicine?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/nurse/medicineList/{{ $medicine->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end delete Medicine form -->

@include('nurse.includes.dtScripts')

@endsection

