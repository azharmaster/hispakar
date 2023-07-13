<?php
  //session_start();
  include ('../config.php');  

  if (isset($_POST['submit'])) {
        $IC = $_POST['IC'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $mobileno = $_POST['mobileno'];
        $bloodgroup = $_POST['bloodgroup'];
        $dob = $_POST['dob'];
    
        $sql = mysqli_query($con, "INSERT INTO `patient`(`IC`,`patientname`, `gender`, `address`, `mobileno`, `bloodgroup`, `dob`) 
                VALUES ('$IC', '$name','$gender','$address','$mobileno', '$bloodgroup', '$dob')");
        
        if ($sql) {
            echo "<script type='text/javascript'> alert('Successfully Record.'); </script>";
            echo "<script type='text/javascript'> document.location = 'nursePage.php?p=patientList'; </script>";
        } else {
            echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
        }
    }

    if (isset($_POST['edit'])) {
        $patientid = $_POST['patientid'];
        $IC = $_POST['IC'];
        $patientname = $_POST['patientname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $mobileno = $_POST['mobileno'];
        $bloodgroup = $_POST['bloodgroup'];
        $dob = $_POST['dob'];

        // Perform the update query using the fetched values
        $sql = mysqli_query($con, "UPDATE patient SET IC = '$IC', patientname = '$patientname', gender = '$gender', address = '$address', bloodgroup = '$bloodgroup', mobileno = '$mobileno', dob = '$dob' 
        WHERE patientid = '$patientid'");

        if ($sql) {
            echo "<script type='text/javascript'> alert('Successfully Updated.'); </script>";
            echo "<script type='text/javascript'> document.location = 'nursePage.php?p=patientList'; </script>";
        } else {
            echo "<script type='text/javascript'> alert('Sorry, update unsuccessful.'); </script>";
        }
    }

    if (isset($_GET['del'])) {
        $patientid = $_GET['patientid'];
    
        $ssq = mysqli_query($con, "DELETE FROM patient WHERE patientid = '" . $_GET['patientid'] . "'");
        
        if ($ssq) {	
            echo "<script type='text/javascript'> alert('Successfully Deleted.'); </script>";
            echo "<script type='text/javascript'> document.location = 'nursePage.php?p=patientList'; </script>";
        } else {
            echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
        }
    }

?>

@extends('layouts.nurse')

@section('content')
<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Patients</h5>
                        <span>Below is the list of all patients.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="doctor.php">Patients</a>
                        </li>
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
                            <!-- Start Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 id="tableTitle">List of Patient</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                            Add
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Contact No</th>
                                                    <th>Description</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                    $query=mysqli_query($con,"SELECT * FROM patient");
                                                    
                                                    $i=1;
                                                    while($row=mysqli_fetch_array($query))
                                                    {
                                                ?>
                                                <tr style="text-align: center;">
                                                    <td><?php echo htmlentities($i); ?></td>
                                                    <td><?php echo htmlentities($row['patientname']);?></td>
                                                    <td><?php echo htmlentities($row['mobileno']); ?></td>
                                                    <td></td>
                                                    <td>
                                                        <a title="Edit Patient" data-toggle="modal" data-target="#editModal-<?php echo htmlentities($row['patientid']); ?>">
                                                                <i style="font-size:20px;" class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i>
                                                        </a>
                                                        <a title="Delete Patient" data-toggle="modal" data-target="#deleteModal-<?php echo htmlentities($row['patientid']); ?>">
                                                            <i style="font-size:20px;" class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    $i++ ; 
                                                }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Add Patient form -->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id" class="input-group-addon" style="font-weight:bold;">IC Number :</label>
                                    <input type="text" class="form-control" name="IC" placeholder="490912-05-1856">
                                </div>
                                <div class="form-group">
                                    <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                    <select class="form-control" name="gender">
                                        <option selected="select">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="input-group-addon" style="font-weight:bold;">Address :</label>
                                    <input type="text" class="form-control" name="address" placeholder="Malaysia">
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No:</label>
                                    <input type="text" class="form-control" name="mobileno"  placeholder="0199237856">
                                </div>
                                <div class="form-group">
                                    <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type :</label>
                                    <select class="form-control" name="bloodgroup">
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
                                    <label for="doctor" class="input-group-addon" style="font-weight:bold;">Date of Birth:</label>
                                    <input type="date" class="form-control" name="dob">
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Add Patient form -->

    <!-- Edit Patient form -->
    <?php 
    $query=mysqli_query($con,"SELECT * FROM patient");
    while($row=mysqli_fetch_array($query)){?>
    <div class="modal fade" id="editModal-<?php echo htmlentities($row['patientid']); ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                <div class="modal-body">
                    <div class="container-fluid">
                         <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="patientid"  value="<?php echo $row['patientid']; ?>" hidden>
                                <div class="form-group">
                                    <label for="id" class="input-group-addon" style="font-weight:bold;">IC Number :</label>
                                    <input type="text" class="form-control" name="IC"  value="<?php echo $row['IC']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                    <input type="text" class="form-control" name="patientname"  value="<?php echo $row['patientname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                    <select class="form-control" name="gender">
                                        <option selected="select">Select</option>
                                        <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                                        <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="input-group-addon" style="font-weight:bold;">Address :</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>">
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No:</label>
                                    <input type="text" class="form-control" name="mobileno" value="<?php echo $row['mobileno']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type :</label>
                                    <select class="form-control" name="bloodgroup">
                                        <option value="Select">Select</option>
                                        <option value="A+" <?php if ($row['bloodgroup'] == 'A+') echo 'selected'; ?>>A+</option>
                                        <option value="A-" <?php if ($row['bloodgroup'] == 'A-') echo 'selected'; ?>>A-</option>
                                        <option value="B+" <?php if ($row['bloodgroup'] == 'B+') echo 'selected'; ?>>B+</option>
                                        <option value="B-" <?php if ($row['bloodgroup'] == 'B-') echo 'selected'; ?>>B-</option>
                                        <option value="AB+" <?php if ($row['bloodgroup'] == 'AB+') echo 'selected'; ?>>AB+</option>
                                        <option value="AB-" <?php if ($row['bloodgroup'] == 'AB-') echo 'selected'; ?>>AB-</option>
                                        <option value="O+" <?php if ($row['bloodgroup'] == 'O+') echo 'selected'; ?>>O+</option>
                                        <option value="O-" <?php if ($row['bloodgroup'] == 'O-') echo 'selected'; ?>>O-</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="doctor" class="input-group-addon" style="font-weight:bold;">Date of Birth:</label>
                                    <input type="date" class="form-control" name="dob" value="<?php echo $row['dob']; ?>">
                                </div>
                                
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button name="edit" type="submit" class="btn btn-success waves-effect waves-light ">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php }?>
    <!-- end edit Patient form -->

    <!-- delete Patient form -->
    <?php 
    $query=mysqli_query($con,"SELECT * FROM patient");
    while($row=mysqli_fetch_array($query)){?>
    <div class="modal fade" id="deleteModal-<?php echo htmlentities($row['patientid']); ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 15px;"> Are you sure want to delete this user? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
                    <button onclick="location.href='nursePage.php?p=patientList&del&patientid=<?php echo htmlentities($row['patientid']); ?>'" type="button" class="btn btn-danger waves-effect waves-light ">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <!-- end delete Patient form -->

@include('nurse.includes.dtScripts')

@endsection