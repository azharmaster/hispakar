@extends('layouts.nurse')

@section('content')
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>WELCOME NURSE</h5>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
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
                                            <h6 class="m-b-25 f-w-600">Active Rooms</h6>
                                            <h3 class="f-w-700 text-c-yellow">6</h3>
                                            <p class="m-b-0">Last Updated: 1 hour ago</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-eye bg-c-yellow"></i>
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
                                            <h6 class="m-b-25 f-w-600">Patients in Queue</h6>
                                            <h3 class="f-w-700 text-c-green">8</h3>
                                            <p class="m-b-0">Last Updated: 5 mins ago</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hospital-user bg-c-green"></i>
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
                                            <h6 class="m-b-25 f-w-600">Doctors</h6>
                                            <h3 class="f-w-700 text-c-blue">6</h3>
                                            <p class="m-b-0">Last Updated: 5 mins ago</p>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-stethoscope bg-c-blue"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Start Table -->
                        <div class="col-md-8">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Today's Appointments</h5>
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
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Desc</th>
                                                    <th>Room</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Haley Kennedy</td>
                                                    <td>24/6/23</td>
                                                    <td>10:30</td>
                                                    <td>Migraine</td>
                                                    <td><label class="label label-success label-lg">Room 5</label></td>
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>24/6/23</td>
                                                    <td>11:00</td>
                                                    <td>High Blood Pressure</td>
                                                    <td><label class="label label-success label-lg">Room 6</label></td>
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>24/6/23</td>
                                                    <td>11:30</td>
                                                    <td>Broken Limb follow up</td>
                                                    <td><label class="label label-success label-lg">Room 1</label></td>
                                                </tr>
                                                <tr>
                                                    <td>Jena Gaines</td>
                                                    <td>24/6/23</td>
                                                    <td>12:00</td>
                                                    <td>First Checkup</td>
                                                    <td><a href="" data-toggle="modal" data-target="#assign-modal"><label class="label label-warning label-lg">Assign Room</label></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Quinn Flynn</td>
                                                    <td>24/6/23</td>
                                                    <td>12:30</td>
                                                    <td>First checkup</td>
                                                    <td><a href="" data-toggle="modal" data-target="#assign-modal"><label class="label label-warning label-lg">Assign Room</label></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End table -->
    
                        <!-- Med Supply -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card latest-update-card">
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
                                                <div class="btn btn-danger m-1">Paracetemol</div>
                                                <div class="btn btn-warning m-1">Ibuprofen</div>
                                                <div class="btn btn-warning m-1">Antibiotics</div>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Med Supply -->
    
    
                        <!-- Start Table -->
                        <!-- <div class="col-md-6">
    -card">
    der">
    h5>
    eader-right">
    unstyled card-option">
    -opt"><i class="feather icon-chevron-left open-card-option"></i></li>
    ather icon-maximize full-card"></i></li>
    ather icon-minus minimize-card"></i></li>
    ather icon-refresh-cw reload-card"></i></li>
    ather icon-trash close-card"></i></li>
    ather icon-chevron-left open-card-option"></i></li>
    
    
    
    ck p-b-0">
    responsive">
    ble table-hover m-b-0">
    
    
    Name</th>
    e</th>
    ion</th>
    th>
    
    
    
    
    Kennedy</td>
    3-10:30</td>
     up</td>
    
    ="fa fa-check-circle text-success"></i>
    ="fa fa-times-circle text-danger"></i>
    
    
    
    Davidson</td>
    3-11:00</td>
    up</td>
    
    ="fa fa-check-circle text-success"></i>
    ="fa fa-times-circle text-danger"></i>
    
    
    
    n Hurst</td>
    3-11:30</td>
    up</td>
    
    ="fa fa-check-circle text-success"></i>
    ="fa fa-times-circle text-danger"></i>
    
    
    
    aines</td>
    3-12:00</td>
    up</td>
    
    ="fa fa-check-circle text-success"></i>
    ="fa fa-times-circle text-danger"></i>
    
    
    
    Flynn</td>
    3-12:30</td>
    up</td>
    
    ="fa fa-check-circle text-success"></i>
    ="fa fa-times-circle text-danger"></i>
    
    
    
    
    
    
    
    
                        <!-- End table -->
    
                        <!-- <div class="col-md-12 col-xl-6">
    rd">
    >
    ation</h5>
    
    
    
    art2" style="height: 300px; overflow: hidden; text-align: left;"></canvas>
    
    
    
    
    
    
    
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
    
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                                <div class="card-header">
                                    <h5>Patients by Department</h5>
                                </div>
                                <div class="card-block">
                                    <div>
                                        <canvas id="myChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Start Progress Row -->
                        <!-- <div class="col-xl-12">
    ogress-card">
    
    
    -md-6">
    6>
    0">532<span class="text-c-green m-l-10">+1.69%</span></h5>
    
     bg-c-red" style="width:25%"></div>
    
    
    -md-6">
    
    0">4,569<span class="text-c-red m-l-10">-0.5%</span></h5>
    
     bg-c-blue" style="width:65%"></div>
    
    
    -md-6">
    >
    0">89%<span class="text-c-green m-l-10">+0.99%</span></h5>
    
     bg-c-green" style="width:85%"></div>
    
    
    -md-6">
    
    0">365<span class="text-c-green m-l-10">+0.35%</span></h5>
    
     bg-c-yellow" style="width:45%"></div>
    
    
    
    
    
    
                        <!-- End Progress Row -->
    
    
    
                        <!-- Issues -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Major Issues</h5>
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
                                        <div class="latest-update-box">
                                            <div class="row p-t-20 p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-primary update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Rescheduled appointment</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-primary update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Referred to specialist</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-success update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Urgent Care</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-danger update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Your Manager Posted.</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row p-b-30">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-primary update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Showcases</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-auto text-right update-meta p-r-0">
                                                    <i class="b-success update-icon ring"></i>
                                                </div>
                                                <div class="col p-l-5">
                                                    <a href="#!">
                                                        <h6>Miscellaneous</h6>
                                                    </a>
                                                    <p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Latest Activity -->
    
                        <!-- <div class="col-xl-4 col-md-6">
    update-card">
    >
    
    right">
     card-option">
     class="feather icon-chevron-left open-card-option"></i></li>
    on-maximize full-card"></i></li>
    on-minus minimize-card"></i></li>
    on-refresh-cw reload-card"></i></li>
    on-trash close-card"></i></li>
    on-chevron-left open-card-option"></i></li>
    
    
    
    
    v" style="position: relative; overflow: hidden; width: auto; height: 290px;"><div class="scroll-widget" style="overflow: hidden; width: auto; height: 290px;">
    e-box">
    -b-30">
    t-right update-meta p-r-0">
    te-icon ring"></i>
    
    
    ent &amp; Update</h6></a>
    -0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
    
    
    
    t-right update-meta p-r-0">
    te-icon ring"></i>
    
    
    es</h6></a>
    -0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
    
    
    
    t-right update-meta p-r-0">
    te-icon ring"></i>
    
    
    aneous</h6></a>
    -0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
    
    
    
    t-right update-meta p-r-0">
    e-icon ring"></i>
    
    
    nager Posted.</h6></a>
    -0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
    
    
    
    t-right update-meta p-r-0">
    te-icon ring"></i>
    
    
    es</h6></a>
    -0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
    
    
    
    t-right update-meta p-r-0">
    te-icon ring"></i>
    
    
    aneous</h6></a>
    -0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
    
    
    
    rollBar" style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 186.475px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
    
    
    
    
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

