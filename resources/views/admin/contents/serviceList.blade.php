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
                        <h5>Services</h5>
                        <span>Below is the list of all Services.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="../admin/index.php"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="../admin/departmentList.php">Services</a> </li>
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
                                <h5 id="tableTitle" >List of Services</h5>
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
                                                    <th>Type</th>
                                                    <th>Desc</th>
                                                    <th>Charge</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                            @if ( $services->isEmpty() )
                                                        <tr>
                                                            <td>No data available</td>
                                                        </tr>
                                                    @else
                                                        @foreach($services as $service)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $service->type }}</td>
                                                            <td>{{ $service->desc }}</td>
                                                            <td>RM {{ $service->charge }}</td>
                                                            <td>
                                                                <a title="Edit service" data-toggle="modal" data-target="#editModal-{{ $service->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/admin/serviceList/{{ $service->id }}" title="Delete service" data-target="#deleteModal-{{ $service->id }}" data-toggle="modal">
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

<!-- Add service form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/admin/serviceList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Type :</span>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" placeholder="Check-up">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Desc :</span>
                        <!-- <input type="text" style="width:350px;" class="form-control" name="desc" id="desc" > -->
                        <textarea style="width:350px;" class="form-control" name="desc" id="desc" rows="4" cols="50" placeholder="Routine medical examination to assess a person's general health status."></textarea>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Charge :</span>
                        <input type="number" style="width:350px;" class="form-control" name="charge" id="charge" placeholder="RM 240">
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
<!-- end Add service form -->

<!-- Edit department form -->
@foreach ($services as $service)
<div class="modal fade" id="editModal-{{ $service->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/serviceList/{{ $service->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
              <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Department Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" value="{{ $service->type }}" placeholder="Cardiology">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Desc :</span>
                       
                        <textarea style="width:350px;" class="form-control" name="desc" id="desc" rows="4" cols="50"  
                        placeholder="Routine medical examination to assess a person's general health status.">{{ $service->desc }}</textarea>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Charge :</span>
                        <input type="number" style="width:350px;" class="form-control" name="charge" id="charge" value="{{ $service->charge }}" placeholder="Cardiology">
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
@foreach ($services as $service)
    <div class="modal fade" id="deleteModal-{{ $service->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this service?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/admin/serviceList/{{ $service->id }}" method="POST" style="display: inline">
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
