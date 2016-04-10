<?php include "../build.php"; ?>
<?php require_once "functions.php"; ?>
<html>
<head>
	<title>MyHealth</title>
	<link href="../assets/css/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/css/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="../assets/css/prescriptions.css" rel="stylesheet">
	<link href="../assets/css/styleNavbar.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="assets/js/create.js"></script>
	<?php buildHead(); ?>
</head>
<body>
	<?php buildBanner(); ?>

	<div id="wrapper">

		<?php buildNavigation(); ?>

		<div id="content">
			<h3 class="fill-header">Create Prescription</h3>
			<form id="create-prescription-form" action="prescriptionCreate.php" method="POST">
				<table id="create-prescription-table">
					<!-- Physician ID should be pulled from session -->
					<tr>
						<td><label for="patient-id">Patient</label></td>
						<td>
							<select id="patient-id" name="patient-id">
								<?php echo getPatientsOptions(); ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="medication-id">Medication</label></td>
						<td>
							<select id="medication-id" name="medication-id">
								<?php echo getMedicationsOptions(); ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="dosage">Dosage</label></td>
						<td><input id="dosage" name="dosage" type="text"></td>
					</tr>
					<tr>
						<td><label for="refills">Number of Refills</label></td>
						<td><input id="refills" name="refills" type="text"></td>
					</tr>
					<tr>
						<td><label for="exp-date">Expiration Date</label></td>
						<td><input id="exp-date" name="exp-date" type="text"></td>
					</tr>
					<tr>
						<td><label for="frequency">Frequency</label></td>
						<td><input id="frequency" name="frequency" type="text"></td>
					</tr>
					<tr>
						<td><label for="route">Route</label></td>
						<td><input id="route" name="route" type="text"></td>
					</tr>
					<tr>
						<td colspan="2"><button name="submit" value="create-prescription">Submit</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<?php buildFooter(); ?>
</body>
</html>
