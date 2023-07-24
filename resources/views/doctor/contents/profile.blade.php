@extends('layouts.doctor')

@section('content')

<!-- Alert -->
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
                        <h5>Profile</h5>
                        <span>{{ ucfirst($name) }}'s Profile </span>
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
                                            <img src="../files/assets/images/dr-1.jpg" width="170" alt="User-Profile-Image">
                                            <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#editProfileModal" style="width: 170px;">Edit Profile</button>
                                        </div>
                                        <div class="col-12 col-sm-7 text-center text-sm-left">
                                            <h3 class="pt-3 pt-sm-0" style="word-wrap: break-word;" >{{ ucfirst($name) }}</h3>
                                            <h6>Department of {{ $department->name }}</h6>
                                            <hr>
                                            <h6><i class="fas fa-graduation-cap text-primary mr-3"></i>{{ $education }}</h6>
                                            <hr>
                                            <p class="mb-2"><i class="fas fa-phone mr-3 text-primary"></i>{{ $phoneno }}</p>
                                            <i class="far fa-envelope mr-3 text-primary"></i><span>{{ $email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <div class="row">
                                <div class="col-6">
                                    <a title="View Appointment" data-toggle="modal" data-target="#viewModal">
                                    <div class="card comp-card bg-c-blue">
                                        <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Total Patient</h5>
                                            <h4 class="f-w-700 text-white">34</h4>
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
                                            <h5 class="m-b-25 f-w-700 mb-4 text-white">Experience</h5>
                                            <h4 class="f-w-700 text-white">10 years</h4>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-briefcase bg-c-white text-success d-none d-sm-block"></i>
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
                                            <h4 class="f-w-700 text-white">73</h4>
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
                                            <h5 class="m-b-25 f-w-700 mb-4">Patients Attending</h5>
                                            <h4 class="f-w-700 text-success">5 patients</h4>
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

<!-- Edit Doctor form -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/doctor/profile/{{ $id }}" method="POST">
             @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $id }}">

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                                <input type="text" class="form-control" name="ic" id="ic" value="{{ $ic }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" {{ $gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                                <input type="text" class="form-control" name="phoneno" id="phoneno" value="{{ $phoneno }}">
                            </div> 
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ $dob }}">
                            </div>
                            
                           
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $email }}">
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Highest education :</label>
                                <input type="text" class="form-control" name="education" id="education" value="{{ $education }}">
                            </div>
                            <div class="form-group ">
                                <label for="inputName" class="input-group-addon" style="font-weight:bold;">Department</label>
                                  <select class="form-control" name="deptid">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ ( $department->id == $deptid) ? 'selected' : '' }}> {{ $department->name }} </option>
                                    @endforeach   
                                  </select> 
                            </div>
                            <div class="form-group">
                                <label class="input-group-addon" style="font-weight:bold;" >Experience :</label>
                                <textarea type="text" class="form-control" rows="5" name="experience" id="experience">{{ $experience }}</textarea>
                            </div>  


                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button name="submit" class="btn btn-success waves-effect waves-light ">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit Doctor form -->

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

@endsection