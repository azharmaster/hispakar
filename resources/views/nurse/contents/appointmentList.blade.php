@extends('layouts.nurse')

@section('content')

<!-- Success Alert -->
@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

<!-- Start Content -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-calendar-check bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Appointments</h5>
                        <span>Below is the list of all appointments.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/patient/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/patient/appointmentList">Appointments</a>
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
                                <h5 id="tableTitle">List of Appointments</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button>
                                </div>
                                <div class="card-block">
                                
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead class="text-left">
                                                <tr>
                                                    <th style="width: 10px;">#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Dept Name</th>
                                                    <th>Date-Time</th>
                                                    <th>Status</th>
                                                    <th style="width: 10px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-left">
                                            @if ( $appointments->isEmpty() )
                                                        <tr>
                                                            <td>No data available</td>
                                                        </tr>
                                                    @else
                                                        @foreach($appointments as $appointment)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $appointment->doctor_name }}</td>
                                                            <td>{{ $appointment->patient_name }}</td>
                                                            <td>{{ $appointment->dept_name }}</td>
                                                            <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                                            <td>
                                                                @if ($appointment->status === 1) 
                                                                    Confirm
                                                                @elseif ($appointment->status === 2)  
                                                                    Cancel
                                                                @else
                                                                    Pending
                                                                     
                                                                @endif
                                                            </td>
                                                             <td>
                                                             <a title="Edit Appointment" data-toggle="modal" data-target="#editModal-{{ $appointment->id }}">
                                                                    <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                </a>
                                                                <a href="/admin/appointmentList/{{ $appointment->id }}" title="Delete Appointment" data-target="#deleteModal-{{ $appointment->id }}" data-toggle="modal">
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
                            <!-- End table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->

<!-- Add Appointments form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Appointments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/nurse/appointmentList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                   
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Patient :</span>
                        <select class="form-control" style="width:350px;" name="patientid">
                        <option value="">Choose Patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <!-- Doctor Selection Dropdown -->
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor :</span>
                        <select class="form-control" style="width:350px;" name="docid" id="doctorSelect">
                            <option value="">Choose Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="deptid" id="deptid" value="{{ $nurse->deptid }}">

                     <!-- Date Selection Dropdown -->
                     <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <select class="form-control" style="width:350px;" name="date" id="dateSelect">
                            <!-- Dates will be populated dynamically using JavaScript -->
                        </select>
                    </div>

                    <!-- Add a loading spinner in the time selection dropdown -->
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px;">Time :</span>
                        <select class="form-control" style="width: 350px;" name="time" id="timeSelect">
                            <!-- Times will be populated dynamically using JavaScript -->
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    <input type="hidden" name="status" id="status">
                    
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
<!-- end Add Appointments form -->


@foreach ($appointments as $appointment)
<!-- Edit Appointments form -->
<div class="modal fade" id="editModal-{{ $appointment->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Appointments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/nurse/appointmentList/{{ $appointment->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">

                <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Patient ID :</span>
                        <select style="width:350px;" class="form-control" name="patientid">
                        <option>Select Patient</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" {{ ( $patient->id == $appointment->patientid) ? 'selected' : '' }}> {{ $patient->name }} </option>
                        @endforeach   
                     </select>
                        
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor ID :</span>
                        <select style="width:350px;" class="form-control" name="docid">
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ ( $doctor->id == $appointment->docid) ? 'selected' : '' }}> {{ $doctor->name }} </option>
                        @endforeach   
                     </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Department ID :</span>
                       
                        <select style="width:350px;" class="form-control" name="deptid">
                        <option>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ ( $department->id == $appointment->deptid) ? 'selected' : '' }}> {{ $department->name }} </option>
                        @endforeach   
                     </select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <input type="date" style="width:350px;" class="form-control" name="date" id="date" value="{{ $appointment->date }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="time" id="time" value="{{ $appointment->time }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Status :</span>
                         <select style="width:350px;" class="form-control" name="status">
                            <option value="{{ $appointment->status }}" selected> @if ($appointment->status == 0) Cancel @else Confirm @endif </option>
                            <option value="0">Cancel</option>
                            <option value="1">Confirm</option>
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
<!-- end edit Patient form -->
@endforeach


<!-- delete Patient form -->
@foreach ($appointments as $appointment)
    <div class="modal fade" id="deleteModal-{{ $appointment->id }}" tabindex="-1" role="dialog">
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
                    <form action="/nurse/appointmentList/{{ $appointment->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- end delete Patient form -->

<!--script to get the doctor schedule -->
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    $(document).ready(function () {
        // Event handler for doctor selection dropdown
        $('#doctorSelect').change(function () {
            var selectedDoctorId = $(this).val();

            // Send an AJAX request to fetch the selected doctor's schedule
            $.ajax({
                url: '/nurse/getDoctorSchedule/' + selectedDoctorId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Populate the date selection dropdown with the fetched dates
                    var dateSelect = $('#dateSelect');
                    dateSelect.empty();
                    dateSelect.append('<option value="">Choose Date</option>');
                    $.each(data, function (index, value) {
                        dateSelect.append('<option value="' + value.date + '">' + value.date + '</option>');
                    });
                },
                error: function () {
                    alert('Error occurred while fetching the doctor schedule.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Event handler for date selection dropdown
        $('#dateSelect').change(function () {
            var selectedDate = $(this).val();

            // Clear any previous options in the time selection dropdown
            $('#timeSelect').empty();

            // Show a loading indicator while waiting for the AJAX response
            $('#timeSelect').append('<option value="">Loading...</option>');

            // Set the start and end time for the time slots
            var startTime = moment('08:00 AM', 'hh:mm A');
            var endTime = moment('05:00 PM', 'hh:mm A');

            // Generate time slots with 30-minute intervals and add them to the time selection dropdown
            while (startTime.isBefore(endTime)) {
                var endTimeFormatted = moment(startTime).add(30, 'minutes');
                var formattedTime = startTime.format('h:mm A') + ' - ' + endTimeFormatted.format('h:mm A');

                // Check if the current time slot is booked
                var isBooked = isTimeBooked(selectedDate, startTime.format('H:mm'), endTimeFormatted.format('H:mm'));
                if (!isBooked) {
                    $('#timeSelect').append('<option value="' + formattedTime + '">' + formattedTime + '</option>');
                }

                startTime.add(30, 'minutes');
            }
        });
    });

    function isTimeBooked(selectedDate, startTime, endTime) {
        var isBooked = false;

        // Send an AJAX request to check if the selected time slot is booked
        $.ajax({
            url: '/nurse/isTimeBooked',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                date: selectedDate,
                startTime: startTime,
                endTime: endTime
            },
            async: false,
            success: function (data) {
                isBooked = data.booked;
            },
            error: function () {
                alert('Error occurred while checking booked appointment times.');
            }
        });

        return isBooked;
    }
</script>

<!--/script to get the doctor schedule -->

@endsection

