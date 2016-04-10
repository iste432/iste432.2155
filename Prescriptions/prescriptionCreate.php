<?php
require_once('functions.php');

$mysqli = getConnection();

/*
var patientId = $('#patient-id').val();
var medicationId = $('#medication-id').val();
var dosage = $('#dosage').val();
var refills = $('#refills').val();
var expDate = $('#exp-date').val();
var frequency = $('#frequency').val();
var route = $('#route').val();
*/

$result = $mysqli->query("INSERT INTO prescription (PrescriptionID,MedicationID,PhysicianID,PatientID,Dosage,Refills,Exp Date,Frequency,Route) VALUES ()");

$mysqli->close();
?>
