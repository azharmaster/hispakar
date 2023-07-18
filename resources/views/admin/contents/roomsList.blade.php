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
                        <h5>Rooms</h5>
                        <span>Below is the list of all rooms.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="../admin/index.php"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="../admin/roomsList.php">Rooms</a> </li>
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
                                <h5 id="tableTitle" >List of Room</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-room" title="Add Room">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-hover table-bordered nowrap">
                                            <thead>
                                                <tr class="text-left">
                                                    <th style="width: 10px;">#</th>
                                                    <th>Room Name</th>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th style="width: 10px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">
                                            @if ( $rooms->isEmpty() )
                                                <tr>
                                                    <td>No data available</td>
                                                </tr>
                                            @else
                                                @foreach($rooms as $room)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $room->name }}</td>
                                                    <td>{{ $room->type }}</td>
                                                    <td>{{ $room->desc }}</td>

                                                    @if ( $room->status == 1)
                                                        <td>Available</td> <!-- available -->
                                                    @else
                                                        <td>Not available</td>
                                                    @endif

                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <!-- Edit Room -->
                                                            <a title="Edit Room" data-toggle="modal" data-target="#editModal-room-{{ $room->id }}">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                            </a>
                                                            <!-- Delete Room -->
                                                            <a title="Delete Room" data-target="#deleteModal-room-{{ $room->id }}" data-toggle="modal">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="styleSelector"></div>

<!-- Add Room Modal -->
<div class="modal fade" id="addModal-room" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/admin/roomsList" class="form-horizontal row-fluid" method="POST" >
            {{csrf_field()}}

                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room type :</span>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" placeholder="eg. Operation Room" required>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Description :</span>
                        <textarea rows="2" style="width: 350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required></textarea>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Status :</span>
                        <select style="width:350px;" class="form-control" name="status" id="status" required>
                            <option value="1">Available</option>
                            <option value="0">Not available</option> 
                        </select>
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

<!-- Edit Room Modal-->
@foreach ($rooms as $room)
<div class="modal fade" id="editModal-room-{{ $room->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/roomsList/{{ $room->id }}" class="form-horizontal row-fluid" method="POST" >
            {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="{{ $room->name }}" placeholder="Name">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room type :</span>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" value="{{ $room->type }}" placeholder="eg. Operation Room">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">desc :</span>
                        <textarea rows="2" style="width: 350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required>{{ $room->desc }}</textarea>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Status :</span>
                        <select style="width:350px;" class="form-control" name="status" id="status">

                            @if ($room->status === 0)
                                <option value="{{ $room->status }}">Not available</option> 
                                <option value="1">Available</option> 
                            @else
                                <option value="{{ $room->status }}">Available</option> 
                                <option value="0">Not available</option> <!-- diguna / penuh -->
                            @endif

                        </select>
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

<!-- Delete Room Modal -->
@foreach ($rooms as $room)
    <div class="modal fade" id="deleteModal-room-{{ $room->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this room?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/admin/roomsList/{{ $room->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
