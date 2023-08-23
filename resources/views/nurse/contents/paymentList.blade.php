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

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style-1.css') }}">

<!-- Start Content -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-calendar-check bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Invoices</h5>
                        <span>Below is the list of all invoices.</span>
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
                            <a href="/nurse/paymentList">Invoices</a>
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
                                <h5 id="tableTitle" >List of Invoices</h5>
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
                                                <tr class="left">
                                                    <th style="width:10px">#</th>
                                                    <th style="width:10px">Invoice No</th>
                                                    <th>Patient Details</th>
                                                    <th >Medication</th>
                                                    <th style="width:10px">Total Cost</th>
                                                    <th style="width:10px">Method</th>
                                                    <th style="width:10px">Action</th>
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
                                                        <td>{{ $medrc->refnum }}</td>
                                                        <td>
                                                            {{ $medrc->patient->name }}aisyah binti zakaria<br>
                                                            {{ $medrc->patient->ic }}<br>
                                                        
                                                        </td>
                                                        <td>
                                                            
                                                            <ul class="ml-3" style="list-style-type: disc;">
                                                                <li>sabutamol</li>
                                                                <li>syrup</li>
                                                            </ul>
                                                            
                                                            
                                                            <br>
                                                            
                                                            <!-- Dah Ambik -->
                                                            @if ($medrc->medinvoice->medstatus == 1)
                                                                <span class="badge badge-primary">Received All</span>
                                                            <!-- Belum Ambik -->
                                                            @else
                                                                <span class="badge badge-warning">Pending Pickup</span>                                                               
                                                            @endif
                                                        </td>
                                                        <td>RM {{ number_format($medrc->medinvoice->totalcost, 2) }}</td>

                                                        <td>
                                                            <!-- Dah Bayar -->
                                                            @if ($medrc->medinvoice->method == "0") 
                                                                <span class="badge badge-warning">Pending Payment</span>
                                                            <!-- Belum Bayar -->
                                                             @else  
                                                                {{ $medrc->medinvoice->method}}
                                                            @endif
                                                        </td>

                                                        <td class="center"> 
                                                            <div class="d-flex justify-content-center">

                                                                <!-- if Patient belum settle bayar atau pickup -->
                                                                @if ($medrc->medinvoice->method == "0" || $medrc->medinvoice->medstatus == "0") <!-- Paid -->
                                                                    
                                                                    <!-- if Patient belum bayar -->
                                                                    @if ($medrc->medinvoice->method == "0")  
                                                                        <!-- Confirm Payment -->
                                                                        <a title="Payment" data-toggle="modal" data-target="#editModal-invoice-{{ $medrc->id }}">
                                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                        </a>

                                                                    <!-- if Patient dah bayar -->
                                                                    @else 
                                                                        <!-- Confirm pickup -->
                                                                        <a title="Pickup" data-toggle="modal" data-target="#editModal-pickup-{{ $medrc->id }}">
                                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                <!-- Download Appointment Record Icon -->
                                                                <a href="/nurse/report/{{ $medrc->refnum }}" title="Download Appointment Record">
                                                                    <i style="font-size:20px;" class="fas fa-download f-w-600 f-16 m-r-15 text-c-blue"></i>
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
                            <!-- End table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->

<!-- Add Patient Modal -->
@foreach($medrcs as $record)
<div class="modal fade" id="editModal-invoice-{{ $record->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="card">
            <div class="card-header">
                <h5>Payment Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            
            </div>
            <div class="card-block">
                <form action="/nurse/paymentList/{{ $record->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="payment">Are you confirm the patient make a payment?</label>
                    </div>
                    <input type="hidden" class="form-control" name="medrecordid" value="{{ $record->id }}">
                    <div class="form-group">
                        <input type="hidden" name="action" value="payment"><!-- this to declare form for payment -->
        
                        <label for="payment">Payment Method:</label>
                        <select name="method" class="form-control" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="Cash">Cash</option>
                            <option value="Online Banking">Online Banking</option>
                            <option value="Debit / Credit Card">Debit / Credit Card</option>
                            <option value="E-wallet">E-wallet</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Add Patient Modal -->

<!-- Add Patient Modal -->
<div class="modal fade" id="editModal-pickup-{{ $record->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="card">
            <div class="card-header">
                <h5>Pickup Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            
            </div>
            <div class="card-block">
                <form action="/nurse/paymentList/{{ $record->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="payment">Are you confirm the patient already pickup all the medicines?</label>
                    </div>
                    <input type="hidden" class="form-control" name="medrecordid" value="{{ $record->id }}">
                    <input type="hidden" class="form-control" name="medstatus" value="1">
                    <input type="hidden" name="action" value="pickup">
                    <div class="form-group">
                        list of medicine ....
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach  
<!-- end Add Patient Modal -->

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

