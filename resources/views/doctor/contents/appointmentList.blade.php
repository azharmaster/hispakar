@extends('layouts.doctor')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
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
                            <a href="/doctor/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/doctor/appointmentList">Appointments</a>
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
                                    <div class="dt-responsive table-responsive" style="page-break-before:avoid;">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Dept Name</th>
                                                    <th>Date-Time</th>
                                                    <th>Description</th>
                                                    <th style="width: 100px;">Action</th>
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
                                                            <td>{{ $appointment->dept_name }}</td>
                                                            <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                                            <td>
                                                                @switch($appointment->status)
                                                                    @case(0)
                                                                        Pending
                                                                        @break
                                                                    @case(1)
                                                                        @if ($appointment->medrecord_status == 1)
                                                                            <span class="status badge badge-primary mb-2 align-top" style="font-size: 11px;">Done</span>
                                                                        @else
                                                                            Confirm
                                                                        @endif
                                                                        @break
                                                                    @case(2)
                                                                       
                                                                        <span class="status badge badge-danger mb-2 align-top" style="font-size: 11px;">Cancel</span>
                                                                        @break
                                                                    @default
                                                                        {{ $appointment->status }}
                                                                @endswitch
                                                            </td>

                                                            <td>
                                                                @if ($appointment->medrecord_status == 1)
                                                                    <a href="/doctor/report/{{ $appointment->refnum }}" title="View Medical Record">
                                                                        <i style="font-size:20px;" class="fas fa-eye f-w-600 f-16 m-r-15 text-c-yellow"></i>
                                                                    </a>

                                                                    <a href="/doctor/eappointmentReport/{{ $appointment->id }}" title="Edit Medical Record">
                                                                        <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                    </a>

                                                                @else
                                                                    <a href="/doctor/appointmentReport/{{ $appointment->id }}" title="Add Appointment Record">
                                                                        <i style="font-size:20px;" class="fas fa-file-signature f-w-600 f-16 m-r-15 text-c-blue"></i>
                                                                    </a>
                                                                    <!-- <a href="/doctor/appointmentList/{{ $appointment->id }}" title="Delete Room" data-target="#deleteModal-{{ $appointment->id }}" data-toggle="modal">
                                                                        <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red delete-btn"></i>
                                                                    </a> -->
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
            <form action="/doctor/appointmentList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}

                <div class="container-fluid">
                   
                    <!-- <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Patient :</span>
                        <select class="form-control" style="width:350px;" name="patientid">
                        <option value="">Choose Patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                    </div> -->

                    <div class="form-group input-group">
                        <input type="text" class="form-control" id="icSearch" style="width:150px;" placeholder="Search Patient IC">
                    </div>

                    <div class="patient-dropdown" style="display: none;">
                        <select class="form-control" id="patientDropdown">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" id="selectedPatientId" name="patientid" value="">

                    <br>

                    <!-- <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor :</span>
                        <select class="form-control" style="width:350px;" name="docid">
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        </select>
                    </div> -->

                    <input type="hidden" name="deptid" id="deptid" value="{{ $doctor->deptid }}">

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <select class="form-control" style="width:350px;" name="date" id="date" placeholder="">
                            <option value="0" disable selected>Choose Date</option>
                            @foreach ($doctorSchedule as $date)
                                <option value="{{ $date }}">{{ $date }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Time :</span>
                        <select class="form-control" style="width:350px;" name="time" id="time" placeholder="">
                            <option value="">Choose Time</option>
                         
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
            <form action="/doctor/appointmentList/{{ $appointment->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">

                <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Patient ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="patientid" id="patientid" value="{{ $appointment->patientid }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="docid" id="docid" value="{{ $appointment->docid }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Department ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="deptid" id="deptid" value="{{ $appointment->deptid }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Date :</span>
                        <input type="date" style="width:350px;" class="form-control" name="date" id="date" value="{{ $appointment->date }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Time :</span>
                        <input type="time" style="width:350px;" class="form-control" name="time" id="time" value="{{ $appointment->time }}">
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
                    <form action="/doctor/appointmentList/{{ $appointment->id }}" method="POST" style="display: inline">
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

<script>
    $(document).ready(function () {
        $('#date').change(function () {
            // Selected date
            var selectedDate = $(this).val();

            // Empty the time dropdown
            $('#time').find('option').not(':first').remove();

           // AJAX request
            $.ajax({
                url: '/doctor/getTimeSlots/' + selectedDate,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    var len = response.length;

                    if (len > 0) {
                        // Read data and create <option>
                        for (var i = 0; i < len; i++) {
                            var selectedTime = response[i];
                            var option = "<option value='" + selectedTime + "'>" + selectedTime + "</option>";
                            $("#time").append(option);
                        }
                    } else {
                        // Handle the case where no time slots are returned
                        $("#time").append("<option value=''>No time slots available</option>");
                        // You can also disable the dropdown or take any other action based on your requirements
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching time slots:', error);
                }
            });

        });
    });

</script>

<script>
    $(document).ready(function () {
        var selecting = false; // Flag to track if the user is actively selecting an option

        $('#icSearch').on('input', function () {
            var partialIC = $(this).val().trim().toLowerCase();
            var patientDropdown = $('#patientDropdown');

            // Clear previous options
            patientDropdown.empty();

            if (partialIC.length > 0) {
                // Filter patients based on partial IC
                var matchingPatients = <?php echo json_encode($patients->toArray()); ?>;

                matchingPatients = matchingPatients.filter(function (patient) {
                    return patient.ic.toLowerCase().startsWith(partialIC);
                });

                // Display matching patients in the dropdown
                if (matchingPatients.length > 0) {
                    for (var i = 0; i < matchingPatients.length; i++) {
                        var option = '<option value="' + matchingPatients[i].id + '">' +
                                        matchingPatients[i].name +
                                     '</option>';
                        patientDropdown.append(option);
                    }

                    // Show the dropdown
                    $('.patient-dropdown').show();
                    selecting = true; // Enable selecting when dropdown is shown

                    // Automatically select the first suggestion
                    var selectedId = matchingPatients[0].id;
                    $('#selectedPatientId').val(selectedId);
                } else {
                    // Add "Not Available" option when no matches are found
                    patientDropdown.append('<option value="Not Available">Not Available</option>');
                    selecting = false; // Disable selecting when no matches are found
                }
            } else {
                // Hide the dropdown if the search bar is empty
                $('.patient-dropdown').hide();
                selecting = false; // Disable selecting when search bar is empty
            }
        });

        // Handle selection from the dropdown
        $('#patientDropdown').mousedown(function () {
            selecting = true;
        }).change(function () {
            if (selecting) {
                var selectedId = $(this).val();
                // Set the selected patient ID in the hidden input field
                $('#selectedPatientId').val(selectedId);
                selecting = false;
            }
        });
    });
</script>

@endsection