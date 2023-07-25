@extends('layouts.doctor')

@section('content')
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Welcome, Doctor {{ $name }}!</h5>
                        <span>Current room: Room 5</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/doctor/dashboard"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/doctor/dashboard">Dashboard</a> </li>
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
    
                        <div class="col-md-4">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Appointments</h6>
                                            <h3 class="f-w-700 text-c-blue"> {{ $totalApt }}</h3>
                                            <p class="m-b-0">Last Updated: {{ $timeDifference }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check bg-c-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Patients</h6>
                                            <h3 class="f-w-700 text-c-green">{{ $totalPatient }}</h3>
                                            <p class="m-b-0">Last Updated: {{ $timePDifference }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-plus-square bg-c-green"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="card comp-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-b-25">Nurses</h6>
                                            <h3 class="f-w-700 text-c-red">{{ $totalNurse }}</h3>
                                            <p class="m-b-0">Last Updated: {{ $timeNDifference }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-home bg-c-red"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="card new-cust-card">
                                <div class="card-header">
                                    <h5>Today's Appointment / {{ $currentDate }}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
    
                                <div class="card-block">
                                    @php
                                        $currentTime = \Carbon\Carbon::now('Asia/Kuala_Lumpur');
                                    @endphp

                                    @foreach ($aptDs as $aptD)
                                        @php
                                            // Convert the appointment time to Carbon objects for start and end times
                                            $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $aptD->time);
                                            $endTime = $startTime->copy()->addMinutes(30); // Assuming each appointment is 30 minutes

                                            // Check if the appointment is in the past, ongoing, or in the future
                                            $isPastAppointment = $currentTime->greaterThan($endTime);
                                            $isCurrentTimeInRange = $currentTime->between($startTime, $endTime);
                                        @endphp
                                        <div class="align-middle m-b-25">
                                            <a href="/doctor/appointmentList">
                                                <img src="../files/assets/images/avatar-2-1.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>{{ $aptD->name }}</h6>
                                                    <p class="text-muted m-b-0">Consultation</p>
                                                    <button class="status btn btn-sm 
                                                                @if ($isPastAppointment)
                                                                    btn-danger
                                                                @elseif ($isCurrentTimeInRange)
                                                                    btn-success
                                                                @else
                                                                    btn-warning
                                                                @endif
                                                                mb-2 align-top">
                                                        @if ($isPastAppointment)
                                                            Appointment Passed
                                                        @elseif ($isCurrentTimeInRange)
                                                            Now
                                                        @else
                                                            Next: {{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}
                                                        @endif
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <!-- Start Table -->
                        <div class="col-md-6">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>To Be Approved</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block p-b-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Patient Name</th>
                                                    <th>Date-Time</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Haley Kennedy</td>
                                                    <td>24/6/23-10:30</td>
                                                    <td>Follow up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>24/6/23-11:00</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>24/6/23-11:30</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jena Gaines</td>
                                                    <td>24/6/23-12:00</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Quinn Flynn</td>
                                                    <td>24/6/23-12:30</td>
                                                    <td>Check up</td>
                                                    <td>
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->
    
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Approval and Cancellation</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="myChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
    
    
    
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Patients Statistics</h5>
                                </div>
                                <div class="card-block">
                                    <div id="deal-analytic-chart" class="chart-shadow" style="height: 300px; overflow: hidden; text-align: left;">
                                        <div class="amcharts-main-div" style="position: relative; width: 100%; height: 100%;">
                                            <div class="amChartsLegend amcharts-legend-div" style="overflow: hidden; position: relative; text-align: left; width: 751px; height: 48px; cursor: default;"><svg version="1.1" style="position: absolute; width: 751px; height: 48px; top: 0.487499px; left: 0px;">
                                                    <desc>JavaScript chart by amCharts 3.21.5</desc>
                                                    <g transform="translate(48,10)">
                                                        <path cs="100,100" d="M0.5,0.5 L682.5,0.5 L682.5,37.5 L0.5,37.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0"></path>
                                                        <g transform="translate(0,11)">
                                                            <g cursor="pointer" aria-label="Market Days" transform="translate(0,0)">
                                                                <g>
                                                                    <path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#2ed8b6"></path>
                                                                    <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(17,8)"></circle>
                                                                </g><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(37,7)">
                                                                    <tspan y="6" x="0">Market Days</tspan>
                                                                </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(186,7)"> </text>
                                                                <rect x="32" y="0" width="153.67461395263672" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
                                                            </g>
                                                            <g cursor="pointer" aria-label="Market Days ALL" transform="translate(201,0)">
                                                                <g>
                                                                    <path cs="100,100" d="M0.5,8.5 L32.5,8.5" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#e95753"></path>
                                                                    <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(17,8)"></circle>
                                                                </g><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="start" transform="translate(37,7)">
                                                                    <tspan y="6" x="0">Market Days ALL</tspan>
                                                                </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(186,7)"> </text>
                                                                <rect x="32" y="0" width="153.67461395263672" height="18" rx="0" ry="0" stroke-width="0" stroke="none" fill="#fff" fill-opacity="0.005"></rect>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg></div>
                                            <div class="amcharts-chart-div" style="overflow: hidden; position: relative; text-align: left; width: 751px; height: 252px; padding: 0px; cursor: default; touch-action: auto;"><svg version="1.1" style="position: absolute; width: 751px; height: 252px; top: -0.5px; left: 0px;">
                                                    <desc>JavaScript chart by amCharts 3.21.5</desc>
                                                    <g>
                                                        <path cs="100,100" d="M0.5,0.5 L750.5,0.5 L750.5,251.5 L0.5,251.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0"></path>
                                                        <path cs="100,100" d="M0.5,0.5 L682.5,0.5 L682.5,201.5 L0.5,201.5 L0.5,0.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" transform="translate(48,20)"></path>
                                                    </g>
                                                    <g>
                                                        <g transform="translate(48,20)">
                                                            <g>
                                                                <path cs="100,100" d="M0.5,0.5 L0.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M0.5,201.5 L0.5,201.5 L0.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M76.5,0.5 L76.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M76.5,201.5 L76.5,201.5 L76.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M152.5,0.5 L152.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M152.5,201.5 L152.5,201.5 L152.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M227.5,0.5 L227.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M227.5,201.5 L227.5,201.5 L227.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M303.5,0.5 L303.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M303.5,201.5 L303.5,201.5 L303.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M379.5,0.5 L379.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M379.5,201.5 L379.5,201.5 L379.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M455.5,0.5 L455.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M455.5,201.5 L455.5,201.5 L455.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M530.5,0.5 L530.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M530.5,201.5 L530.5,201.5 L530.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M606.5,0.5 L606.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M606.5,201.5 L606.5,201.5 L606.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M682.5,0.5 L682.5,5.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(0,201)"></path>
                                                                <path cs="100,100" d="M682.5,201.5 L682.5,201.5 L682.5,0.5" fill="none" stroke-width="1" stroke-dasharray="1" stroke-opacity="0.1" stroke="#000000"></path>
                                                            </g>
                                                        </g>
                                                        <g transform="translate(48,20)" visibility="hidden"></g>
                                                        <g transform="translate(48,20)" visibility="visible">
                                                            <g>
                                                                <path cs="100,100" d="M0.5,201.5 L6.5,201.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M0.5,134.5 L6.5,134.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M0.5,67.5 L6.5,67.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)"></path>
                                                            </g>
                                                            <g>
                                                                <path cs="100,100" d="M0.5,0.5 L6.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(-6,0)"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g transform="translate(48,20)" clip-path="url(#AmChartsEl-43)">
                                                        <g visibility="hidden"></g>
                                                    </g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g>
                                                        <g transform="translate(48,20)">
                                                            <g></g>
                                                            <g clip-path="url(#AmChartsEl-45)">
                                                                <path cs="100,100" d="M38.5,194.8 L114.5,134.5 L189.5,147.9 L265.5,101 L341.5,87.6 L417.5,20.6 L493.5,47.4 L568.5,101 L644.5,67.5 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#2ed8b6" stroke-linejoin="round"></path>
                                                            </g>
                                                            <clipPath id="AmChartsEl-45">
                                                                <rect x="0" y="0" width="682" height="201" rx="0" ry="0" stroke-width="0"></rect>
                                                            </clipPath>
                                                            <g></g>
                                                        </g>
                                                        <g transform="translate(48,20)">
                                                            <g></g>
                                                            <g clip-path="url(#AmChartsEl-46)">
                                                                <path cs="100,100" d="M38.5,168 L114.5,107.7 L189.5,114.4 L265.5,80.9 L341.5,101 L417.5,80.9 L493.5,80.9 L568.5,134.5 L644.5,101 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="0.9" stroke="#e95753" stroke-linejoin="round"></path>
                                                            </g>
                                                            <clipPath id="AmChartsEl-46">
                                                                <rect x="0" y="0" width="682" height="201" rx="0" ry="0" stroke-width="0"></rect>
                                                            </clipPath>
                                                            <g></g>
                                                        </g>
                                                    </g>
                                                    <g></g>
                                                    <g>
                                                        <g>
                                                            <path cs="100,100" d="M0.5,0.5 L682.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(48,221)"></path>
                                                        </g>
                                                        <g>
                                                            <path cs="100,100" d="M0.5,0.5 L0.5,201.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(48,20)" visibility="hidden"></path>
                                                        </g>
                                                        <g>
                                                            <path cs="100,100" d="M0.5,0.5 L0.5,201.5" fill="none" stroke-width="1" stroke-opacity="0.3" stroke="#000000" transform="translate(48,20)" visibility="visible"></path>
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g transform="translate(48,20)" clip-path="url(#AmChartsEl-44)" style="pointer-events: none;">
                                                            <path cs="100,100" d="M0.5,0.5 L0.5,0.5 L0.5,201.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" visibility="hidden" transform="translate(493,0)"></path>
                                                            <path cs="100,100" d="M0.5,0.5 L682.5,0.5 L682.5,0.5" fill="none" stroke-width="1" stroke-opacity="0.2" stroke="#000000" visibility="hidden" transform="translate(0,53)"></path>
                                                        </g>
                                                        <clipPath id="AmChartsEl-44">
                                                            <rect x="0" y="0" width="682" height="201" rx="0" ry="0" stroke-width="0"></rect>
                                                        </clipPath>
                                                    </g>
                                                    <g></g>
                                                    <g>
                                                        <g transform="translate(48,20)">
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(38,194) scale(1)" aria-label="Market Days Jan 16, 2013 71.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(114,134) scale(1)" aria-label="Market Days Jan 17, 2013 80.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(189,147) scale(1)" aria-label="Market Days Jan 18, 2013 78.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(265,101) scale(1)" aria-label="Market Days Jan 19, 2013 85.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(341,87) scale(1)" aria-label="Market Days Jan 20, 2013 87.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(417,20) scale(1)" aria-label="Market Days Jan 21, 2013 97.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(493,47) scale(1)" aria-label="Market Days Jan 22, 2013 93.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(568,101) scale(1)" aria-label="Market Days Jan 23, 2013 85.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#2ed8b6" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(644,67) scale(1)" aria-label="Market Days Jan 24, 2013 90.00"></circle>
                                                        </g>
                                                        <g transform="translate(48,20)">
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(38,168) scale(1)" aria-label="Market Days ALL Jan 16, 2013 75.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(114,107) scale(1)" aria-label="Market Days ALL Jan 17, 2013 84.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(189,114) scale(1)" aria-label="Market Days ALL Jan 18, 2013 83.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(265,80) scale(1)" aria-label="Market Days ALL Jan 19, 2013 88.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(341,101) scale(1)" aria-label="Market Days ALL Jan 20, 2013 85.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(417,80) scale(1)" aria-label="Market Days ALL Jan 21, 2013 88.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(493,80) scale(1)" aria-label="Market Days ALL Jan 22, 2013 88.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(568,134) scale(1)" aria-label="Market Days ALL Jan 23, 2013 80.00"></circle>
                                                            <circle r="4" cx="0" cy="0" fill="#FFFFFF" stroke="#e95753" fill-opacity="1" stroke-width="2" stroke-opacity="1" transform="translate(644,101) scale(1)" aria-label="Market Days ALL Jan 24, 2013 85.00"></circle>
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g></g>
                                                    </g>
                                                    <g>
                                                        <g transform="translate(48,20)" visibility="visible"><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(37.88888893761431,213.5)">
                                                                <tspan y="6" x="0">Jan 16</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(113.88888893761431,213.5)">
                                                                <tspan y="6" x="0">Jan 17</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(189.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 18</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(264.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 19</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(340.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 20</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(416.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 21</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(492.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 22</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(567.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 23</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="middle" transform="translate(643.8888889376143,213.5)">
                                                                <tspan y="6" x="0">Jan 24</tspan>
                                                            </text></g>
                                                        <g transform="translate(48,20)" visibility="hidden"></g>
                                                        <g transform="translate(48,20)" visibility="visible"><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,199.69999980926514)">
                                                                <tspan y="6" x="0">70</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,132.69999980926514)">
                                                                <tspan y="6" x="0">80</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,65.69999980926514)">
                                                                <tspan y="6" x="0">90</tspan>
                                                            </text><text y="6" fill="#000000" font-family="Verdana" font-size="11px" opacity="1" text-anchor="end" transform="translate(-12,-1.3000001907348633)">
                                                                <tspan y="6" x="0">100</tspan>
                                                            </text></g>
                                                    </g>
                                                    <g></g>
                                                    <g transform="translate(48,20)"></g>
                                                    <g></g>
                                                    <g></g>
                                                    <clipPath id="AmChartsEl-43">
                                                        <rect x="-1" y="-1" width="684" height="203" rx="0" ry="0" stroke-width="0"></rect>
                                                    </clipPath>
                                                </svg><a href="http://www.amcharts.com/javascript-charts/" title="JavaScript charts" style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 53px; top: 25px;">JS chart by amCharts</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Med Supply -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card latest-update-card card-outline card-border-primary custom-thinner-outline"  style="height: 450px">
                                <div class="card-header">
                                    <h5>Medicine Supply</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>
                                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">
                                    <div class="scroll-widget">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <!-- define color -->
                                                @php $colors = ['danger', 'warning']; $counter = 0; @endphp 

                                                <!-- loop medicine -->
                                                @foreach($medicines as $medicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $medicine->id }}"
                                                class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $medicine->name }}</a>
                                                
                                                <!-- increment for color -->
                                                @php $counter++; @endphp 
                                                
                                                @endforeach

                                                <!-- dummy -->
                                                @foreach($medicines as $medicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $medicine->id }}"
                                                class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $medicine->name }}</a>
                                                <!-- increment for color -->
                                                @php $counter++; @endphp 
                                                @endforeach
                                                <!-- ./dummy -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0" style="position: absolute; bottom: 0; left: 0; right: 0;">
                                        <a href="/doctor/medicineList" class="btn btn-primary2 waves-effect" data-dismiss="modal">See All</a>
                                    </div>
                                </div>
                                <!-- End card block-->
                            </div>
                            <!-- End card -->
                        </div>   
                        <!-- End col Med Supply -->
    

                        <!-- Calendar -->
                        <div class="col-xl-8 col-md-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="m-b-5">Calendar</h5>
                                    <div class="card-block p-b-0">
                                        <div class="row m-b-50">
                                            <div class="col">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Calendar -->
    
    
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="styleSelector">
</div>

<!-- View Medicine Modal -->
@foreach ($medicines as $medicine)
<div class="modal fade" id="viewModal-medicine-{{ $medicine->id }}" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content card-outline card-border-primary">
              <div class="modal-header border-0">
                  <h5 class="modal-title">Medicine</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-responsive" >
                        <tr>
                          <th>Name</th>
                          <td>{{ $medicine->name }}</td>
                        </tr>
                        <tr>
                          <th>Stock left</th>
                          <td>{{ $medicine->stock }}</td>
                        </tr>
                        <tr>
                          <th>Price per item</th>
                          <td>RM {{ number_format($medicine->price, 2) }}</td>
                        </tr>
                        <tr>
                          <th>Description</th>
                          <td>{{ $medicine->desc }}</td>
                        </tr>
                    </table>
                </div>
              </div>

              <div class="modal-footer border-0" style="margin-top: -12px">
                  <button type="button" class="btn btn-primary2 waves-effect " data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
@endforeach
<!-- bbh -->

@endsection