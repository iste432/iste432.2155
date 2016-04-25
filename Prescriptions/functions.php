<?php
define("HOST", "localhost");
define("USER", "iste432a");
define("PASS", "girlScoutCookies");
define("DB", "iste432a");
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

//security measure to make sure that the prescription entered in the url is one they can access
function validate($medNum)
{
	$mysqli = getConnection();
	$result = $mysqli->query("select * from prescriptions WHERE PatientID='" . PATIENT_ID . "'");
	return true;
}


function getPatientsOptions() {
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT pat.Name as Name, pat.PatientID as PatientID FROM patient pat JOIN patientphysician pp USING(PatientID) JOIN physician phy 
		ON pp.PhysicianID = phy.PhysicianID WHERE pp.PhysicianID='" . PHYSICIAN_ID . "' ORDER BY Name");
	$html = "";

	if ($result && $mysqli->affected_rows > 0) {
		while ($row = mysqli_fetch_array($result)){
			$id = $row['PatientID'];
			$name = $row['Name'];
			if ($id == $_POST['patient-id']) {
				$html .= $html .= "<option value='" . $id . "' selected>" . $name . "</option>";
			} else {
				$html .= "<option value='" . $id . "'>" . $name . "</option>";
			}
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
			if ($id == $_POST['medication-id']) {
				$html .= "<option value='" . $id . "' selected>" . $tradeName . "</option>";
			} else {
				$html .= "<option value='" . $id . "'>" . $tradeName . "</option>";
			}
		}
	} else {
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
}

function getPrescriptions() { //for the dropdown
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT p.PrescriptionID as PrescriptionID, p.`ExpDate` as ExpDate, m.TradeName as TradeName FROM prescription p 
		JOIN medication m USING (MedicationID) WHERE PatientID='" . PATIENT_ID . "' ORDER BY m.TradeName");
	$html = "";

	if ($result && $mysqli->affected_rows > 0) {
		while ($row = mysqli_fetch_array($result)){
			$id = $row['PrescriptionID'];
			$expDate = $row['ExpDate'];
			$tradeName = $row['TradeName'];
			if ($id == $_POST['prescription-id']) {
				$html .= "<option value='" . $id ."' selected>" . $tradeName . " (expires " . $expDate . ")</option>";
			} else {
				$html .= "<option value='" . $id ."'>" . $tradeName . " (expires " . $expDate . ")</option>";
			}
		}
	} else {
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
}

function getPrescriptionsList()
{
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT 
		p.PrescriptionID as PrescriptionID,
		p.Dosage as Dosage,
		p.Refills as Refills,
		p.Frequency as Frequency,
		p.Route as Route,
		p.ExpDate as ExpDate, 
		m.TradeName as TradeName,
		m.MedicationID as MedicationID
	FROM prescription p 
	JOIN medication m USING (MedicationID) WHERE PatientID='" . PATIENT_ID . "' ORDER BY m.TradeName asc");
	$html = "";

	if ($result && $mysqli->affected_rows > 0)
	{
		$html .= "<table class='table table-striped table-bordered table-hover'>
		<tr>
			<th>Trade Name</th>
			<th>Dosage</th>
			<th>Refills</th>
			<th>Expiration Date</th>
			<th>Frequency</th>
			<th>Route</th>
			<th>View Details</th>
			<th>Request Refill</th>
		</tr>";

		while ($row = mysqli_fetch_assoc($result))
		{
			$TradeName = $row['TradeName'];
			$id = $row['PrescriptionID'];
			$Dosage = $row['Dosage'];
			$Refills = $row['Refills'];
			$Frequency = $row['Frequency'];
			$Route = $row['Route'];
			$ExpDate = $row['ExpDate'];
			$TradeName = $row['TradeName'];
			$MedicationID = $row['MedicationID'];
			
			$html .= "
				<tr>
					<td>". $TradeName ." </td>
					<td>". $Dosage ."</td>
					<td>". $Refills ."</td>
					<td>". $ExpDate."</td>
					<td>". $Frequency ."</td>
					<td>". $Route ."</td>
					<td><a href='viewDetails.php?medId=".$MedicationID."'> View Details </a></td>
					<td><a href='Refill/request.php?medId=".$MedicationID."&id=".$id."'> Request a refill </a></td>
				</tr>
			";				
		}
		$html .=  "</table>";

	} 
	else
	{
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
} //end get prescription list


function getDetails($medNum)
{
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT 
		m.TradeName as TradeName,
		p.PrescriptionID as PrescriptionID,
		p.Dosage as Dosage,
		p.Refills as Refills,
		p.Frequency as Frequency,
		p.Route as Route,
		p.ExpDate as ExpDate, 
		m.GenericName as GenericName,
		m.MedicationID as MedicationID
	FROM prescription p 
	JOIN medication m USING (MedicationID) WHERE PatientID='" . PATIENT_ID . "' and
	m.medicationID = '".$medNum."' ORDER BY m.GenericName");

	$html = "";

	if ($result && $mysqli->affected_rows > 0)
	{
		$html .= "
		<table class='table table-striped table-bordered table-hover'>
		<tr>
			<th>Trade Name</th>
			<th>Generic Name</th>
			<th>Dosage</th>
			<th>Refills</th>
			<th>Expiration Date</th>
			<th>Frequency</th>
			<th>Route</th>
			<th>View Counseling Points</th>
			<th>Request Refill</th>
		</tr>";

		while ($row = mysqli_fetch_assoc($result))
		{
			$TradeName = $row['TradeName'];
			$GenericName = $row['GenericName'];
			$id = $row['PrescriptionID'];
			$Dosage = $row['Dosage'];
			$Refills = $row['Refills'];
			$Frequency = $row['Frequency'];
			$Route = $row['Route'];
			$ExpDate = $row['ExpDate'];
			$TradeName = $row['TradeName'];
			$MedicationID = $row['MedicationID'];
			
			$html .= "
				<tr>
					<td>". $TradeName ." </td>
					<td>". $GenericName ." </td>
					<td>". $Dosage ."</td>
					<td>". $Refills ."</td>
					<td>". $ExpDate."</td>
					<td>". $Frequency ."</td>
					<td>". $Route ."</td>
					<td><a href='viewCounselingPoints.php?medId=".$MedicationID."' target='_blank'>View Counseling Points </a> </td>
					<td><a href='Refill/request.php?medId=".$MedicationID."&id=".$id."'> Request a refill </a></td>
				</tr>
			";				
		}
		$html .=  "</table>";

	} 
	else
	{
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
} //end getDetails


function getPoints($medNum)
{
	$mysqli = getConnection();

	$result = $mysqli->query("SELECT
		m.GenericName as GenericName,
		m.TradeName as TradeName, 
		m.GenericCategory as GenericCategory,
		m.TherapeuticCategory as TherapeuticCategory,
		m.CounselingPoints as CounselingPoints
	FROM medication m WHERE m.medicationID = '".$medNum."';");

	$html = "";

	if ($result && $mysqli->affected_rows > 0)
	{
		$html .= "
		<table class='table table-striped table-bordered table-hover'>
		<tr>
			<th>Generic Name</th>
			<th>Trade Name</th>
			<th>Generic Category</th>
			<th>Therapeutic Category</th>
			<th>Counseling Points</th>
		</tr>";

		while ($row = mysqli_fetch_assoc($result))
		{
			$GenericName = $row['GenericName'];
			$TradeName = $row['TradeName'];
			$GenericCategory = $row['GenericCategory'];
			$TherapeuticCategory = $row['TherapeuticCategory'];
			$CounselingPoints = $row['CounselingPoints'];
			
			$html .= "
				<tr>
					<td>". $GenericName ." </td>
					<td>". $TradeName ." </td>
					<td>". $GenericCategory ."</td>
					<td>". $TherapeuticCategory ."</td>
					<td>". $CounselingPoints."</td>
				</tr>
			";				
		}
		$html .=  "</table>";

	} 
	else
	{
		$html = $mysqli->error;
	}

	$mysqli->close();

	return $html;
}



?>
