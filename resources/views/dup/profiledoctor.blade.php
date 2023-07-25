<!-- end profile form -->
@foreach ($doctors as $doctor)
<div class="modal fade" id="profiledoctor-{{ $doctor->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title">Profile Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            
            <div class="modal-body">
                <div class="container-fluid">
                <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-5">
                                        <img src="../files/assets/images/dr-1.jpg" width="170" alt="User-Profile-Image">
                                        </div>
                                        <div class="col-7">
                                            <h3>{{ $doctor->name }} </h3>
                                            <h6>{{ $doctor->dept_name }}</h6>
                                            <hr>
                                            <h6><i class="fas fa-graduation-cap text-primary mr-3"></i>{{ $doctor->education }}</h6>
                                            <hr>
                                            <p class="mb-2"><i class="fas fa-phone mr-3 text-primary"></i>{{ $doctor->phoneno }}</p>
                                            <i class="far fa-envelope mr-3 text-primary"></i><span>{{ $doctor->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <div class="row">
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-blue">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Total Patient</h5>

                                            <h4 class="f-w-700 text-white">{{ $doctor->record_count }}</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-hospital-user bg-c-white text-primary"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-green">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Experience</h5>
                                            <h4 class="f-w-700 text-white">10 years</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-briefcase bg-c-white text-success"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-green">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Operations</h5>
                                            <h4 class="f-w-700 text-white">{{ $doctor->operation_count}}</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-hospital bg-c-white text-success"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4">Appointment </h5>
                                            <h4 class="f-w-700 text-success">{{$doctor->appointment_count}}</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-plus bg-c-green"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                            <div class="card-header">
                            <h5>Patients by Age</h5>
                            </div>
                            <div class="card-block">
                                <div>
                                    <canvas id="myChart2" width="680" height="340" style="display: block; box-sizing: border-box; height: 272px; width: 544px;"></canvas>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="card sale-card">
                            <div class="card-header">
                            <h5>Operations per Month</h5>
                            </div>
                            <div class="card-block">
                                <div>
                                    <canvas id="myChart" width="680" height="340" style="display: block; box-sizing: border-box; height: 272px; width: 544px;"></canvas>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button name="submit" class="btn btn-success waves-effect waves-light ">Save changes</button>
            </div> -->
            
        </div>
    </div>
</div>
@endforeach
<!-- end profile form -->