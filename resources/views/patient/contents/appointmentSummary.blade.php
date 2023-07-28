@extends('layouts.patient')

@section('content')

<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-hospital-user bg-c-blue"></i>
                    <!-- <i class="feather icon-home bg-c-blue"></i> -->
                    <div class="d-inline">
                        <h5>Check Up Report</h5>
                        <span>Summary report of check up.</span>
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
                            <a href="doctor.php">Check Up</a>
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
                            <!-- Start Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Check Up Report</h5>
                                    <span></span>
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" onclick="removeMargin()">
                                        <i class="fas fa-solid fa-print"></i>
                                        Print
                                    </button>
                                </div>
                                <div class="card-block" id="checkup-print" hidden>
                                    <div class="row">
                                        <div class="col">
                                            <p>Patient Name</p>
                                            <p>Date: 10-9-2023</p>
                                        </div>
                                        <div class="col">
                                            <h4>Hospital Name</h4>
                                            <p>Jalan Naga</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block">
                                <p>Personnel: Dr Asyraf</p>
                                </div>
                                <div class="card-block" id="checkup-info">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <td>John Doer</td>
                                            <th>Birth Date</th>
                                            <td>23 August 1987</td>
                                        </tr>
                                        <tr>
                                            <th>Weight</th>
                                            <td>70 kg</td>
                                            <th>Height</th>
                                            <td>175 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Medical History</th>
                                            <td colspan="3">Type 2 Diabetes, High Blood Pressure</td>
                                        </tr>
                                        <tr>
                                            <th>Previous Medication</th>
                                            <td colspan="3">
                                                <ul>
                                                    <li>Paracetamol</li>
                                                    <li>Insulin</li>
                                                    <li>Biguanides</li>
                                                    <li>Alpha-glucosidase inhibitors</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-center">Check-Up Description</th>
                                        </tr>
                                        <tr>
                                            <th>Service Type</th>
                                            <td colspan="3">X-ray</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td colspan="3">Mild Flu</td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-center">Medication</th>
                                        </tr>
                                        <tr>
                                            <th>Paracetamol</th>
                                            <td>10 pcs</td>
                                            <td colspan="2">Flu</td>
                                        </tr>
                                    </table>

                                    <table class="table table-bordered">
                                        <tr class="table-danger">
                                            <th colspan="2">Next Appointment</th>
                                            <td colspan="2">12/3/2023</td>
                                        </tr>
                                    </table>
    
                                </div>
                            <!-- End table -->
                        </div>
                    </div>

                    <div class="col-sm-12">
                            <!-- Start Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Invoice</h5>
                                    <span></span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col">
                                            <p>Invoice No. : 90843-2-3243</p>
                                            <p>Name : Ahmad Albab</p>
                                            <p>Date: 10-9-2023</p>
                                        </div>
                                        <div class="col">
                                            <h4>Hospital Name</h4>
                                            <p> lot 25, Jalan Raja Muda Abdul Aziz, <br>
                                            Kampung Baru, 50300 Kuala Lumpur, <br>
                                            Wilayah Persekutuan Kuala Lumpur</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Description</th>
                                                <th>Unit Price (RM)</th>
                                                <th>Price (RM)</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>Consultation</td>
                                            <td>Minor checkup</td>
                                            <td>-</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td>Medication</td>
                                            <td>
                                                <ul>
                                                    <li>Paracetamol x3</li>
                                                    <li>Antibiotics 100ml</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>10</li>
                                                    <li>20</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <li>10</li>
                                                        <li>20</li>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr class="border-bottom">
                                            <td></td>
                                        </tr>

                                        <tr style="border-top: 1px;">
                                            <th colspan="3" class="text-right">Tax Rate</th>
                                            <td>60</td>
                                        </tr>

                                        <tr style="border-top: 1px;">
                                            <td rowspan="2" class="text-wrap" style="width: 30%;">
                                                <b>NOTICE</b>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do 
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                                    laboris nisi ut aliquip ex ea commodo consequat.
                                                </p>
                                            </td>
                                            <th colspan="2" class="text-right">Sub Total</th>
                                            <td>60</td>
                                        </tr>
                                        <tr>

                                        </tr>
                                       
                                        
                                    </table>
    
                                </div>
                            <!-- End table -->
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete Patient form -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
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
                <button type="button" class="btn btn-danger waves-effect waves-light ">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete Patient form -->

<script>
    var table = document.getElementById("medTable");
    var medNum = 1;
        
    function addMedRow(){
        medNum++;
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0).outerHTML = "<th>Medicine " + medNum + "</th>";
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
            
        cell2.innerHTML = "<select><option>Paracetamol</option><option>Alpha-glucosidase inhibitors</option></select>";
        cell3.innerHTML = "<select><option>1 unit</option><option>2 unit</option></select>";
        cell4.innerHTML = "<span onclick='deleteRow(this)'><i class='fas fa-trash-alt text-danger'></i></span>";
    }

    function getRowIndex(table, columnIndex, cells) {
        var rows = table.rows;
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].cells;
            if (columnIndex < cells.length && cells[columnIndex] === cell) {
            return i;
            }
        }
        return -1; // Return -1 if the cell is not found in the specified column
    }

    function deleteRow(x){
        medNum--;
        table.deleteRow(-1);
    }

    function scheduleNext(){
        var checkBox = document.getElementById("scheduleNext");
        var dateForm = document.getElementById("dateForm");

        if(checkBox.checked == false){
            dateForm.disabled = true;
        }else {
            dateForm.disabled = false;
        }
    }

    function removeMargin(){
        let content = document.getElementById("content");
        let checkupInfo = document.getElementById("checkup-print");
        content.classList.add("ml-0");
        checkupInfo.hidden = false;
        window.print();
    }

</script>

@endsection
