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
                    <i class="fas fa-solid fa-bed bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Department</h5>
                        <span>Below is the list of all department.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="../admin/index.php"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="../admin/departmentList.php">Departments</a> </li>
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
                                <h5 id="tableTitle" >List of Department</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add department">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-hover table-bordered nowrap">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Department Name</th>
                                                    <th>Desc</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                            @if ( $departments->isEmpty() )
                                                        <tr>
                                                            <td>No data available</td>
                                                        </tr>
                                                    @else
                                                        @foreach($departments as $department)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $department->name }}</td>
                                                            <td>{{ $department->desc }}</td>
                                                            <td>
                                                                <a title="Edit department" data-toggle="modal" data-target="#editModal-{{ $department->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/admin/departmentList/{{ $department->id }}" title="Delete department" data-target="#deleteModal-{{ $department->id }}" data-toggle="modal">
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
<!-- Add department form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/admin/departmentList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Department Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Cardiology">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Desc :</span>
                        <input type="text" style="width:350px;" class="form-control" name="desc" id="desc" placeholder="Department specialized in the diagnosis and treatment of heart diseases.">
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
<!-- end Add department form -->

<!-- Edit department form -->
@foreach ($departments as $department)
<div class="modal fade" id="editModal-{{ $department->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/departmentList/{{ $department->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
              <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Department Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="{{ $department->name }}" placeholder="Cardiology">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Desc :</span>
                        <input type="text" style="width:350px;" class="form-control" name="desc" id="desc" value="{{ $department->desc }}" placeholder="Department specialized in the diagnosis and treatment of heart diseases.">
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
@endforeach
<!-- end edit department form -->

<!-- delete department form -->
@foreach ($departments as $department)
    <div class="modal fade" id="deleteModal-{{ $department->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this department?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/admin/departmentList/{{ $department->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end delete department form -->


@endsection
