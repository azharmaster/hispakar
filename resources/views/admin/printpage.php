<?php

include('../config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $mobileno = $_POST['mobileno'];
  
    $sql = mysqli_query($con, "INSERT INTO `patient`(`patientname`, `gender`, `address`, `mobileno`) VALUES ('$name','$gender','$address','$mobileno')");
    
    if ($sql) {
        echo "<script type='text/javascript'> alert('Successfully Recorded.'); </script>";
        echo "<script type='text/javascript'> document.location = 'doctorPage.php?p=patientList'; </script>";
    } else {
        echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
    }
}

if (isset($_GET['del'])) {
    $patientid = $_GET['patientid'];

    $ssq = mysqli_query($con, "DELETE FROM patient WHERE patientid = '" . $_GET['patientid'] . "'");
    
    if ($ssq) {	
        echo "<script type='text/javascript'> alert('Successfully Deleted.'); </script>";
        echo "<script type='text/javascript'> document.location = 'doctorPage.php?p=patientList'; </script>";
    } else {
        echo "<script type='text/javascript'> alert('Sorry!! Unsuccessful.'); </script>";
    }
}

if (isset($_POST['edit'])) {
    $patientid = $_POST['patientid'];
    $patientname = $_POST['patientname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $mobileno = $_POST['mobileno'];

    // Perform the update query using the fetched values
    $sql = mysqli_query($con, "UPDATE patient SET patientname = '$patientname', gender = '$gender', address = '$address', mobileno = '$mobileno' WHERE patientid = '$patientid'");

    if ($sql) {
        echo "<script type='text/javascript'> alert('Successfully Updated.'); </script>";
        echo "<script type='text/javascript'> document.location = 'doctorPage.php?p=patientList'; </script>";
    } else {
        echo "<script type='text/javascript'> alert('Sorry, update unsuccessful.'); </script>";
    }
}


?>

<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Start Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>List of Patient</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-plus"></i>
                                        Adds
                                    </button>
                                </div>
                                <div class="card-block">
                                    <?php include '../files/assets/printComponent.php'?>
                                    <div class="col-12">
                                        <h2 class="text-center mb-5" id="tableTitle" hidden>
                                            <b>Patient List</b>
                                        </h2>
                                    </div>
                                    <div class="dt-responsive table-responsive">
                                        <table id="dataTable1" class="table table-bordered print-table">
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
                                                
                                                $i = 1; //count
                                                while($row=mysqli_fetch_array($query))
                                                {?>
                                                <tr style="text-align: center;">
                                                    <td><?php echo htmlentities($i); ?></td>
                                                    <td><?php echo htmlentities($row['patientname']); ?></td>
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
                                                <?php $i++ ; 
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

<?php include 'includes/dtScripts.php' ?>;



