<!-- Start Dashboard -->
<div class="pcoded-content mb-4 position-relative" id="content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-regular fa-file-medical bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Report</h5>
                        <span>Below is the selected medical report.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="../patient/index.php"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="../patient/recordList.php">Medical Reports</a> </li>
                        <li class="breadcrumb-item"><a href="../patient/report.php">Record</a> </li>
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
                                    <!-- <h5></h5> -->

                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right" onclick="printContent()" data-toggle="modal" data-target="#default-Modal" title="Add Doctor">
                                        <i class="fas fa-solid fa-print"></i>
                                        Print
                                    </button>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <div id="contentToPrint">
                                            <h3 style="text-align: center;">Medical Examination Report</h3>
                                            <table id="" class="table table-bordered nowrap">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th colspan="7">Patient Information</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="text-align: center;">
                                                        <th colspan="1">Name</th>
                                                        <td colspan="4">John Doe</td>
                                                        <th>Contact</th>
                                                        <td colspan="2">0178923546</td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <th colspan="1">IC Number</th>
                                                        <td colspan="4">490706-05-1996</td>
                                                        <th>Address</th>
                                                        <td colspan="2">Malaysia</td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <th colspan="1">Gender</th>
                                                        <td colspan="4">Male</td>
                                                        <th>Race</th>
                                                        <td colspan="2">British</td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <th colspan="7">Medical History</th>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="7" style="height: 100px;"><i>Medical Conditions and History</i>
                                                            <br>
                                                            N/A
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="7" style="height: 100px;"><i>Current Medications</i>
                                                            <br>
                                                            Contraceptive pill
                                                            <br>
                                                            Antihistamine-loratedine
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <th colspan="7">Radiology</th>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="7" style="height: 100px;"><i>Images Taken</i>
                                                            <br>
                                                            Chest x-ray (PA, 100kVp)
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="7" style="height: 100px;"><i>Summary of Radiological Findings</i>
                                                            <br>
                                                            No evidence of tuberculosis
                                                            <br>

                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: center;">
                                                        <th colspan="7">Testing</th>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="2"><i>Height</i>
                                                            <br>
                                                            160cm
                                                        </td>
                                                        <td colspan="2"><i>Weight</i>
                                                            <br>
                                                            45 kg
                                                        </td>
                                                        <td colspan="2"><i>Pulse Rate</i>
                                                            <br>
                                                            81 bpm
                                                        </td>
                                                        <td colspan="1"><i>Pulse Rhythm Regularity</i>
                                                            <br>
                                                            Regular
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="2"><i>Systolic BP (Seated)</i>
                                                            <br>
                                                            100
                                                        </td>
                                                        <td colspan="2"><i>Diastolic BP (Seated)</i>
                                                            <br>
                                                            81
                                                        </td>
                                                        <td colspan="2"><i>Pulse Rate</i>
                                                            <br>
                                                            81 bpm
                                                        </td>
                                                        <td colspan="1"><i>Pulse Rhythm Regularity</i>
                                                            <br>
                                                            Regular
                                                        </td>
                                                    </tr>
                                                    <tr style="text-align: left;">
                                                        <td colspan="7" style="height: 100px;"><i>Other Vision Test Results</i>
                                                            <br>
                                                            No color blindness detected
                                                            <br>

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
</div>


<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min-1.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min-1.js"></script>

<script src="../files/assets/pages/waves/js/waves.min-1.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll-1.js"></script>

<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr-1.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars-1.js"></script>

<script src="../files/bower_components/datatables.net/js/jquery.dataTables.min-1.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/jszip.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/pdfmake.min-1.js"></script>
<script src="../files/assets/pages/data-table/js/vfs_fonts-1.js"></script>
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

<script>
    function printContent() {
        var content = document.getElementById('contentToPrint').innerHTML;
        var printWindow = window.open('', '', 'height=500,width=800');
        printWindow.document.write('<html><head><title>Print</title></head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>