<style>
    /* Height for screens larger than 768px / for full width */
    @media screen and (min-width: 768px) {
        .doc-pro-left {
            max-height: 372px;
        }
    }

    /* Height for screens smaller than 768px / responsive smaller screen */
    @media screen and (max-width: 767px) {
        .doc-pro-right {
            height: 197px;
        }

        .chartAttendance {
            max-width: 250px;
        }

        .chartByAge {
            margin-top: -1000px
        }
    }

    .hr-0 {
        border-bottom: none;
        border-top: none;
    }
</style>

@foreach($patientdetails as $patientdetail)
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Profile Patient</h5>
                        <span>{{ $patientdetail->name }}'s Profile </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/admin/patientList">Patient Details</a> </li>
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
                        <div class="col-12 col-sm-6">
                            <div class="card doc-pro-left">
                                <div class="card-block">
                                    <button type="button" class="btn btn-mat waves-effect waves-light  d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-patient" title="Add Doctor">
                                        <i class="fas fa-cog"></i>

                                    </button>
                                    

                                    <div class="row">

                                        <div class="col-6 mx-auto d-block col-sm-4">
                                            <!--profile picture -->
                                            <div class="parent-container2" style="width: 140px; height: 140px;">
                                                <div class="pic-holder" style="background-image: url({{ $patientdetail->image ? asset('storage/profilePic/' . $patientdetail->image) : asset('files/assets/images/profilePic/unknown.jpg') }}); border: 2px solid white;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-7 text-center text-sm-left">
                                            <h3 class="pt-3 mb-2 pt-sm-0 text-uppercase" style="word-wrap: break-word;">{{ $patientdetail->name }}</h3>
                                            <p><span class="badge badge-warning">{{ $patientdetail->height }} M</span> <span class="badge badge-primary">{{ $patientdetail->weight }} KG</span>
                                                <span class="badge badge-danger">{{ $patientdetail->bloodtype }} </span>
                                            </p>
                                            <hr>
                                            <h6><i class="fas fa-phone mr-3 text-primary"></i>{{ $patientdetail->phoneno }}</h6>
                                            <hr>
                                            <i class="far fa-envelope mr-3 text-primary"></i><span>{{ $patientdetail->email }}</span>


                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center text-sm-left">
                                            <hr>
                                            <h6 class="font-weight-bold" style="margin-top: px"><i title="experience" class="fas fa-medkit text-primary mr-3"></i>Address</h6>
                                            <p style="height: 60px; overflow: auto;">{{ $patientdetail->address }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <div class="row">
                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#totalpatientModal">
                                        <div class="card comp-card bg-c-blue doc-pro-right">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white ">Height

                                                        </h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">166</h2>
                                                            <i class="fas fa-ruler-vertical bg-c-white text-primary d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white">Height Record</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->

                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#todayAppointmentModal">
                                        <div class="card comp-card bg-c-green doc-pro-right ">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white">Weight</h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">65</h2>
                                                            <i class="fas fa-weight bg-c-white text-success d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white">Weight Record</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->
                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#medicalrecordModal">
                                        <div class="card comp-card bg-c-green doc-pro-right">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600 text-white">Heart Rate (BPM)</h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-white ml-3">90</h2>
                                                            <a type="button" data-toggle="modal" data-target="#addModal-datapatient"><i class="fas fa-heartbeat bg-c-white text-success d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                            <!-- <button type="button" class="btn btn-mat waves-effect waves-light  d-block mx-auto float-right" data-toggle="modal" data-target="#addModal-datapatient" title="Add Doctor">
                                        <i class="fas fa-cog"></i> -->
</a>

                                    
                                                        </div>

                                                        <p class="m-b-0 mt-3 text-white">Low Risk</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->

                                <div class="col-6">
                                    <a data-toggle="modal" data-target="#nextaptModal">
                                        <div class="card comp-card doc-pro-right">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="m-b-20 f-w-600">Sp02</h6>

                                                        <div class="row d-flex justify-content-between mt-4">
                                                            <h2 class="f-w-700 text-success ml-3">99</h2>
                                                            <i class="fas fa-thumbs-up bg-c-green d-none d-sm-block" style="margin-top: -8px; margin-right: -18px"></i>
                                                        </div>

                                                        <p class="m-b-0 mt-3">Sp02 Record</p>

                                                    </div>

                                                    <div class="col-auto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- ./card -->

                            </div>
                        </div>
                        <!-- ./profile details-->

                        <!-- Medicine -->

                        <div class="col-md-12 col-xl-6">
                            <div class="card latest-update-card">
                                <div class="card-header">
                                    <h5>Previous Medicine</h5>
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


                                                @php $colors = ['danger', 'warning']; $counter = 0; @endphp

                                                <!-- loop medicine -->
                                                @foreach($listmedicines as $listmedicine)
                                                <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $listmedicine->id }}" class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $listmedicine->name }}</a>

                                                <!-- increment for color -->
                                                @php $counter++; @endphp

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--chart -->

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

                        <!-- Start Table -->
                        <div class="col-md-12">


                            <div class="card table-card history">
                                <div class="card-header">
                                    <h5>History</h5>
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
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                @foreach ($appointments as $appointment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$appointment->doctor_name}}</td>
                                                    <td>{{$appointment->descs}}</td>
                                                    <td>{{$appointment->date}} {{$appointment->time}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- View Medicine Modal -->
@foreach ($listmedicines as $listmedicine)
<div class="modal fade" id="viewModal-medicine-{{ $listmedicine->id }}" tabindex="-1" role="dialog">
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
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Name</th>
                            <td>{{ $listmedicine->name }}</td>
                        </tr>
                        <tr>
                            <th>Stock left</th>
                            <td>{{ $listmedicine->stock }}</td>
                        </tr>
                        <tr>
                            <th>Price per item</th>
                            <td>RM {{ number_format($listmedicine->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $listmedicine->desc }}</td>
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
<!-- ./ View Medicine Modal -->


<!-- Add Patient Modal -->
<div class="modal fade" id="addModal-patient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setting Restband</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form-horizontal row-fluid" method="POST">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>Heart Rate</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>Height</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>Weight</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>Sp02</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>BMI</span>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Add Patient Modal -->


<!-- Add Patient Modal -->
<div class="modal fade" id="addModal-datapatient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

           
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                            
                            <canvas id="myChart3"></canvas>
                        

                            </div>

                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

                </div> -->
            
        </div>
    </div>
</div>
<!-- end Add Patient Modal -->
@endforeach







@include('doctor.includes.dtScripts')












<script>

// $.ajax({
//   url: 'https://api.fitbit.com/1/user/-/activities/heart/date/2023-10-17/1d.json',
//   crossDomain: true,
//   headers: {
//     'accept': 'application/json',
//     'authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMjdHNUwiLCJzdWIiOiJCUkRERzkiLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJ3aHIgd251dCB3cHJvIHdzbGUgd2VjZyB3c29jIHdhY3Qgd294eSB3dGVtIHd3ZWkgd2NmIHdzZXQgd3JlcyB3bG9jIiwiZXhwIjoxNjk3NjQ2NDg0LCJpYXQiOjE2OTc1NjAwODR9.DBzPrnSoU8pnSec72rerOkUfhHegvPzZRVfzilDhUgM'
//   }
// }).done(function(response) {
//   console.log(response);
// });

var d = (new Date()).toISOString().split('T')[0];
console.log(d);
$.ajax({
  url: 'https://api.fitbit.com/1/user/-/activities/heart/date/2023-10-17/1d.json',
  crossDomain: true,
  headers: {
    'accept': 'application/json',
    'authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyMjdHNUwiLCJzdWIiOiJCUkRERzkiLCJpc3MiOiJGaXRiaXQiLCJ0eXAiOiJhY2Nlc3NfdG9rZW4iLCJzY29wZXMiOiJ3aHIgd251dCB3cHJvIHdzbGUgd2VjZyB3c29jIHdhY3Qgd294eSB3dGVtIHd3ZWkgd2NmIHdzZXQgd2xvYyB3cmVzIiwiZXhwIjoxNzAyNTI2NzYyLCJpYXQiOjE3MDI0NDAzNjJ9.q_tdbcegG1VwQlFsGqtgcyRJtNjlyqIz3fGO4HNp5Zs'
  }
}).done(function(response) {

    
  var data1 = response['activities-heart-intraday']['dataset'];
  data1 = data1.slice(-10);
  console.log(data1);
  
  console.log(data1[data1.length-1]['time']);

  var datax1 = data1[0]['value'];
  var datax2 = data1[1]['value'];
  var datax3 = data1[2]['value'];
  var datax4 = data1[3]['value'];
  var datax5 = data1[4]['value'];
  var datax6 = data1[5]['value'];
  var datax7 = data1[6]['value'];
  var datax8 = data1[7]['value'];
  var datax9 = data1[8]['value'];
  var datax10 = data1[9]['value'];

  var datay1 = data1[0]['time'];
  var datay2 = data1[1]['time'];
  var datay3 = data1[2]['time'];
  var datay4 = data1[3]['time'];
  var datay5 = data1[4]['time'];
  var datay6 = data1[5]['time'];
  var datay7 = data1[6]['time'];
  var datay8 = data1[7]['time'];
  var datay9 = data1[8]['time'];
  var datay10 = data1[9]['time'];
    
    var datas = [datax1,datax2,datax3,datax4,datax5,datax6,datax7,datax8,datax9,datax10];
    var datasy = [datay1,datay2,datay3,datay4,datay5,datay6,datay7,datay8,datay9,datay10];


    const ctx3 = document.getElementById('myChart3');

new Chart(ctx3, {
    type: 'line',
    data: {
        labels: datasy,
        datasets: [{
            label: 'Heart Rate',
            data: datas,
        },
       ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Data Patient'
            }
        }
    },
});

});


    const ctx = document.getElementById('myChart');
    //const label = Utils.months({count: 7});

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                    label: "New",
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#4099ff',
                    backgroundColor: '#4099ff'
                },

            ]
        }
    })

    const ctx2 = document.getElementById('myChart2');

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Newborn', 'Infant', 'Child', 'Adolescent', 'Old Age'],
            datasets: [{
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1,
                    backgroundColor: ['#FFB1C1', '#7FB5B5', '#EC7C26', '#3E5F8A', '#1E5945', '#57A639'],
                },

            ]
        }
    })



    
  


</script>