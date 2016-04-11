<?php include "../../build.php"; ?>
<?php require_once "../functions.php"; ?>
<?
if (isset($_POST['submit']) && $_POST['submit'] == "request-refill") {
	$mysqli = getConnection();

	unset($_POST['submit']);
	$_POST['status'] = "pending";
	$values = "'" . implode("','",$_POST) . "'";
	$values .= ",CURDATE()";

	$query = "INSERT INTO refillrequest (PrescriptionID,DateRequestedBy,Comments,Status,DateCreated) VALUES ($values)";

	$result = $mysqli->query($query);

	if ($result) {
		unset($_POST);
		$_POST['message'] = "<span style='color:green;'>Successfully created prescription" . $mysqli->error . "</span>";
	} else {
		$_POST['message'] = "<span style='color:red;'>Error in creating prescription</span>";
	}

	$mysqli->close();
}
?>
<html>
<head>
	<title>MyHealth</title>
	<link href="../../assets/css/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="../../assets/css/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="../../assets/css/prescriptions.css" rel="stylesheet">
	<link href="../../assets/css/styleNavbar.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="../../assets/js/jquery-2.2.3.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="../../assets/js/prescriptions.js"></script>
	<?php buildHead(); ?>
</head>
<body>
	<?php buildBanner(); ?>

	<div id="wrapper">

		<?php buildNavigation(); ?>

		<div id="content">
			<h3 class="fill-header">Request Refill</h3>
			<div id="messages">
				<?php if (isset($_POST['message']) && $_POST['message'] != "") {echo $_POST['message']; } ?>
			</div>
			<form id="request-refill-form" method="POST">
				<table id="request-refill-table">
					<!-- Patient ID should be pulled from session for listing associated prescriptions -->
					<!-- Date Created should be pulled from current date -->
					<tr>
						<td><label for="prescription-id">Prescription</label></td>
						<td>
							<select id="prescription-id" name="prescription-id">
								<?php echo getPrescriptions(); ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="date-requested-by">Date Requested By</label></td>
						<td><input id="date-requested-by" class="datepicker" name="date-requested-by" type="text" value="<?php echo $_POST['date-requested-by']; ?>"></td>
					</tr>
					<tr>
						<td><label for="comments">Comments</label></td>
						<td><textarea id="comments" name="comments" value="<?php echo $_POST['comments']; ?>"></textarea></td>
					</tr>
					<tr>
						<td colspan="2"><button name="submit" value="request-refill">Submit</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<?php buildFooter(); ?>
</body>
</html>
