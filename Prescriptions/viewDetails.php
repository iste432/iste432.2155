<?php
include "../build.php";
require_once "functions.php";
if(validate(htmlspecialchars($_GET["medId"])) == false)
{
	header('location:error.php');
}
else
{
	$medId = htmlspecialchars($_GET["medId"]);
}
?>

<!-- verify the patient and prescription from the session and URL respectively before running the query -->
<htmL>
	<head>
		<title> View Details </title>
		<link href="../assets/css/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="../assets/css/font-awesome/font-awesome.css" rel="stylesheet">
		<link href="../assets/css/prescriptions.css" rel="stylesheet">
		<link href="../assets/css/styleNavbar.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="../assets/js/jquery-2.2.3.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="../assets/js/prescriptions.js"></script>
		<?php buildHead("../"); ?>
	</head>
	<body>
	<?php buildBanner("../"); ?>
		<div id="wrapper">
			<?php buildNavigation("../","Prescriptions"); ?>
			<div id="content">
				<h3 class="fill-header">View Prescriptions Details for TradeName</h3>
				<? echo getDetails(htmlspecialchars($_GET["medId"])) ?>
			</div>
		</div>
	</body>
</htmL>

