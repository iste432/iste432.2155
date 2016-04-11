$(document).ready(function() {
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('#create-prescription-form').submit(validateCreatePrescriptionForm);
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

	console.log("dosage: " + dosage);

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

function isInteger(n) {
	return /^[0-9]+$/.test(n);
}
