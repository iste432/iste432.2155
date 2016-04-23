<?php
//going to have some sort of validation that will validate if the medicaiton is in their list or not
include "../build.php";
require_once "functions.php";
if(validate(htmlspecialchars($_GET["medId"]),'12345') == false)
{
	header('location:error.php');
}
else
{
	$medId = htmlspecialchars($_GET["medId"]);
}	
?>

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
			<?php buildNavigation("../"); ?>
			<div id="content">
				<h3 class="fill-header">View Counseling Points for TradeName</h3>
				<? echo getPoints(htmlspecialchars($_GET["medId"])) ?>
			</div>
		</div>
	</body>
</htmL>
