@extends('layouts.nurse')

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
                        <h5>Medical Record</h5>
                        <span>Below is the list of all Medical Record.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/nurse/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/nurse/medrecordList">Medical Record</a>
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
                                <h5 id="tableTitle" >List of Medical Record</h5>
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
                                                <tr class="center">
                                                    <th>#</th>
                                                    <th>Service Type</th>
                                                    <th>Description</th>
                                                    <th>Date Time</th>
                                                    <th>Visit Duration</th>
                                                    <th>Total Cost</th>
                                                    <th>Doctor</th>
                                                    <th>Action</th>
                                                    <!-- <th style="width: 80px;">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if ( $medrcs->isEmpty() )
                                                        <tr>
                                                            <td>No data available</td>
                                                        </tr>
                                                    @else
                                                        @foreach($medrcs as $medrc)
                                                        <tr class="left">
                                                            <td>{{ $loop->iteration }}</td>
                                                            
                                                            <td>{{ $medrc->medservice->type }}</td>
                                                            <td>{{ $medrc->desc }}</td>
                                                            <td class="center">{{ $medrc->datetime }}</td>
                                                            <td class="center">{{ $medrc->visit_duration }}</td>
                                                            <td>RM {{ number_format($medrc->medinvoice->totalcost, 2) }}</td>
                                                            <td>{{ $medrc->attendingDoctor->name }}</td>
                                                            <td class="center"> 
                                                                <a href="/nurse/report/{{ $medrc->refnum }}" title="Download Appointment Record">
                                                                    <i style="font-size:20px;" class="fas fa-download f-w-600 f-16 m-r-15 text-c-green"></i>
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

