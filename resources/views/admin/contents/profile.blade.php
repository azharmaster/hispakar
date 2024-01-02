
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
              <a href="/admin/dashboard"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="#">Profile</a> </li>
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
              <div class="card " style="min-height: 335px">
              
                <div class="card-block d-flex justify-content-center">
                  <!--profile picture -->
                  <div class="parent-container2">
                    <div class="pic-holder" style="background-image: url({{ Auth::user()->image ? asset('storage/profilePic/' . Auth::user()->image) : asset('files/assets/images/profilePic/unknown.jpg') }}); border: 2px solid white;">
                    </div>
                  </div>
                </div>
                
                <h4 class="profile-username text-center">{{ ucfirst($name) }}</h4>
                <p class="text-muted text-center mt-2">ADMIN</p>
                <a data-toggle="modal" title="Edit Profile" href="#edit-profile" class="btn btn-mat waves-effect waves-light btn-info mx-auto"><i class="fas fa-pencil-alt"></i>&nbsp;<b>Edit Profile</b></a>
               
                <br><br>

              </div>
            </div>

            <!-- user details -->
            <div class="col-sm-8">
              <div class="card" style="min-height: 335px">
                <div class="card-header">
                  <h5>User Details</h5>

                </div>
                <br>
                <div class="form-horizontal ml-3">
                @foreach($admindetails as $admindetail)
                  

                  <div class="form-group row">
                    <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="{{ ucfirst($admindetail->name) }}"  readonly>
                    </div>
                  </div>

                  

                  <div class="form-group row">
                    <label for="inputName" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Phone No.</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;" value="{{$admindetail->phoneno}}"  readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName2" style="font-weight: normal; color: black;" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-7">
                      <input type="text" class="profile form-control form-control-border-bottom " style="background-color: white; color: black;"  value="{{$admindetail->email}}" readonly>
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
      @foreach($admindetails as $admindetail)
      <form action="/admin/profile/{{ $admindetail->id }}" class="form-horizontal row-fluid" method="POST" enctype="multipart/form-data" >
      {{csrf_field()}}
          <div class="row">
            <div class="col">
             
              <!-- To display profile pic only -->
              <div class="form-group row text-center">
                <div class="col">
                  <div class="profilepic" onclick="openFileUploader()">
                    <label for="profilepic">
                      <div class="parent-container2">
                        <!-- profile pic displayed-->
                        <div class="pic-holder" style="background-image: url({{ Auth::user()->image ? asset('storage/nurse/profilePic/' . Auth::user()->image) : asset('files/assets/images/profilePic/unknown.jpg') }}); border: 2px solid white;">
                        </div>
                      </div>
                    </label>
                  </div><!-- /.profilepic -->
                </div>
              </div>
              <!-- /.form-group -->
              
              <div class="form-group row text-center" style="margin-top: -20px">
                <div class="col">
                  <div class="file-input-container">
                    <label for="profilepic" class="profilepic__content">
                      <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                      <span class="profilepic__text">Change Photo</span>
                    </label>
                    <input type="file" id="profilepic" name="image" accept="image/*" hidden>
                  </div>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" name="name" value="{{$admindetail->name}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName" style="font-weight: normal; " class="col-sm-2 col-form-label">Phone No.</label>
                <div class="col-sm-10">
                  <input type="text" class="profile form-control form-control-border" name="phoneno" value="{{$admindetail->phoneno}}" >
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group row">
                <label for="inputName2" style="font-weight: normal; " class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-border" id="inputName2" name="email" value="{{$admindetail->email}}">
                </div>
              </div>
              <!-- /.form-group -->

              
              <!-- /.form-group -->
            </div> <!-- /.row -->
          </div> <!-- /.body content -->
      </div> <!-- /.end modal content -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button name="submit" class="btn btn-success">Save Changes</button>
      </div>
      </form>
      @endforeach
    </div> <!-- /.end modal dialog -->
  </div> <!-- /.end edit profile modal-->
</div>

<!-- for profile pic input style -->
<script>
  const fileInput = document.getElementById("profilepic");
  const textSpan = document.querySelector(".profilepic__text");

  fileInput.addEventListener("change", () => {
      const file = fileInput.files[0];
      if (file) {
      textSpan.textContent = file.name;
      } else {
      textSpan.textContent = "Change Photo";
      }
  });
</script>
@endsection

