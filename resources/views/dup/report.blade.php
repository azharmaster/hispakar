<style>
    .center{
        text-align: center;
    }
    .colored{
        background-color: #f8f8f8;
    }
</style>

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
                                    <p>Personnel: {{ $record->attendingDoctor->name ?? 'Not Assigned' }}</p>
                                </div>
                                <div class="card-block" id="checkup-info">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 15%" class="colored">Name</th>
                                            <td style="width: 35%">{{ $record->patient->name }}</td>
                                            <th style="width: 15%" class="colored">Birth Date</th>
                                            <td style="width: 35%">{{ $record->patient->dob }}</td>
                                        </tr>
                                        <tr>
                                            <th class="colored">Weight</th>
                                            <td>{{ $record->patient->weight }} kg</td>
                                            <th class="colored">Height</th>
                                            <td>{{ $record->patient->height }} cm</td>
                                        </tr>
                                        <tr>
                                            <th class="colored">Previous Medical <br>History</th>
                                            <td colspan="3">
                                                @isset($previousRecord)
                                                    {{ $previousRecord->desc }}
                                                @else
                                                    No previous medical history available for this patient.
                                                @endisset
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="colored">Medication History</th>
                                            <td colspan="3">
                                                <ul>
                                                    @isset($prevMedicine)
                                                        @foreach ($prevMedicine as $medicine)
                                                            <li>{{ $medicine->prevMedName }}</li>
                                                        @endforeach
                                                    @else
                                                        <li>No previous medicine available for this patient.</li>
                                                    @endisset
                                                </ul>
                                            </td>
                                        </tr>


                                        <tr class="colored center">
                                            <th colspan="4" >Check-Up Description</th>
                                        </tr>
                                        <tr>
                                            <th class="colored">Service Type</th>
                                            <td colspan="3">{{ $record->medService->type }}</td>
                                        </tr>
                                        <tr>
                                            <th class="colored">Description</th>
                                            <td colspan="3">{{ $record->desc }}</td>
                                        </tr>

                                    </table>
                                    
                                    <table class="table table-bordered" style="margin-top: -17px">
                                        <tr class="colored center">
                                            <th colspan="4">Medication</th>
                                        </tr>
                                        <tr class="center" >
                                            <th style="width:10px">No</th>
                                            <th class="text-left">Medicine Name</th>
                                            <th >Quantity</th>
                                            <th colspan="2">Prescription</th>
                                        </tr>

                                        @foreach ($medicines as $medicine)
                                            <tr>
                                                <td class="center">{{ $loop->iteration }}</td>
                                                <td> &nbsp;{{ $medicine->name }}</td>
                                                <td class="center">{{ $medicine->qty }}</td>
                                                <td colspan="2">{{ $medicine->desc }}</td>
                                            </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <th colspan="2" class="colored" >Next Appointment</th>
                                            <td colspan="3" style="padding-bottom: 0;">
                                                @if (!empty($nextAptStatus))
                                                    @foreach ($nextAptStatus as $apt)
                                                        {{-- Kalau status == cancel, keep display next apt --}}
                                                        {{ $apt['appointment']->date }} {{ $apt['appointment']->time }}
                                                        <span class="badge ml-2" style="{{ $apt['badgeStyle'] }}">{{ $apt['status'] }}</span><br><br>

                                                        {{-- Kalau status != cancel, break loop --}}
                                                        @if ($apt['status'] !== 'Cancel')
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @else
                                                    No upcoming appointments
                                                @endif


                                            </td>
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
                                    <h5>
                                        @if ($record->medinvoice->method == "0") 
                                            Invoice
                                        @else  
                                            Receipt
                                        @endif
                                    </h5>
                                    <span></span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col">
                                            <p>Invoice No. : {{ $record->refnum }}</p>
                                            <p>Name : {{ $record->patient->name }}</p>
                                            <p>Date: {{ $record->datetime }}</p>
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
                                                <th style="width:10px">No</th>
                                                <th style="width:200px">Item Name</th>
                                                <th class="text-center" style="width:120px">Quantity</th>
                                                <th class="text-right" style="width:160px">Unit Price (RM)</th>
                                                <th class="text-right" style="width:120px">Amount (RM)</th>
                                            </tr>
                                        </thead>
                                        @php $counter = 1; @endphp
                                        <tbody>
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{ $record->medService->type }} &nbsp;(Service Type)</td>
                                                <td class="text-center" >1</td>
                                                <td class="text-right" >{{ $record->medService->charge }}</td>
                                                <td class="text-right" >{{ $record->medService->charge }}</td>
                                            </tr>
                                            @foreach ($medicines as $medicine)
                                            <tr>
                                                <td>{{ ++$counter }}</td>
                                                <td>{{ $medicine->name }}</td>
                                                <td class="text-center">{{ $medicine->qty }} </td>
                                                <td class="text-right">{{ $medicine->price }}</td>
                                                <td class="text-right">{{ $medicine->total }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>

                                    <div class="row border-top">
                                        <br><br>
                                        <!-- accepted payments column -->
                                        <div class="col-7">
                                            <br>
                                            <table class="table">
                                                <tr>
                                                    <td class ="border-0"style="width: 100px">
                                                        <b>Notes</b><br><br>

                                                        @if ($record->medinvoice->method != "0") <!-- Paid -->
                                                            Datetime<br>
                                                            Method<br>                                                 
                                                        @endif
                                                            Status 
                                                        
                                                    </td>
                                                    <td class ="border-0 text-left" >
                                                        <br><br>
                                                        
                                                        @if ($record->medinvoice->method != "0") <!-- Paid --> 
                                                            : &nbsp;{{ ($record->medinvoice->datetime) }}<br>
                                                            : &nbsp;{{ $record->medinvoice->method }}<br> 
                                                        @endif
                                                            : &nbsp;{{ $record->medinvoice->medstatus == 0 ? 'Not yet paid' : 'Paid' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
            
                                        <!-- /.col -->
                                        <div class="col-5">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th class ="border-0"style="width:50%">Subtotal</th>
                                                        <td class ="border-0 text-right" >{{ number_format($record->medInvoice->subtotal, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tax</th>
                                                        <td class ="text-right" >{{ number_format($record->medInvoice->tax, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <td class ="text-right" >{{ number_format($record->medInvoice->discount, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total</th>
                                                        <td class ="text-right" >{{ number_format($record->medInvoice->totalcost, 2) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->


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
</script>

<script>
    function removeMargin(){
        let content = document.getElementById("content");
        let checkupInfo = document.getElementById("checkup-print");
        content.classList.add("ml-0");
        checkupInfo.hidden = false;
        // Store the current title
        let currentTitle = document.title;

        // Set a temporary title for the PDF (e.g., "icnumber_today'sdate")
        let icNumber = '<?php echo $record->patient->ic ?? ""; ?>';
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
        let yyyy = today.getFullYear();
        let formattedDate = dd + mm + yyyy;
        let temporaryTitle = icNumber + '_' + formattedDate;
        document.title = temporaryTitle;

        window.print();

        // Revert back to the original title
        document.title = currentTitle;
    }
</script>

