@extends('layouts.admin')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

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
                            <a href="/admin/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#!">Appointments</a>
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
                                    </button>-->
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
                                                        @php
                                                            $currentDate = now()->format('Y-m-d');
                                                        @endphp

                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $appointment->doctor_name }}</td>
                                                            <td>{{ $appointment->patient_name }}</td>
                                                            <td>{{ $appointment->dept_name }}</td>
                                                            <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                                            <td>
                                                            @if ($appointment->status === 0) Pending
                                                            @elseif ($appointment->status === 1) Confirm
                                                            @elseif ($appointment->status === 2) Reject
                                                            @else cancel
                                                            @endif
                                                            </td>
                                                             <td>
                                                                @if ($appointment->medrecord_status == 1)
                                                                    <span class="status badge badge-primary mb-2 align-top" style="font-size: 11px;">Done</span>

                                                                @elseif ($appointment->status == 2)
                                                                    <span class="status badge badge-danger mb-2 align-top" style="font-size: 11px;">Cancelled</span>

                                                                @elseif ($appointment->date < $currentDate)
                                                                    <span class="status badge badge-warning mb-2 align-top" style="font-size: 11px;">No Action</span>

                                                                @else
                                                                    <a title="Edit Appointment" data-toggle="modal" data-target="#editModal-{{ $appointment->id }}">
                                                                        <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                    </a>
                                                                    <a href="/admin/appointmentList/{{ $appointment->id }}" title="Delete Appointment" data-target="#deleteModal-{{ $appointment->id }}" data-toggle="modal">
                                                                        <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red delete-btn"></i>
                                                                    </a>
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
<div class="modal fade" id="editModal-{{ $appointment->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/appointmentList/{{ $appointment->id }}" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="form-group input-group">
                        <input type="text" class="form-control icSearch" style="width:150px;" placeholder="Search Patient IC">
                    </div>

                    <div class="patient-dropdown">
                        <select style="width:435px;" class="form-control patientDropdown" name="patientid">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}" {{ ( $patient->id == $appointment->patientid) ? 'selected' : '' }}> {{ $patient->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" class="selectedPatientId" name="selectedPatientId" value="">

                    <br>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor ID :</span>
                        <select class="js-example-data-array" style="width:450px;" name="docid">
                            <option value="0" disabled selected>Choose Doctor</option>
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
                    <h5 class="modal-title">Delete Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this appointment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/admin/appointmentList/{{ $appointment->id }}" method="POST" style="display: inline">
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
        var selecting = false; // Flag to track if the user is actively selecting an option

        $('.icSearch').on('input change', function () {
            var partialIC = $(this).val().trim();
            var patientDropdown = $(this).closest('.modal-body').find('.patientDropdown');
            var selectedPatientId = $(this).closest('.modal-body').find('.selectedPatientId');

            // Clear previous options
            patientDropdown.empty();

            if (partialIC.length > 0) {
                // Filter patients based on partial IC
                var matchingPatients = <?php echo json_encode($patients->toArray()); ?>;

                matchingPatients = matchingPatients.filter(function (patient) {
                    return patient.ic.startsWith(partialIC);
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
                    selectedPatientId.val(selectedId);
                } else {
                    // Add "Not Available" option when no matches are found
                    patientDropdown.append('<option value="Not Available">Not Available</option>');
                    selecting = false; // Disable selecting when no matches are found
                }
            } else {
                // Do not hide the dropdown if the search bar is empty
                selecting = false; // Disable selecting when search bar is empty

               // Check if there is a selected patient
                 if (selectedPatientId.val()) {
                    // Display the selected patient's name in the input field
                    var selectedPatientName = patientDropdown.find('option:selected').text();
                    $(this).val(selectedPatientName);
                }
            }
        });

        // Handle selection from the dropdown
        $('.patientDropdown').mousedown(function () {
            selecting = true;
        }).change(function () {
            if (selecting) {
                var selectedId = $(this).val();
                // Set the selected patient ID in the hidden input field
                $(this).closest('.modal-body').find('.selectedPatientId').val(selectedId);
                selecting = false;
            }
        });
    });
</script>

@endsection
