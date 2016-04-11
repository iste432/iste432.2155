$(document).ready(function() {
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('#create-prescription-form').submit(validateCreatePrescriptionForm);
	$('#request-refill-form').submit(validateRefillRequest);
});

function validateCreatePrescriptionForm() {
	$('#errors').html("");

	var valid = true;
	var msg = "<p style='color:red;'>";
	var patientId = $('#patient-id').val();
	var medicationId = $('#medication-id').val();
	var dosage = $('#dosage').val();
	var refills = $('#refills').val();
	var expDate = $('#exp-date').val();
	var frequency = $('#frequency').val();
	var route = $('#route').val();

	// validate all form elements
	if (patientId == null || patientId == "") { valid = false; msg += "Please select a patient<br>"; }
	if (medicationId == null || medicationId == "") { valid = false; msg += "Please select a medication<br>"; }
	if (dosage == null || dosage == "") { valid = false; msg += "Please input dosage<br>"; }
	if (refills == null || !isInteger(refills)) { valid = false; msg += "Please input refills<br>"; }
	if (expDate == null || expDate == "") { valid = false; msg += "Please input an expiration date<br>"; }
	if (frequency == null || frequency == "") { valid = false; msg += "Please input a frequency<br>"; }
	if (route == null || route == "") { valid = false; msg += "Please input a route<br>"; }

	if (!valid) {
		event.preventDefault();
	}

	msg += "</p>";

	$('#messages').html(msg);
}

function validateRefillRequest() {
	$('#errors').html("");

	var valid = true;
	var msg = "<p style='color:red;'>";
	var prescriptionId = $('#prescription-id').val();
	var dateRequestedBy = $('#date-requested-by').val();
	var comments = $('#comments').val();

	// validate all form elements
	if (prescriptionId == null || prescriptionId == "") { valid = false; msg += "Please select a Prescription<br>"; }
	if (dateRequestedBy == null || dateRequestedBy == "") { valid = false; msg += "Please include a date requested by<br>"; }
	if (comments == null || comments == "") { valid = false; msg += "Please include comments for reason of refill<br>"; }

	if (!valid) {
		event.preventDefault();
	}

	msg += "</p>";

	$('#messages').html(msg);
}

function isInteger(n) {
	return /^[0-9]+$/.test(n);
}
