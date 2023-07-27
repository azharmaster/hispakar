@extends('layouts.patient')

@section('content')

<!-- Success Alert -->
@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

<style>
    .card-header {
        display: flex;
        align-items: center;
    }

    .btn {
        margin: 0;
    }

</style>
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-layers bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Reports</h5>
                        <span>Below is the list of all reports.</span>
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
                            <a href="/doctor/reports">Reports</a>
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
                                <div class="card-header d-flex justify-content-between">
                                    <h5 id="tableTitle">List of Reports</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <div>
                                        <button type="button" class="btn btn-mat waves-effect waves-light btn-warning" data-toggle="modal" data-target="#filter" title="Add Doctor">
                                            <i class="fas fa-regular fa-filter"></i>
                                            Filter 
                                        </button>
                                        <!-- <button type="button" class="btn btn-mat waves-effect waves-light btn-primary ml-2" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                            <i class="fas fa-solid fa-plus"></i>
                                            Add
                                        </button> -->
                                    </div>
                                </div>

                                <div class="card-block">

                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th style="width:80px">Appointment ID</th>
                                                    <th>Patient Name</th>
                                                    <th style="width:80px">Service Type</th>
                                                    <th>Description</th>
                                                    <th>Date Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( $filteredReports->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach ($filteredReports as $report)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $report->aptid }}</td>
                                                            <td>{{ $report->name }}</td>
                                                            <td>
                                                                @php
                                                                    $serviceNames = [
                                                                        1 => 'X-Ray',
                                                                        2 => 'Check-up',
                                                                        3 => 'MRI (Magnetic Resonance Imaging)',
                                                                        4 => 'Blood testing',
                                                                        5 => 'Ultrasound',
                                                                        6 => 'CT scan (Computed Tomography)',
                                                                        7 => 'ECG (Electrocardiogram)',
                                                                        8 => 'Physical therapy',
                                                                        9 => 'Surgery',
                                                                        10 => 'Vaccinations',
                                                                        11 => 'Laboratory services',
                                                                        12 => 'Pharmacy services',
                                                                        13 => 'Emergency care',
                                                                        14 => 'Maternity and childbirth services',
                                                                        15 => 'Cardiac catheterization',
                                                                        16 => 'Endoscopy',
                                                                        17 => 'Dialysis',
                                                                        18 => 'Oncology (Cancer treatment)',
                                                                        19 => 'Respiratory therapy',
                                                                        20 => 'Occupational therapy',
                                                                        // Add more service IDs and their corresponding names here
                                                                    ];
                                                                @endphp
                                                                {{ $serviceNames[$report->serviceid] ?? '' }}
                                                            </td>
                                                            <td>{{ $report->desc }}</td>
                                                            <td>{{ $report->datetime }}</td>
                                                            
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

<!-- /.start filter modal-->
<div class="modal fade" id="filter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctor.reports.filter') }}" method="POST">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">Start Date :</span>
                            <input type="date" style="width:350px;" class="form-control" name="start_date" placeholder="dd/mm/yyyy" required>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:150px;">End Date :</span>
                            <input type="date" style="width:350px;" class="form-control" name="end_date" placeholder="dd/mm/yyyy" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button name="submit" class="btn btn-primary waves-effect waves-light">Filter</button>
                        
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.end filter modal-->


@endsection



