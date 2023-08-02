@extends('layouts.patient')

@section('content')


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
                            <a href="index.html">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="doctor.php">Appointments</a>
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
                                <h5 id="tableTitle" >List of Appointments</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <!-- <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button> -->
                                </div>
                                <div class="card-block">
                                
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Dept Name</th>
                                                    <th>Date-Time</th>
                                                    <th>Status</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if ( $appointments->isEmpty() )
                                                        <tr>
                                                            <td>No data available</td>
                                                        </tr>
                                                    @else
                                                        @foreach($appointments as $appointment)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $appointment->doctor_name }}</td>
                                                            <td>{{ $appointment->patient_name }}</td>
                                                            <td>{{ $appointment->dept_name }} </td>
                                                            <td>{{ $appointment->date }} {{ $appointment->time }} </td>
                                                            <td>
                                                            @if ($appointment->status === 0) Pending
                                                            @elseif ($appointment->status === 1) Confirm
                                                            @else Cancel  
                                                            @endif
                                                            </td>
                                                             <td>
                                                             @if ($appointment->appt_count > 0)
                                                                <span class="badge badge-success">Done</span>
                                                            @else 
                                                                @if($appointment->status === 2)
                                                                <span class="badge badge-danger">Cancel</span>
                                                                @else
                                                                    @if($appointment->date > '2023-07-25')
                                                                    <!-- <a href="/patient/appointmentList/{{ $appointment->id }}" title="Cancel Appointment" class="btn btn-danger" data-target="#cancelModal-{{ $appointment->id }}" data-toggle="modal">
                                                                    <i class="fas fa-times"></i></a> -->

                                                                    <a title="Cancel Appointment" data-toggle="modal" class="btn btn-danger" data-target="#cancelModal-{{ $appointment->id }}">
                                                                    <i class="fas fa-times"></i>
                                                                    </a>
                                                                    
                                                                    @else
                                                                    <span class="badge badge-success">Done weh</span>
                                                                    @endif
                                                                @endif
                                                            @endif
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


@foreach ($appointments as $appointment)
<!-- Edit Appointments form -->
<div class="modal fade" id="cancelModal-{{ $appointment->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Appointments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/patient/appointmentList/{{ $appointment->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">

                
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Reason :</span>
                        <textarea style="width:350px;" class="form-control" name="reason" rows="4" cols="50"></textarea>
                    </div>
                    
                    <span style="color:red">*Please call back to create your new appointment. Thank You.</span>
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
                url: '/patient/getDoctorSchedule/' + selectedDoctorId,
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

            // Set the start and end time for the time slots
            var startTime = moment('08:00 AM', 'hh:mm A');
            var endTime = moment('05:00 PM', 'hh:mm A');

            // Generate time slots with 30-minute intervals and add them to the time selection dropdown
            while (startTime.isBefore(endTime)) {
                var endTimeFormatted = moment(startTime).add(30, 'minutes');
                var formattedTime = startTime.format('h:mm A') + ' - ' + endTimeFormatted.format('h:mm A');
                $('#timeSelect').append('<option value="' + formattedTime + '">' + formattedTime + '</option>');
                startTime.add(30, 'minutes');
            }
        });
    });
</script>

<!--/script to get the doctor schedule -->

@endsection

