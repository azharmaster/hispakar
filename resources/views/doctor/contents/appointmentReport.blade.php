@extends('layouts.doctor')

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
                    <i class="fas fa-regular fa-hospital-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Check Up Report</h5>
                        <span>Below is the list of all patients.</span>
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
                            <a href="/doctor/appointmentReport/{{ $appointment->id }}">Check Up</a>
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
                            <!-- Start Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 id="tableTitle">Patient Info</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-warning d-block mx-auto float-right" data-toggle="modal" 
                                        data-target="#editModal-patient-{{ $singlePatient->id }}" title="View Patient">
                                        <i class="fas fa-solid fa-eye"></i>
                                            View
                                    </button>

                                </div>
                                <div class="card-block">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                                        <th>Birth Date</th>
                                        <td>{{ $appointment->patient->dob }}</td>

                                    </tr>

                                    <tr>
                                        <th>Weight</th>
                                        <td>{{ $appointment->patient->weight }} kg</td>
                                        <th>Height</th>
                                        <td>{{ $appointment->patient->height }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Medical History</th>
                                        <td colspan="3">
                                            @if ($appointment->medrecord->count() > 0)
                                                @foreach ($appointment->medrecord as $medrecord)
                                                    {{ $medrecord->desc }}<br>
                                                @endforeach
                                            @else
                                                No medical history available
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Prescribed Medication</th>
                                        <td colspan="3">
                                            <ul>
                                                @if ($appointment->medrecords && $appointment->medrecords->count() > 0)
                                                    @foreach ($appointment->medrecords as $medrecord)
                                                        <li>{{ $medrecord->medication }}</li>
                                                    @endforeach
                                                @else
                                                    <li>No prescribed medication</li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>


                                </table>

    
                                </div>
                            <!-- End table -->
                        </div>
                    </div>
    
                    <div class="col-sm-12">
                        <!-- Start Card -->
                        <div class="card">
                            <div class="card-block">
                            </div>
                            <form id="appointmentForm" action="{{ route('doctor.addAppointmentRecord', ['id' => $appointment->id]) }}" method="POST" >
                                {{csrf_field()}}

                                <input type="hidden" name="id" value="{{ $appointment->id }}">
                                <input type="hidden" name="patientid" value="{{ $appointment->patient->id }}">

                                <div class="card-header">
                                    <h5>Check Up Description</h5>
                                    <span>Description of Patient's health </span>
                                </div>

                                <div class="card-block">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Service Type</th>
                                            <td>
                                                <select class="form-control" name="serviceid">
                                                    @foreach ($medservices as $medservice)
                                                        <option value="{{ $medservice->id }}">{{ $medservice->type }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col">
                                            <textarea rows="5" cols="5" name="desc[med_record]" class="form-control" placeholder="Stomachache"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h5>Medicine Prescription</h5>
                                    <span>Medicines included</span>
                                </div>
                                <div class="card-block">
                                    <table class="table table-bordered" id="medTable">
                                        <tr>
                                            <th>Medicine 1</th>
                                            <td>
                                                <select class="form-control" name="medicines[id][]">
                                                    @foreach ($medicines as $medicine)
                                                        <option value="{{ $medicine->id }}:{{ $medicine->name }}">{{ $medicine->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="qty[]" placeholder="Quantity">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="desc[med_prescription][]" placeholder="Description">
                                            </td>
                                            <td class="text-align-center"><span onclick="deleteRow(this)"><i class="fas fa-trash-alt text-danger"></i></span></td>
                                        </tr>
                                    </table>
                                    <table style="display: none;">
                                        <tr id="medRowTemplate">
                                            <th>Medicine ${medNum}</th>
                                            <td>
                                                <select class="form-control" name="medicines[id][]">
                                                    @foreach ($medicines as $medicine)
                                                        <option value="{{ $medicine->id }}:{{ $medicine->name }}">{{ $medicine->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="qty[]" placeholder="Quantity">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="desc[med_prescription][]" placeholder="Description">
                                            </td>
                                            <td class="text-align-center"><span onclick="deleteRow(this)"><i class="fas fa-trash-alt text-danger"></i></span></td>
                                        </tr>
                                    </table>
                                    <div class="form-group row">
                                        <div class="col">
                                            <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" onclick="addMedRow()">
                                                Add Medicine
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="checkbox" id="scheduleNext" name="scheduleNext">
                                            <label class="col-form-label" for="scheduleNext">Schedule Next Appointment</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="date" id="dateInput" name="date" disabled>
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="time" id="timeInput" name="time" disabled>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <div class="col">
                                            <button name="submit" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End table -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- view patient details -->

@if(isset($singlePatient))
<div class="modal fade" id="editModal-patient-{{ $singlePatient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $singlePatient->id }}">

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                                <input type="text" class="form-control" name="ic" id="ic" value="{{ $singlePatient->ic }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $singlePatient->name }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" {{ $singlePatient->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $singlePatient->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                                <input type="text" class="form-control" name="phoneno" id="phoneno" value="{{ $singlePatient->phoneno }}">
                            </div> 
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ $singlePatient->dob }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Address :</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $singlePatient->address }}">
                            </div> 
                            
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Weight :</label>
                                <input type="float" class="form-control" name="weight" id="weight" value="{{ $singlePatient->weight }}">
                            </div> 
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Height :</label>
                                <input type="float" class="form-control" name="height" id="height" value="{{ $singlePatient->height }}">
                            </div> 

                            <div class="form-group">
                                <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type:</label>
                                <select class="form-control" name="bloodtype">
                                    <option value="A+" {{ $singlePatient->bloodtype === 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $singlePatient->bloodtype === 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $singlePatient->bloodtype === 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $singlePatient->bloodtype === 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ $singlePatient->bloodtype === 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ $singlePatient->bloodtype === 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ $singlePatient->bloodtype === 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ $singlePatient->bloodtype === 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $singlePatient->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif
<!--/view details -->

<script>
    var table = document.getElementById("medTable");
    let medNum = 1;

    function addMedRow() {
        medNum++;
        var row = table.insertRow(-1);
        row.innerHTML = `
            <th>Medicine ${medNum}</th>
            <td>
                <select class="form-control" name="medicines[id][]">
                    @foreach ($medicines as $medicine)
                        <option value="{{ $medicine->id }}:{{ $medicine->name }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" class="form-control" name="qty[]" placeholder="Quantity">
            </td>
            <td>
                <input type="text" class="form-control" name="desc[med_prescription][]" placeholder="Description">
            </td>
            <td class="text-align-center"><span onclick="deleteRow(this)"><i class="fas fa-trash-alt text-danger"></i></span></td>
        `;
    }

    function deleteRow(row) {
        var i = row.parentNode.parentNode.rowIndex;
        table.deleteRow(i);
    }

    function submitForm() {
        // Serialize the form data and submit the form
        var formData = new FormData(document.getElementById("appointmentForm"));
        fetch('/submitForm', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response if needed
            console.log(data);
        })
        .catch(error => {
            // Handle any errors that occurred during form submission
            console.error('Error submitting the form:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var scheduleNextCheckbox = document.getElementById('scheduleNext');
        var dateInput = document.getElementById('dateInput');
        var timeInput = document.getElementById('timeInput');

        scheduleNextCheckbox.addEventListener('change', function () {
            if (this.checked) {
                dateInput.disabled = false;
                timeInput.disabled = false;
            } else {
                dateInput.disabled = true;
                timeInput.disabled = true;
            }
        });
    });
</script>

@include('dup.patientModal')

@endsection
