@extends('layouts.nurse')

@section('content')

<!-- Success alert -->
@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

<!-- Start Dashboard -->
<div class="pcoded-content" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-solid fa-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Profile</h5>
                        <span>{{ ucfirst($name) }}'s Profile Page</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class=" breadcrumb breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="../nurse/index.php"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="../nurse/profile.php">Profile</a> </li>
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
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <!--profile picture -->
                                <img src="../files/assets/images/avatar-4-1.jpg" class="img-radius" style="width: 140px; height: 140px;"> 
                            </div>
                            <h4 class="profile-username text-center" style="word-wrap: break-word; max-width: 300px;">
                              {{ ucfirst($name) }}
                            </h4>
                            <p class="text-muted text-center mt-2">NURSE</p>
                            <p class="text-muted text-center">Department of {{ $department->name }}</p>
                            <a data-toggle="modal" title="Edit Profile" href="#edit-profile" class="btn btn-mat waves-effect waves-light btn-info mx-auto" 
                            ><i class="fas fa-pencil-alt"></i>&nbsp;<b>Edit Profile</b></a>

                            <br><br>

                        </div>
                    </div>

                    <!-- user details -->
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-block">
                                <!--profile picture -->
                                
                            </div>
                            <div class="form-horizontal ml-3 mb-2">
                              <div class="form-group row">
                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">IC</label>
                                  <div class="col-sm-7">
                                  <input type="text" class="form-control form-control-border-bottom  profile" style="background-color: white; color: black;" id="exampleInputBorder" placeholder=".." readonly value="{{ $ic }}">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Name</label>
                                  <div class="col-sm-7">
                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="John Doe" id="inputName" placeholder="{{ ucfirst($name) }}" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Gender</label>
                                  <div class="col-sm-7">
                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="Male" id="inputName" placeholder="{{ $gender }}" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Phone No.</label>
                                  <div class="col-sm-7">
                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="0149082376" id="inputName" placeholder="{{ $phoneno }}" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="inputName2" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Email</label>
                                  <div class="col-sm-7">
                                  <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" id="inputName2" value="johndoe@gmail.com" placeholder="{{ $email }}" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="inputExperience" style="font-weight: normal; color: black;"  class="col-sm-3 col-form-label">Address</label>
                                  <div class="col-sm-7">
                                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" id="inputName2" value="Pulau Pinang" placeholder="{{ ucfirst($address)  }}" readonly>
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

<!-- /.start edit profile modal-->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="margin-left: 15px; margin-right:15px;">
      <form >
        <div class="row">
          <div class="col">
            <div class="form-group row">
              <div class="col-sm-10">
                <div class="profilepic" onclick="openFileUploader()">
                  <img class="profilepic__image" src="../files/assets/images/avatar-4-1.jpg" alt="Profile" />
                  <div class="profilepic__content">
                    <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                    <span class="profilepic__text">Choose Photo</span>
                  </div>
                </div>
                <input class="file-upload" type="file" accept="image/*" onchange="readURL(this)" />
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">IC</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-border profile" style="background-color: white;" id="exampleInputBorder" value="490706-05-1288" placeholder="..">
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="profile form-control form-control-border" value="John Doe"  id="inputName" placeholder="Name">
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Age</label>
              <div class="col-sm-10">
                <input type="text" class="profile form-control form-control-border" value="21"  id="inputName" placeholder="Name">
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Gender</label>
              <div class="col-sm-10">
                <input type="text" class="profile form-control form-control-border" value="Male" id="inputName" placeholder="Name">
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Phone No.</label>
              <div class="col-sm-10">
                <input type="text" class="profile form-control form-control-border" value="0149082376" id="inputName" placeholder="Name">
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputName2" style="font-weight: normal; " class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-border" id="inputName2" value="johndoe@gmail.com" placeholder="Name">
              </div>
            </div>
            <!-- /.form-group -->

            <div class="form-group row">
              <label for="inputExperience" style="font-weight: normal; "  class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="Pulau Pinang" placeholder="Location">
              </div>
            </div>
            <!-- /.form-group -->
          </div> <!-- /.row -->
        </div> <!-- /.body content -->
      </div> <!-- /.end modal content -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Save Changes</button>
      </div>
      </form>
    </div> <!-- /.end modal dialog -->
  </div> <!-- /.end edit profile modal-->
</div>

@endsection