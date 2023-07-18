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
            <form action="/nurse/roomList" class="form-horizontal row-fluid" method="POST" >
            {{csrf_field()}}

                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room type :</span>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" placeholder="eg. Operation Room" required>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Description :</span>
                        <textarea rows="2" style="width: 350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required></textarea>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Status :</span>
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
            <form action="/nurse/roomList/{{ $room->id }}" class="form-horizontal row-fluid" method="POST" >
            {{csrf_field()}}
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="{{ $room->name }}" placeholder="Name">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room type :</span>
                        <input type="text" style="width:350px;" class="form-control" name="type" id="type" value="{{ $room->type }}" placeholder="eg. Operation Room">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">desc :</span>
                        <textarea rows="2" style="width: 350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required>{{ $room->desc }}</textarea>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Status :</span>
                        <select style="width:350px;" class="form-control" name="status" id="status">
                            <option value="{{ $room->status }}">{{ $room->status }}--{{ $room->status == 0 ? 'Not Available' : 'Not available' }}</option>

                            @if( $room->status == '1')
                                <option value="1">Available</option> 
                            @else
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
                    <form action="/nurse/roomList/{{ $room->id }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach