@extends('layouts.nurse')

@section('content')

<style>
    td {
        white-space: normal;
        word-wrap: break-word;
    }
</style>

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
                            <a href="index.html">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="doctor.php">Medicines</a>
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
                                    <h5 >List of Medicines</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-Medicine" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive" style="overflow-x: visible; width:100%">
                                        <table id="" class="table table-bordered nowrap table-responsive-sm">
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
                                                        <a title="Edit Medicine" href="#" data-toggle="modal" data-target="#editModal">
                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a title="Delete Medicine" data-toggle="modal" data-target="#deleteModal">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
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
                            <input type="text" style="width:350px;" class="form-control mt-2" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Quantity :</span>
                            <input type="number" style="width:350px;" class="form-control mt-2" name="stock" id="stock" placeholder="Stock">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Price per item :</span>
                            <input type="text" style="width:350px;" class="form-control mt-2" name="price" id="address" placeholder="Price">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Description :</span>
                            <textarea rows="5" style="width:350px;" class="form-control mt-2" name="desc" id="desc" placeholder="Enter description.."></textarea>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Medicine</h5>
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
<!-- end edit Medicine form -->

<!-- delete Medicine form -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Medicine</h5>
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
<!-- end delete Medicine form -->

@include('nurse.includes.dtScripts')

@endsection

