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

<!-- Add Room Modal -->
<div class="modal fade" id="addModal-room" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/{{ $user }}/roomList" class="form-horizontal row-fluid" method="POST" >
            {{csrf_field()}}

                <div class="container-fluid">
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</label>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Room type :</label>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" placeholder="eg. Operation Room" required>
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Description :</label>
                        <textarea rows="2" style="width: 350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required></textarea>
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Doctor ID :</label>
                        <select class="js-example-data-array" id="patientDropdown" style="width:450px;" name="docid">
                        <option value="0" disabled selected>Choose Doctor</option>
                        @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}"> {{ $doctor->name }} </option>
                        @endforeach   
                    </select>
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Status :</label>
                        <select style="width:350px;" class="form-control" name="status" id="status" required>
                            <option value="1">Available</option>
                            <option value="0">Not available</option> 
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button  name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Room Modal-->
@foreach ($rooms as $room)
<div class="modal fade" id="editModal-room-{{ $room->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/{{ $user }}/roomList/{{ $room->id }}" class="form-horizontal row-fluid" method="POST" >
            {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</label>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="{{ $room->name }}" placeholder="Name">
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Room type :</label>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" value="{{ $room->type }}" placeholder="eg. Operation Room">
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Description :</label>
                        <textarea rows="2" style="width: 350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required>{{ $room->desc }}</textarea>
                    </div>

                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Doctor ID :</span>
                        <select class="js-example-data-array" style="width:450px;" name="docid">
                            @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ ( $doctor->id == $room->staff_id) ? 'selected' : '' }}> {{ $doctor->name }} </option>
                            @endforeach   
                        </select>
                    </div>
                   
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px; font-weight:bold;">Status :</label>
                        <select style="width:350px;" class="form-control" name="status" id="status">

                            @if ($room->status === 0)
                                <option value="{{ $room->status }}">Not available</option> 
                                <option value="1">Available</option> 
                            @else
                                <option value="{{ $room->status }}">Available</option> 
                                <option value="0">Not available</option> <!-- diguna / penuh -->
                            @endif

                        </select>
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
@endforeach

<!-- Delete Room Modal -->
@foreach ($rooms as $room)
    <div class="modal fade" id="deleteModal-room-{{ $room->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;">Are you sure you want to delete this room?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <form action="/{{ $user }}/roomList/{{ $room->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach