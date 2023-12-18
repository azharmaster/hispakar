@php
    $user = '';
    $userType = Auth::user()->usertype;

    if ($userType == 1) {
        $user = 'admin';
    } elseif ($userType == 2) {
        $user = 'doctor';
    } elseif ($userType == 3) {
        $user = 'nurse';
    } elseif ($userType == 4) {
        $user = 'patient';
    }
@endphp

<!-- Add Patient Modal -->
<div class="modal fade" id="addModal-patient" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/{{ $user }}/patientList" class="form-horizontal row-fluid" method="POST" >
              {{csrf_field()}}
            <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                            <input type="text" class="form-control" name="ic" id="name" placeholder="550402050449">
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option selected="">Select Gender </option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                            <input type="text" class="form-control" name="phoneno" id="contact" placeholder="0199237856">
                        </div> 
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                            <input type="date" class="form-control" name="dob" id="name">
                        </div>
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Address :</label>
                            <input type="text" class="form-control" name="address" id="contact" placeholder="K-238, Taman Pandan, Puncak Alam">
                        </div> 
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Age :</label>
                            <input type="text" class="form-control" name="age" id="contact" placeholder="20">
                        </div> 
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Weight :</label>
                            <input type="text" class="form-control" name="weight" id="contact" placeholder="47.5">
                        </div> 
                        <div class="form-group">
                            <label for="contact" class="input-group-addon" style="font-weight:bold;">Height :</label>
                            <input type="text" class="form-control" name="height" id="contact" placeholder="1.77">
                        </div> 

                        <div class="form-group">
                            <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type :</label>
                            <select class="form-control" name="bloodtype">
                                <option selected="select">Select </option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                            <input type="email" class="form-control" name="email" id="name" placeholder="johndoe@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="name" class="input-group-addon" style="font-weight:bold;">Password :</label>
                            <input type="password" class="form-control" name="password" id="name" value="12345678" readonly>
                        </div>
                        <input type="hidden" style="width:350px;" class="form-control" name="usertype" value="4">
                        <input type="hidden" style="width:350px;" class="form-control" name="status" value="1">
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

<!-- Edit Patient Modal -->
@foreach ($patients as $patient)
<div class="modal fade" id="editModal-patient-{{ $patient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/{{ $user }}/patientList/{{ $patient->id }}" method="POST">
             @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $patient->id }}">

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                                <input type="text" class="form-control" name="ic" id="ic" value="{{ $patient->ic }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $patient->name }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" {{ $patient->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $patient->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                                <input type="text" class="form-control" name="phoneno" id="phoneno" value="{{ $patient->phoneno }}">
                            </div> 
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ $patient->dob }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Address :</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $patient->address }}">
                            </div> 
                            
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Weight :</label>
                                <input type="float" class="form-control" name="weight" id="weight" value="{{ $patient->weight }}">
                            </div> 
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Height :</label>
                                <input type="float" class="form-control" name="height" id="height" value="{{ $patient->height }}">
                            </div> 

                            <div class="form-group">
                                <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type:</label>
                                <select class="form-control" name="bloodtype">
                                    <option value="A+" {{ $patient->bloodtype === 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $patient->bloodtype === 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $patient->bloodtype === 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $patient->bloodtype === 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ $patient->bloodtype === 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ $patient->bloodtype === 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ $patient->bloodtype === 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ $patient->bloodtype === 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $patient->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button name="submit" class="btn btn-danger waves-effect waves-light ">Reset Password</button>
                <button name="submit" class="btn btn-success waves-effect waves-light ">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- end edit Patient Modal -->

<!-- delete Patient Modal -->
@foreach ($patients as $patient)
<div class="modal fade" id="deleteModal-patient-{{ $patient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 15px;"> Are you sure want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <form action="/{{ $user }}/patientList/{{ $patient->id }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button name="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end delete Patient Modal -->