@extends('layouts.admin')

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
                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Patients Monitoring</h5>
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
                            <a href="/admin/patientMonitor">Patients Monitoring</a>
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
                            <div class="row">
                                <div class="col-3">
                                    <a data-toggle="modal" data-target="#totalpatientModal">
                                        <div class="card comp-card bg-c-blue doc-pro-right">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white ">Total Patients

                                                        </h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">{{ $totalPatients }}</h2>
                                                            <i class="fas fa-file-alt bg-c-white text-primary d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-3">
                                    <a data-toggle="modal" data-target="#totalpatientModal">
                                        <div class="card comp-card bg-c-green doc-pro-right">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white ">Average Age

                                                        </h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">{{ floor($averageAge) }}</h2>
                                                            <i class="fas fa-id-card bg-c-white text-success d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-3">
                                    <a data-toggle="modal" data-target="#totalpatientModal">
                                        <div class="card comp-card bg-c-yellow doc-pro-right"  style="height: 134px;">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white ">Common Gender

                                                        </h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                        <h2 class="f-w-700 text-white ml-3">{{ $mostCommonGender === 'female' ? 'F' : 'M' }}</h2>
                                                            <i class="fas fa-restroom bg-c-white text-warning d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white"></p>

                                                    </div>

                                                    <div class="col-auto">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-3">
                                    <a data-toggle="modal" data-target="#totalpatientModal">
                                        <div class="card comp-card bg-info doc-pro-right" style="height: 134px;">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white ">Average BPM

                                                        </h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">90</h2>
                                                            <i class="fas fa-file-alt bg-c-white text-info d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->

                               
                                <!-- ./card -->
                            </div>
                            <!-- Start Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 id="tableTitle">List of Patient</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                   
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>IC</th>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th>Height</th>
                                                    <th>Weight</th>
                                                    <th>BMI</th>
                                                    <th>BPM</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( $patients->isEmpty() )
                                                    <tr>
                                                        <td>No data available</td>
                                                    </tr>
                                                @else
                                                    @foreach($patients as $patient)
                                                        <tr style="text-align: center;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $patient->name }}</td>
                                                            <td>{{ $patient->ic }}</td>
                                                            <td>{{ $patient->age }}</td>
                                                            <td>{{ ucfirst($patient->gender) }}</td>
                                                            <td>{{ $patient->height }}</td>
                                                            <td>{{ $patient->weight }}</td>
                                                            <td>
                                                                @php
                                                                    $bmi = $patient->weight / (($patient->height / 100) ** 2);
                                                                    $bmiCategory = '';

                                                                    if ($bmi < 18.5) {
                                                                        $bmiCategory = 'Underweight';
                                                                    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
                                                                        $bmiCategory = 'Normal';
                                                                    } elseif ($bmi >= 25 && $bmi < 29.9) {
                                                                        $bmiCategory = 'Overweight';
                                                                    } else {
                                                                        $bmiCategory = 'Obese';
                                                                    }
                                                                @endphp

                                                                <!-- {{ number_format($bmi, 1) }} ({{ $bmiCategory }}) -->
                                                                {{ $bmiCategory }}

                                                            </td>
                                                            <td>90</td>
                                                            
                                                            <td>
                                                                <a href="/admin/patientProfile/{{ $patient->id }}" title="View Patient">
                                                                    <i style="font-size:20px;" class="feather icon-eye f-w-600 f-16 m-r-15 text-c-yellow "></i>
                                                               
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

@endsection