<!-- Add Patient form -->
<div class="modal fade" id="assign-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">ID :</span>
                        <input type="text" style="width:350px;" class="form-control" name="id" id="id" placeholder="ABC1234" disabled>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="John Doe" disabled>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width: 150px;">Room No:</span>
                        <select class="form-control" style="width: 350px;" name="gender" id="gender">
                            <option value="room1">Room 1</option>
                            <option value="room2">Room 2</option>
                            <option value="room3">Room 3</option>
                            <option value="room4">Room 4</option>
                            <option value="room5">Room 5</option>
                            <option value="room6">Room 6</option>
                        </select>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Submit</button>

            </div>
        </div>
    </div>
</div>
<!-- end Add Patient form -->


<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade
        <br/>to any of the following web browsers to access this website.
    </p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="./files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="./files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="./files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="./files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="./files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
ndif]-->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min-1.js"></script>

<script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

<script src="../files/assets/pages/chart/float/jquery.flot-1.js"></script>
<script src="../files/assets/pages/chart/float/jquery.flot.categories-1.js"></script>
<script src="../files/assets/pages/chart/float/curvedLines-1.js"></script>
<script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min-1.js"></script>

<script src="../files/bower_components/chartist/js/chartist-1.js"></script>

<script src="../files/assets/pages/widget/amchart/amcharts-1.js"></script>
<script src="../files/assets/pages/widget/amchart/serial-1.js"></script>
<script src="../files/assets/pages/widget/amchart/light-1.js"></script>

<script src="../files/assets/js/pcoded.min-1.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min-1.js"></script>
<script type="text/javascript" src="../files/assets/pages/dashboard/custom-dashboard.min-1.js"></script>
<script type="text/javascript" src="../files/assets/js/script.min-1.js"></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Neurology', 'Oncology', 'Cardiology', 'Ophtalmology'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('myChart2');

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Neurology', 'Oncology', 'Cardiology', 'Ophtalmology'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 30],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
    });
</script>

@endsection