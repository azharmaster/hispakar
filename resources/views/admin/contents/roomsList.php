<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-solid fa-bed bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Rooms</h5>
                        <span>Below is the list of all rooms.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="../admin/index.php"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="../admin/roomsList.php">Rooms</a> </li>
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
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List of Room</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Room">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <?php include '../files/assets/printComponent.php' ?>
                                    <div class="col-12">
                                        <h2 class="text-center mb-5" id="tableTitle" hidden>
                                            <b>Rooms List</b>
                                        </h2>
                                    </div>
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-hover table-bordered nowrap">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>Room No</th>
                                                    <th>Room Name</th>
                                                    <th>Location</th>
                                                    <th>PIC</th>
                                                    <th>Current Doctor</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                    <td>003</td>
                                                    <td>Room 3</td>
                                                    <td>Level 2</td>
                                                    <td>Ahmed</td>
                                                    <td>Dr. Nik</td>
                                                    <td style="text-align: center;">
                                                        <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                            <i class="fas fa-eye"></i>
                                                        </button> -->
                                                        <!-- <button class="btn btn-mat waves-effect waves-light btn-success" style="width: 50px;" title="Edit Room" data-toggle="modal" data-target="#editModal">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn btn-mat waves-effect waves-light btn-danger" style="width: 50px;" title="Delete Room" data-toggle="modal" data-target="#deleteModal">
                                                            <i class="fas fa-trash"></i>
                                                        </button> -->
                                                        <a title="Edit Room" data-toggle="modal" data-target="#editModal">
                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a title="Delete Room" data-toggle="modal" data-target="#deleteModal">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>005</td>
                                                    <td>Room 5</td>
                                                    <td>Level 2</td>
                                                    <td>Ahmed</td>
                                                    <td>Dr. Nik</td>
                                                    <td style="text-align: center;">
                                                        <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                            <i class="fas fa-eye"></i>
                                                        </button> -->
                                                        <a title="Edit Room" data-toggle="modal" data-target="#editModal">
                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a title="Delete Room" data-toggle="modal" data-target="#deleteModal">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>006</td>
                                                    <td>Room 6</td>
                                                    <td>Level 3</td>
                                                    <td>Ahmed</td>
                                                    <td>Dr. Mat</td>
                                                    <td style="text-align: center;">
                                                        <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                            <i class="fas fa-eye"></i>
                                                        </button> -->
                                                        <a title="Edit Room" data-toggle="modal" data-target="#editModal">
                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a title="Delete Room" data-toggle="modal" data-target="#deleteModal">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>012</td>
                                                    <td>Room 12</td>
                                                    <td>Level 1</td>
                                                    <td>Ahmed</td>
                                                    <td>Dr. Nik</td>
                                                    <td style="text-align: center;">
                                                        <!-- <button class="btn btn-mat waves-effect waves-light btn-warning" style="width: 50px;" title="View Doctor" data-toggle="modal" data-target="#viewModal">
                                                            <i class="fas fa-eye"></i>
                                                        </button> -->
                                                        <a title="Edit Room" data-toggle="modal" data-target="#editModal">
                                                            <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a title="Delete Room" data-toggle="modal" data-target="#deleteModal">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
<div id="styleSelector"></div>
<!-- Add Room form -->
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room No :</span>
                        <input type="text" style="width:350px;" class="form-control" name="id" id="id" placeholder="H1">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" placeholder="Operation Room">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Location :</span>
                        <input type="text" style="width:350px;" class="form-control" name="location" id="location" placeholder="Level 1">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Person In-Charge :</span>
                        <input type="text" style="width:350px;" class="form-control" name="pic" id="pic" placeholder="Ahmad">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Current Doctor :</span>
                        <input type="text" style="width:350px;" class="form-control" name="currDoc" id="currDoc" placeholder="Dr Nik">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Submit</button>

            </div>
        </div>
    </div>
</div>
<!-- end Add Room form -->

<!-- Edit Room form -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Number :</span>
                        <input type="text" style="width:350px;" class="form-control" name="id" id="id" value="H1">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Room Name :</span>
                        <input type="text" style="width:350px;" class="form-control" name="name" id="name" value="Operation Room">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Location :</span>
                        <input type="text" style="width:350px;" class="form-control" name="location" id="location" value="Level 1">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Person In-Charge :</span>
                        <input type="text" style="width:350px;" class="form-control" name="pic" id="pic" value="Ahmad">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px; font-weight:bold;">Current Doctor :</span>
                        <input type="text" style="width:350px;" class="form-control" name="currDoc" id="currDoc" value="Dr Nik">
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light ">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- end edit Room form -->

<!-- delete Room form -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 15px;"> Are you sure want to delete this room? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light ">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete Room form -->

<?php include 'includes/dtScripts.php' ?>;
