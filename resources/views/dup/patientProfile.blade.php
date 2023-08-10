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
        </div>
    </div>
    
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-6 mx-auto d-block col-sm-4">
                                            <img src="../../files/assets/images/dr-1.jpg" width="170" alt="User-Profile-Image">
                                           
                                        </div>
                                        <div class="col-12 col-sm-7 text-center text-sm-left">
                                            <h3 class="pt-3 pt-sm-0 text-uppercase" style="word-wrap: break-word;" >{{ $patientdetail->name }}</h3>
                                            <h6><span class="badge badge-warning">{{ $patientdetail->height }} M</span> <span class="badge badge-primary">{{ $patientdetail->weight }} KG</span>
                                            <span class="badge badge-danger">{{ $patientdetail->bloodtype }} </span>
                                        </h6>
                                            <hr>
                                            <h6><i class="fas fa-map-marker-alt text-primary mr-3"></i>{{ $patientdetail->address }}</h6>
                                            <hr>
                                            <p class="mb-2"><i class="fas fa-phone mr-3 text-primary"></i>{{ $patientdetail->phoneno }}</p>
                                            <i class="far fa-envelope mr-3 text-primary"></i><span>{{ $patientdetail->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <div class="row">
                                <div class="col-12">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-blue">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Doctor Name</h5>
                                            @foreach($doctors as $doctor)
                                            <h6 class="f-w-700 text-white text-uppercase">{{$doctor->doctor}}</h6>
                                            @endforeach
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-hospital-user bg-c-white text-primary d-none d-sm-block"></i>
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
                                            <h4 class="f-w-700 text-white">{{$totaloperation}}</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-hospital bg-c-white text-success d-none d-sm-block"></i>
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
                                            <h5 class="m-b-25 f-w-700 mb-4">Appointment</h5>
                                            <h4 class="f-w-700 text-success">{{$totalapt}}</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-plus bg-c-green d-none d-sm-block"></i>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
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
                                    <a title="View Medicine" data-toggle="modal" data-target="#viewModal-medicine-{{ $listmedicine->id }}"
                                    class="btn btn-{{ $colors[$counter % count($colors)] }} m-1 bg-white">{{ $listmedicine->name }}</a>
                                    
                                    <!-- increment for color -->
                                    @php $counter++; @endphp 
                                    
                                  @endforeach
                                </div>
                              </div>
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
                                <th>Doctor</th>
                                <th>Description</th>
                                <th>Date</th>
                              </tr>
                              </thead>
                              <tbody style="text-align: center;">
                              @foreach ($appointments as $appointment)
                                <tr>
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
                    <!-- End table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
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
                    <table class="table table-bordered table-responsive" >
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

@include('doctor.includes.dtScripts')

<script>
    const ctx = document.getElementById('myChart');
    //const label = Utils.months({count: 7});
  
    new Chart(ctx,  {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [
            {
            label: "New",
            data: [12, 19, 3, 5, 2, 3],
            borderColor: '#4099ff',
            backgroundColor: '#4099ff'
            },

        ]
    }})

const ctx2 = document.getElementById('myChart2');
  
new Chart(ctx2,  {
    type: 'bar',
    data: {
    labels: ['Newborn', 'Infant', 'Child', 'Adolescent', 'Old Age'],
    datasets: [
        {
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1,
        backgroundColor: ['#FFB1C1','#7FB5B5','#EC7C26','#3E5F8A','#1E5945','#57A639'],
        },

    ]
}})
</script>