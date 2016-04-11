<?php
define("HOST", "localhost");
define("USER", "yxk6281");
define("PASS", "fr1end");
define("DB", "yxk6281");
define("PHYSICIAN_ID", "PHY000000000001");
define("PATIENT_ID", "PAT000000000001");

function getConnection() {
	$mysqli = new mysqli(HOST, USER, PASS, DB);

	if (!$mysqli) {
		echo( "Connect failed: " . mysqli_connect_error() );
		exit();
	}

	return $mysqli;
}

function getPatientsOptions() {
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT pat.Name as Name, pat.PatientID as PatientID FROM patient pat JOIN patientphysician pp USING(PatientID) JOIN physician phy ON pp.PhysicianID = phy.PhysicianID WHERE pp.PhysicianID='" . PHYSICIAN_ID . "' ORDER BY Name");
	$html = "";

	if ($result && $mysqli->affected_rows > 0) {
		while ($row = mysqli_fetch_array($result)){
			$id = $row['PatientID'];
			$name = $row['Name'];
			$html .= "<option value='" . $id . "'>" . $name . "</option>";
		}
	} else {
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
}

function getMedicationsOptions() {
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT MedicationID, TradeName, GenericName FROM medication ORDER BY TradeName");
	$html = "";

	if ($result && $mysqli->affected_rows > 0) {
		while ($row = mysqli_fetch_array($result)){
			$id = $row['MedicationID'];
			$tradeName = $row['TradeName'];
			$genericName = $row['GenericName'];
			$html .= "<option value='" . $id . "'>" . $tradeName . "</option>";
		}
	} else {
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
}

function getPrescriptions() {
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT p.PrescriptionID as PrescriptionID, p.`Exp Date` as ExpDate, m.TradeName as TradeName FROM prescription p JOIN medication m USING (MedicationID) WHERE PatientID='" . PATIENT_ID . "' ORDER BY m.TradeName");
	$html = "";

	if ($result && $mysqli->affected_rows > 0) {
		while ($row = mysqli_fetch_array($result)){
			$id = $row['PrescriptionID'];
			$expDate = $row['ExpDate'];
			$tradeName = $row['TradeName'];
			$html .= "<option value='" . $id ."'>" . $tradeName . " (expires " . $expDate . ")</option>";
		}
	} else {
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
}

?>
