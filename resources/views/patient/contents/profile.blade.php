
@extends('layouts.patient')

@section('content')
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
  <div class="page-header card">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="fas fa-solid fa-user bg-c-blue"></i>
          <div class="d-inline">
            <h5>Profile</h5>
            <span>John Doe's Profile Page</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="page-header-breadcrumb">
          <ul class=" breadcrumb breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="../patient/index.php"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="../patient/profile.php">Profile</a> </li>
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
              @foreach($userdetails as $userdetail)
                <div class="card-block text-center">
                  <!--profile picture -->
                  <img src="../files/assets/images/avatar-4-1.jpg" class="img-radius" style="width: 140px; height: 140px;">
                </div>
                
                <h4 class="profile-username text-center text-uppercase">{{$userdetail->name}}</h4>
                <p class="text-muted text-center">{{$userdetail->phoneno}}</p>
                <p class="text-muted text-center">{{$userdetail->address}}</p>
                <a data-toggle="modal" title="Edit Profile" href="#edit-profile" class="btn btn-mat waves-effect waves-light btn-info mx-auto"><i class="fas fa-pencil-alt"></i>&nbsp;<b>Edit Profile</b></a>
                @endforeach
                <br><br>

              </div>
            </div>

            <!-- user details -->
            <div class="col-sm-8">
              <div class="card">
                <div class="card-header">
                  <h5>User Details</h5>

                </div>
                <br>
                <div class="form-horizontal ml-3">
                @foreach($userdetails as $userdetail)
                  <div class="form-group row">
                    <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">IC</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form-control-border-bottom  profile" style="background-color: white; color: black;" id="exampleInputBorder"  value="{{$userdetail->ic}}" disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="{{$userdetail->name}}"  disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="{{$userdetail->gender}}"  disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Phone No.</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="{{$userdetail->phoneno}}"  disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName2" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;"  value="{{$userdetail->email}}" disabled>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputExperience" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;"  value="{{$userdetail->address}}" disabled>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="styleSelector"></div>

<!-- /.start edit profile modal-->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="margin-left: 15px; margin-right:15px;">
        <form>
          @foreach($userdetails as $userdetail)
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <div class="col-sm-10">
                  <div class="profilepic text-center" onclick="openFileUploader()">
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
                  <input type="text" class="form-control form-control-border profile"  value="{{$userdetail->ic}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="{{$userdetail->name}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="{{$userdetail->age}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="{{$userdetail->gender}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" value="{{$userdetail->phoneno}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName2" style="font-weight: normal; " class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-border" id="inputName2" value="{{$userdetail->email}}">
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputExperience" style="font-weight: normal; " class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="{{$userdetail->address}}" placeholder="Location">
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
      @endforeach
    </div> <!-- /.end modal dialog -->
  </div> <!-- /.end edit profile modal-->
</div>
@endsection
<!-- 
<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min-1.js"></script>

<script src="../files/assets/jquery/jquery.min.js"></script>

<script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr-1.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars-1.js"></script>

<script src="../files/bower_components/datatables.net/js/jquery.dataTables.min-1.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/jszip.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/pdfmake.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/vfs_fonts-1.js"></script>
<script src="../files/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min-1.js"></script>
<script src="../files/assets/pages/data-table/extensions/buttons/js/buttons.flash.min-1.js"></script>
<script src="../files/assets/pages/data-table/extensions/buttons/js/jszip.min-1.js"></script>
<script src="../files/assets/pages/data-table/extensions/buttons/js/vfs_fonts-1.js"></script>
<script src="../files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min-1.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.print.min-1.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.html5.min-1.js"></script>
<script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min-1.js"></script>
<script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min-1.js"></script>
<script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min-1.js"></script>

<script src="../files/assets/pages/data-table/js/data-table-custom-1.js"></script>
<script src="../files/assets/js/pcoded.min-1.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min-1.js"></script>
<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min-1.js"></script>
<script type="text/javascript" src="../files/assets/js/script-1.js"></script>
<script type="text/javascript" src="../files/assets/printScript.js"></script>

<script>
  function openFileUploader() {
    $(".file-upload").click();
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('.profilepic__image').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script> -->