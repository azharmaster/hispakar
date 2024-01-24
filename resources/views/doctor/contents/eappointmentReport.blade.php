@extends('layouts.doctor')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- Success Alert -->
@if(session()->has('success'))
    <script>
        alert("{{ session()->get('success') }}");
    </script>
@endif

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
                        <span>Below is the list of all patients.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/doctor/dashboard">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/doctor/appointmentReport/{{ $appointment->id }}">Check Up</a>
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
                                    <h5 id="tableTitle">Patient Info</h5>
                                    <span>Lets say you want to sort the fourth column (3) descending and the first column (0) ascending: your order: would look like this: order: [[ 3, 'desc' ], [ 0, 'asc' ]]</span>
                                    
                                    <button type="button" class="btn btn-mat waves-effect waves-light btn-warning d-block mx-auto float-right" data-toggle="modal" 
                                        data-target="#editModal-patient-{{ $singlePatient->id }}" title="View Patient">
                                        <i class="fas fa-solid fa-eye"></i>
                                            View
                                    </button>

                                </div>
                                <div class="card-block">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                                        <th>Birth Date</th>
                                        <td>{{ $appointment->patient->dob }}</td>

                                    </tr>

                                    <tr>
                                        <th>Weight</th>
                                        <td>{{ $appointment->patient->weight }} kg</td>
                                        <th>Height</th>
                                        <td>{{ $appointment->patient->height }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Medical History</th>
                                        <td colspan="3">
                                            
                                                @if ($previousMedRecord)
                                                    {{ $previousMedRecord->desc }}<br>
                                                @else
                                                    No previous medical history available
                                                @endif
                                        
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Prescribed Medication</th>
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


                                </table>

    
                                </div>
                            <!-- End table -->
                        </div>
                    </div>
    
                    <div class="col-sm-12">
                        <!-- Start Card -->
                        <div class="card">
                            <div class="card-block">
                            </div>
                            <form id="appointmentForm" action="{{ route('doctor.editAppointmentRecord', ['id' => $appointment->id]) }}" method="POST" >
                                {{csrf_field()}}

                                <input type="hidden" name="id" value="{{ $appointment->id }}">
                                <input type="hidden" name="patientid" value="{{ $appointment->patient->id }}">
                                <input type="hidden" name="status" id="status">
                                
                                <div class="card-header">
                                    <h5>Check Up Description</h5>
                                    <span>Description of Patient's health </span>
                                </div>

                                <div class="card-block">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width:200px">Service Type</th>
                                            <td>
                                                <select class="js-example-data-array" name="serviceid" onchange="updatePrice2(this)" required style="width:600px">
                                                    <option value="" disabled>Select Service Type</option>
                                                    @foreach ($medservices as $medservice)
                                                        <option value="{{ $medservice->id }}" data-price="{{ $medservice->charge }}"
                                                            {{ $selectedServiceType->isNotEmpty() && $selectedServiceType[0]->serviceid == $medservice->id ? 'selected' : '' }}>
                                                            {{ $medservice->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="width: 159px">
                                                <input class="form-control text-right bg-white" type="number" name="serviceTypeCharge" id="serviceTypeCharge" value="{{ $selectedServiceType->isNotEmpty() ? $selectedServiceType[0]->charge : '0.00' }}" style="height:45px" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col">
                                            <textarea rows="5" cols="5" name="desc[med_record]" class="form-control" placeholder="Stomachache">{{ $appointment->medrecord->first()->desc ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h5>Medicine Prescription</h5>
                                    <span>Medicines included</span>
                                </div>
                                <div class="card-block">
                                    <table id="itemTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:10px"></th>
                                                <th>Medicine Name</th>
                                                <th>Description</th>
                                                <th class="text-center" style="width:120px">Quantity</th>
                                                <th class="text-center" style="width:160px">Unit Price (RM)</th>
                                                <th class="text-center" style="width:120px">Amount (RM)</th>
                                                <th class="text-center" style="width:10px"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        @foreach ($selectedMedicines as $index => $selectedMedicine)
                                            <tr>
                                                <td id="itemNo"></td>
                                                <td>
                                                        <input type="text" name="medicines[id][]" class="form-control rounded-0 bg-white border-0"
                                                            onchange="updatePrice(this)"
                                                            value="{{ $selectedMedicine['name'] }}" 
                                                            data-price="{{ $selectedMedicine['price'] }}" 
                                                            style="width:190px" readonly>
                                                </td>
                                                
                                                <td>
                                                    <input type="text" name="desc[med_prescription][]" class="form-control rounded-0 bg-white border-0"
                                                        value="{{ $selectedMedicine['desc'] }}" placeholder="Dose suggested details" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="qty[]" class="form-control rounded-0 text-right bg-white border-0"
                                                        value="{{ $selectedMedicine['qty'] }}"
                                                        oninput="validateQuantity(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                        onpaste="return false" ondrop="return false" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="price[]" class="form-control rounded-0 text-right bg-white border-0"
                                                        value="{{ $selectedMedicine['price'] }}" step="any"
                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46"
                                                        onpaste="return false" ondrop="return false" placeholder="0.00" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="total[]" value="{{ $selectedMedicine['total'] }}" class="form-control text-right bg-white border-0" readonly>
                                                </td>
                                                <td>
                                                    <button class="btn btn-icon waves-effect waves-light" onclick="confirmAndSubmit(event, {{ $index }}, {{ $selectedMedicine['id'] }}, {{ $selectedMedicine['aptid'] }})">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                    <table class="" style="width: 100%">
                                        <tr>
                                            <td>
                                                <button id="addRowButton" name="addRow" type="button" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-left">
                                                    Add Medicine
                                                </button>
                                            </td>
                                            <td style="width: 160px"></td>
                                            <td style="width: 159px"></td>
                                        </tr>

                                        
                                        <tr class="text-right">
                                            <td style="font-size: 10px; color: red"> *The subtotal include service type</td>
                                            <td>Sub Total &nbsp;</td>
                                            <td><input type="number" id="subtotal" class="form-control bg-white text-right" name="subtotal" value="0" readonly></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td></td>
                                            <td>Tax &nbsp;</td>
                                            <td><input type="number" class="form-control text-right" id="tax"  name="tax" value="0.00" placeholder="0.00" oninput="calculateTotal()" step="any" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" onpaste="return false" ondrop="return false" required></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td></td>
                                            <td>Discount &nbsp;</td>
                                            <td><input type="number" class="form-control text-right" id="discount" name="discount" value="0.00" placeholder="0.00" oninput="calculateTotal()" step="any" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" onpaste="return false" ondrop="return false" required></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td></td>
                                            <td><b>Total </b>&nbsp;</td>
                                            <td><input type="number" class="form-control text-right bg-white" id="totalcost" name="totalcost" value="0" readonly></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="checkbox" id="scheduleNext" name="scheduleNext">
                                            <label class="col-form-label" for="scheduleNext">Schedule Next Appointment</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- <input class="form-control" type="date" id="dateInput" name="date" disabled> -->
                                            <select class="form-control" style="width:230px;" name="date" id="dateInput" placeholder="" disabled>
                                                <option value="0" disable selected>Choose Date</option>
                                                @foreach ($doctorSchedule as $date)
                                                    <option value="{{ $date }}">{{ $date }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-sm-3">
                                            <!-- <input class="form-control" type="time" id="timeInput" name="time" disabled> -->
                                            <select class="form-control" style="width:200px;" name="time" id="timeInput" placeholder="" disabled>
                                                <option value="">Choose Time</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <td><input type="hidden" name="medstatus" value="0"></td>
                                    <td><input type="hidden" name="method" value="0"></td>
                                    
                                    <div class="form-group row">
                                        <div class="col">
                                            <button name="submit" class="btn btn-mat waves-effect waves-light btn-primary d-block mx-auto float-right">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End table -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- view patient details -->

@if(isset($singlePatient))
<div class="modal fade" id="editModal-patient-{{ $singlePatient->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" style="width:350px;" class="form-control" name="id" id="id" value="{{ $singlePatient->id }}">

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">IC :</label>
                                <input type="text" class="form-control" name="ic" id="ic" value="{{ $singlePatient->ic }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Name :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $singlePatient->name }}">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="input-group-addon" style="font-weight:bold;">Gender:</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="male" {{ $singlePatient->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $singlePatient->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Contact No :</label>
                                <input type="text" class="form-control" name="phoneno" id="phoneno" value="{{ $singlePatient->phoneno }}">
                            </div> 
                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Date of Birth :</label>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ $singlePatient->dob }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Address :</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $singlePatient->address }}">
                            </div> 
                            
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Weight :</label>
                                <input type="float" class="form-control" name="weight" id="weight" value="{{ $singlePatient->weight }}">
                            </div> 
                            <div class="form-group">
                                <label for="contact" class="input-group-addon" style="font-weight:bold;">Height :</label>
                                <input type="float" class="form-control" name="height" id="height" value="{{ $singlePatient->height }}">
                            </div> 

                            <div class="form-group">
                                <label for="doctor" class="input-group-addon" style="font-weight:bold;">Blood Type:</label>
                                <select class="form-control" name="bloodtype">
                                    <option value="A+" {{ $singlePatient->bloodtype === 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $singlePatient->bloodtype === 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $singlePatient->bloodtype === 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $singlePatient->bloodtype === 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ $singlePatient->bloodtype === 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ $singlePatient->bloodtype === 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ $singlePatient->bloodtype === 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ $singlePatient->bloodtype === 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name" class="input-group-addon" style="font-weight:bold;">Email :</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $singlePatient->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect " data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif

<script>
    // to get medicine price based on selected input
    function updatePrice(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var row = selectElement.parentNode.parentNode; // Get the parent row
        var priceInput = row.querySelector("input[name='price[]']"); // Get the price input element in the same row
        var price = selectedOption.dataset.price;
        priceInput.value = price ? price : 0;

        calculateAmount(row);
    }

    // To get medicine price based on selected input
    function updatePrice2(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var row = selectElement.parentNode.parentNode; // Get the parent row
        var chargeInput = row.querySelector("input[name='serviceTypeCharge']"); // Get the price input element in the same row
        var charge = selectedOption.dataset.price;
        chargeInput.value = charge ? parseFloat(charge).toFixed(2) : "0.00";

        calculateSubtotal();
    }

</script>

<script>
    // Function to update the row count
    function updateRowCount() {
      var table = document.getElementById("itemTable");
      var rowCount = table.rows.length;
      var itemNoCells = document.querySelectorAll("td[id='itemNo']");
    
      itemNoCells.forEach(function(cell, index) {
        cell.textContent = index + 1;
      });
    }

    // Price value only integer or float
    function validateFloatInteger(input) {
        var value = input.value;
        var isValid = /^\d+(\.\d+)?$/.test(value); // Check if the value is a valid integer or float

        if (!isValid) {
            // Clear the input and show an error message
            input.value = '';
            input.setCustomValidity('Please enter a valid number.');
        } else {
            // Input is valid, clear the error message
            input.setCustomValidity('');
            //calculate amount = qty*price
            calculateAmount(input.closest('tr'));
        }
    }
    
    // Quantity value only integer
    function validateQuantity(input) {
        var value = input.value;
        var isValid = /^\d*$/.test(value); // Check if the value contains only digits

        if (!isValid) {
            // Clear the input and show an error message
            input.value = '';
            input.setCustomValidity('Please enter a valid integer.');
        } else {
            // Input is valid, clear the error message
            input.setCustomValidity('');
            //calculate amount = qty*price
            calculateAmount(input.closest('tr'));
        }
    }

    // Inside your JavaScript file or script tag
    function deleteRow(row) {
        console.log("Delete Row function called");

        var table = document.getElementById("itemTable");
        if (table.rows.length > 2) {
            table.deleteRow(row);
            updateRowCount(); // Update the row count after deleting a row
            calculateSubtotal(); // Recalculate the subtotal after deleting a row
        } else {
            // Clear input fields of the first row
            var inputs = table.rows[1].querySelectorAll("input");
            var selectInput = table.rows[1].querySelector("select");
            var subtotalInput = document.querySelector("input[name='subtotal']"); // Adjust the selector to target the correct subtotal input field

            inputs.forEach(function(input) {
            input.value = "";
            });
            // Reset the select input to its default value (first option)
            selectInput.selectedIndex = 0;

            // Clear the subtotal input field if it exists
            if (subtotalInput) {
                subtotalInput.value = 0;
            }
            calculateAmount(row);
            calculateSubtotal(); // Recalculate the subtotal after clearing the input fields
        }
    }


    
    // Function to calculate the amount based on quantity and price
    function calculateAmount(row) {
      var qtyInput = row.querySelector("input[name='qty[]']");
      var priceInput = row.querySelector("input[name='price[]']");
      var amountInput = row.querySelector("input[name='total[]']");

      var qty = parseFloat(qtyInput.value);
      var price = parseFloat(priceInput.value);
      var amount = qty * price;

      // Set the calculated amount value
      amountInput.value = amount.toFixed(2); // Format amount to 2 decimal places

      calculateSubtotal(); // Recalculate the subtotal after updating an amount
    }

    // Call the function initially to display the row count
    updateRowCount();

    // Add event listener to delete buttons
    var deleteButtons = document.getElementsByClassName("deleteRow");
    for (var i = 0; i < deleteButtons.length; i++) {
      deleteButtons[i].addEventListener("click", function() {
        var rowIndex = this.closest("tr").rowIndex;
        deleteRow(rowIndex);
      });
    }

    // Add event listener to add row button
    document.getElementById("addRowButton").addEventListener("click", function() {
      var table = document.getElementById("itemTable");
      var newRow = table.insertRow(table.rows.length);
      var newRowId = table.rows.length - 1; // Assign unique ID based on row index

      // not yet isi, want to delete
      newRow.innerHTML = `
        <td id="itemNo"></td>
        <td>
        <select class="js-example-data-array" name="medicines[id][]" style="width:190px" onchange="updatePrice(this)" required>
            <option value="" selected disabled>Select Medicine</option>
                @foreach ($medicines as $medicine)
            <option value="{{ $medicine->id }}:{{ $medicine->name }}" data-price="{{ $medicine->price }}">{{ $medicine->name }}</option>
                @endforeach
        </select>
        </td>
        
        <td><input type="text" name="desc[med_prescription][]" class="form-control rounded-0 " placeholder="Dose suggested" style="height:47px"required></td>
        <td><input type="text" name="qty[]" class="form-control rounded-0 text-right" oninput="validateQuantity(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false" ondrop="return false" placeholder="0" style="height:47px" required ></td>
        <td><input type="number" name="price[]" class="form-control rounded-0 text-right bg-white" step="any" oninput="validateFloatInteger(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" onpaste="return false" ondrop="return false" placeholder="0.00" style="height:47px" readonly></td>
        <td><input type="number" name="total[]" value="0.00" class="form-control text-right bg-white border-0" style="margin-top: 6px;" readonly></td>
        <td class="text-center"><button class="btn btn-icon waves-effect waves-light deleteRow"><i class="fas fa-trash-alt text-danger" style="margin-top: 11px;"></i></button></td>
      `;

      // Set unique ID for the new row
      newRow.id = "row_" + newRowId;

      // Attach delete button event listener for the new row
      var deleteButton = newRow.querySelector(".deleteRow");
      deleteButton.addEventListener("click", function() {
        var rowIndex = this.closest("tr").rowIndex;
        deleteRow(rowIndex);
      });

      
        // Initialize Select2 for the newly added row
        $(".js-example-data-array").select2();
      updateRowCount(); // Update the row count after adding a new row
    });

    // Function to calculate the subtotal
    function calculateSubtotal() {
        var serviceInputs = document.querySelectorAll("input[name='serviceTypeCharge']");
        var amountInputs = document.querySelectorAll("input[name='total[]']");
        var subtotalInput = document.querySelector("input[name='subtotal']");

        var subtotal = 0;

        // Calculate subtotal based on amount inputs
        amountInputs.forEach(function(input) {
            subtotal += parseFloat(input.value);
        });

        // Add service charges to the subtotal
        serviceInputs.forEach(function(input) {
            subtotal += parseFloat(input.value);
        });

        // Set the calculated subtotal value
        subtotalInput.value = subtotal.toFixed(2); // Format subtotal to 2 decimal places

        calculateTotal(); // Recalculate the total after updating the subtotal
    }


    // Call the function initially to calculate the subtotal
    calculateSubtotal();

    // Function to calculate the total
    function calculateTotal() {
      var subtotalInput = document.getElementById("subtotal");
      var taxInput = document.getElementById("tax");
      var discountInput = document.getElementById("discount");
      var totalInput = document.getElementById("totalcost");

      var subtotal = parseFloat(subtotalInput.value);
      var tax = parseFloat(taxInput.value);
      var discount = parseFloat(discountInput.value);

      var total = subtotal + tax - discount;

      totalInput.value = total.toFixed(2);
    }
    
</script>

<script>

    var table = document.getElementById("medTable");
    let medNum = 1;

    // dah isi, and want to delete
    function addMedRow() {
        medNum++;
        var row = table.insertRow(-1);
        row.innerHTML = `
            <th style="width: 130px">Medicine ${medNum}</th>
            <td>
                <select class="form-control" name="medicines[id][]" onchange="updatePrice(this)" required>
                    @foreach ($medicines as $medicine)
                        <option value="{{ $medicine->id }}:{{ $medicine->name }}" data-price="{{ $medicine->price }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" class="form-control" name="desc[med_prescription][]" placeholder="Description" required>
            </td>
            <td>
                <input type="number" class="form-control" name="qty[]" placeholder="Quantity" onchange="calculateSubtotal()" required>
            </td>
            <td>
                <input type="number" class="form-control" name="price[]"  value="{{ $medicines[0]->price ? $medicines[0]->price : 0 }}" required>
            </td>
            <td class="text-align-center"><span onclick="deleteRow(this)"><i class="fas fa-trash-alt text-danger"></i></span></td>
        `;
    }

   

    function submitForm() {
        // Serialize the form data and submit the form
        var formData = new FormData(document.getElementById("appointmentForm"));
        fetch('/submitForm', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response if needed
            console.log(data);
        })
        .catch(error => {
            // Handle any errors that occurred during form submission
            console.error('Error submitting the form:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var scheduleNextCheckbox = document.getElementById('scheduleNext');
        var dateInput = document.getElementById('dateInput');
        var timeInput = document.getElementById('timeInput');

        scheduleNextCheckbox.addEventListener('change', function () {
            if (this.checked) {
                dateInput.disabled = false;
                timeInput.disabled = false;
            } else {
                dateInput.disabled = true;
                timeInput.disabled = true;
            }
        });
    });
</script>

<!-- delete prescription -->
<script>
    function confirmAndSubmit(event, index, id, aptid) {
        console.log('Inside confirmAndSubmit');

        var table = document.getElementById('itemTable');
        var rowCount = table.querySelectorAll('tbody tr').length; 
        console.log('Number of rows:', rowCount);
        console.log('Number of index:', index);

        // Dynamically create a form
        var form = document.createElement('form');
        form.action = "/delete-med-prescription/" + id + "/" + aptid;
        form.method = 'POST';
        form.innerHTML = '@csrf' + '<input type="hidden" name="id" value="' + id + '">' + '<input type="hidden" name="aptid" value="' + aptid + '">';

        console.log('Form:', form);

        if (confirm('Are you sure to delete prescription?')) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Delete the row based on the index
            table.deleteRow(index);

            // You may want to recalculate other values like subtotal here
            updateRowCount(); // Update the row count after deleting a row
            calculateSubtotal(); // Recalculate the subtotal after deleting a row

            // Append the form to the document body and submit
            document.body.appendChild(form);
            form.submit();
        } else {
            // Prevent the default form submission behavior
            event.preventDefault();
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('#dateInput').change(function () {
            // Selected date
            var selectedDate = $(this).val();

            // Empty the time dropdown
            $('#timeInput').find('option').not(':first').remove();

           // AJAX request
            $.ajax({
                url: '/doctor/getTimeSlots/' + selectedDate,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    var len = response.length;

                    if (len > 0) {
                        // Read data and create <option>
                        for (var i = 0; i < len; i++) {
                            var selectedTime = response[i];
                            var option = "<option value='" + selectedTime + "'>" + selectedTime + "</option>";
                            $("#timeInput").append(option);
                        }
                    } else {
                        // Handle the case where no time slots are returned
                        $("#timeInput").append("<option value=''>No time slots available</option>");
                        // You can also disable the dropdown or take any other action based on your requirements
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching time slots:', error);
                }
            });

        });
    });

</script>




@include('dup.patientModal')

@endsection
