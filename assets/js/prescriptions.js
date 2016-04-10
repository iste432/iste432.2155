$(document).ready(function() {
	$('.datepicker').datepicker();
	$('#create-prescription-form').submit(validateCreatePrescriptionForm);
});

function validateCreatePrescriptionForm() {
	$('#errors').html("");

	var valid = true;
	var msg = "<span style='color:red;'";
	var patientId = $('#patient-id').val();
	var medicationId = $('#medication-id').val();
	var dosage = $('#dosage').val();
	var refills = $('#refills').val();
	var expDate = $('#exp-date').val();
	var frequency = $('#frequency').val();
	var route = $('#route').val();

	// validate all form elements
	if (patientId == null) { valid = false; msg += "Please select a patient<br>"; }
	if (medicationId == null) { valid = false; msg += "Please select a medication<br>"; }
	if (dosage == null || !isInteger(dosage)) { valid = false; msg += "Please input dosage<br>"; }
	if (refills == null || !isInteger(refills)) { valid = false; msg += "Please input refills<br>"; }
	if (expDate == null || expDate == "") { valid = false; msg += "Please input an expiration date<br>"; }
	if (frequency == null || frequency == "") { valid = false; msg += "Please input a frequency<br>"; }
	if (route == null || route == "") { valid = false; msg += "Please input a route<br>"; }

	if (!valid) {
		event.preventDefault();
	}

	msg += "</span>";

	$('#messages').html(msg);
}

function isInteger(n) {
	return /^[0-9]+$/.test(n);
}
