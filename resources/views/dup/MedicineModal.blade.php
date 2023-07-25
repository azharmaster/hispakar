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

<!-- Add Medicine Modal -->
<div class="modal fade" id="addModal-medicine" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/{{ $user }}/medicineList">
            {{csrf_field()}}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group input-group">
                            <label class="input-group-addon" style="width:150px;">Name :</label>
                            <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Name" required>
                        </div>
                        <div class="form-group input-group">
                            <label class="input-group-addon" style="width:150px;">Quantity :</label>
                            <input type="number" style="width:350px;" class="form-control" name="stock" id="stock" placeholder="Stock" required>
                        </div>
                        <div class="form-group input-group">
                            <label class="input-group-addon" style="width:150px;">Price per item :</label>
                            <input type="text" style="width:350px;" class="form-control" name="price" id="address" placeholder="Price" required>
                        </div>
                        <div class="form-group input-group">
                            <label class="input-group-addon" style="width:150px;">Description :</label>
                            <textarea rows="5" style="width:350px;" class="form-control" name="desc" id="desc" placeholder="Enter description.." required></textarea>
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

<!-- Edit Medicine Modal -->
@foreach ($medicines as $medicine)
<div class="modal fade" id="editModal-medicine-{{ $medicine->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Medicines</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/{{ $user }}/medicineList/{{ $medicine->id }}" method="POST">
                @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $medicine->id }}">

                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px;">Name :</label>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Name" value="{{ $medicine->name }}" required>
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width:150px;">Quantity :</label>
                        <input type="number" style="width:350px;" class="form-control" name="stock" id="stock" placeholder="Stock" value="{{ $medicine->stock }}" required>
                    </div>
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width: 150px;">Price per item :</label>
                        <input type="number" step="0.01" style="width: 350px;" class="form-control" name="price" id="price" placeholder="Price" value="{{ $medicine->price }}" required>
                    </div>                                          
                    <div class="form-group input-group">
                        <label class="input-group-addon" style="width: 150px;">Description :</label>
                        <textarea rows="5" style="width: 350px;" class="form-control" name="desc" id="desc" required>{{ $medicine->desc }}</textarea>
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

<!-- Delete Medicine Modal -->
@foreach ($medicines as $medicine)
<div class="modal fade" id="deleteModal-medicine-{{ $medicine->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 15px;">Are you sure you want to delete this medicine?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <form action="/{{ $user }}/medicineList/{{ $medicine->id }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

