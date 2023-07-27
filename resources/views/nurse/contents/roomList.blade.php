@extends('layouts.nurse')

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
                            <a href="/nurse/dashboard"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/nurse/roomList">Rooms</a> </li>
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
                                    <h5 id="tableTitle">List of Room</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-room" title="Add Room">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive" style="width:100%">
                                        <table id="dataTable1" class="table table-bordered table-responsive-sm">
                                            <thead>
                                                <tr class="text-left">
                                                    <th style="width: 10px;">#</th>
                                                    <th>Room Name</th>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Person In Charge (PIC)</th>
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
                                                    <td>{{ $room->staff_id }}</td>

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

@include('dup.roomModal')

@endsection
