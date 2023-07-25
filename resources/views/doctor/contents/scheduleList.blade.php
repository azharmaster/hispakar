@extends('layouts.doctor')

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
                    <i class="fas fa-solid fa-calendar bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Schedule</h5>
                        <span>Below is the list of schedule.</span>
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
                            <a href="/doctor/scheduleList">Schedule</a>
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
                                    <h5 id="tableTitle">List of Doctor Schedule</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" 
                                        data-target="#addModal-schedule" title="Add Schedule">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Day</th>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( $schedules->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach($schedules as $schedule)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $schedule->day }}</td>
                                                            <td>{{ $schedule->date }}</td>
                                                            <td>{{ $schedule->starttime }}</td>
                                                            <td>{{ $schedule->endtime }}</td>
                                                            <td>
                                                                <a title="Edit Schedule" data-toggle="modal" data-target="#editModal-schedule-{{ $schedule->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/doctor/scheduleList/{{ $schedule->id }}" title="Delete Schedule" data-toggle="modal" data-target="#deleteModal-schedule-{{ $schedule->id }}">
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

<!-- Add Schedule form -->
<div class="modal fade" id="addModal-schedule" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/doctor/scheduleList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                   
                    <input type="hidden" value="{{ $doctorId }}" name="docid">

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Day :</span>
                        <select class="form-control" style="width:350px;" name="day">
                            <option value="">Choose day</option>
                            <option value="Sunday" {{ $currentDay === 0 ? 'selected' : '' }}>Sunday</option>
                            <option value="Monday" {{ $currentDay === 1 ? 'selected' : '' }}>Monday</option>
                            <option value="Tuesday" {{ $currentDay === 2 ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wednesday" {{ $currentDay === 3 ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thursday" {{ $currentDay === 4 ? 'selected' : '' }}>Thursday</option>
                            <option value="Friday" {{ $currentDay === 5 ? 'selected' : '' }}>Friday</option>
                            <option value="Saturday" {{ $currentDay === 6 ? 'selected' : '' }}>Saturday</option>
                        </select>
                    </div>  

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <input type="date" style="width:350px;" class="form-control" name="date" id="date" placeholder="">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Start Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="starttime" id="starttime" placeholder="">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">End Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="endtime" id="endtime" placeholder="">
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
<!-- end Add Schedule form -->

<!-- Edit Schedule form -->
@foreach( $schedules as $schedule )
<div class="modal fade" id="editModal-schedule-{{ $schedule->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/doctor/scheduleList/{{ $schedule->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                              
                    <input type="hidden" value="{{ $schedule->docid }}" name="docid">

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Day :</span>
                        <select class="form-control" style="width:350px;" name="day">
                            <option value="">Choose day</option>
                            <option value="Sunday" {{ $schedule->day === 'Sunday' ? 'selected' : '' }}>Sunday</option>
                            <option value="Monday" {{ $schedule->day === 'Monday' ? 'selected' : '' }}>Monday</option>
                            <option value="Tuesday" {{ $schedule->day === 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wednesday" {{ $schedule->day === 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thursday" {{ $schedule->day === 'Thursday' ? 'selected' : '' }}>Thursday</option>
                            <option value="Friday" {{ $schedule->day === 'Friday' ? 'selected' : '' }}>Friday</option>
                            <option value="Saturday" {{ $schedule->day === 'Saturday' ? 'selected' : '' }}>Saturday</option>
                        </select>
                    </div>


                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <input type="date" style="width:350px;" class="form-control" name="date" id="date" value="{{ $schedule->date }}">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Start Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="starttime" id="starttime" value="{{ $schedule->starttime }}">
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">End Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="endtime" id="endtime" value="{{ $schedule->endtime }}">
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
@endforeach
<!-- end Edit Schedule form -->

<!-- delete Schedule Modal -->
@foreach( $schedules as $schedule )
<div class="modal fade" id="deleteModal-schedule-{{ $schedule->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 15px;"> Are you sure want to delete this schedule?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <form action="/doctor/scheduleList/{{ $schedule->id }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button name="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end delete Patient Modal -->

@endsection



