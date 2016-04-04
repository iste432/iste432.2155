<?php include "build.php"; ?>
<html>
<head>
	<title>MyHealth</title>
	<link href="assets/css/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome/font-awesome.css" rel="stylesheet">
	<link href="assets/css/styleNavbar.css" rel="stylesheet" />
	<?php buildHead(); ?>
</head>
<body>
	<?php buildBanner(); ?>
	
	<div id="wrapper">
	
		<?php buildNavigation(); ?>

		<div id="content">
			<h3>Welcome, Christian Bale!</h3> 

			<table id="summary">
				<tr>
					<td><img id="apptIcon" src="assets/img/apptIcon.png" alt="Appointment Icon" /> &nbsp; Appointment</td>
					<td>You currenthy have no scheduled appointment.</td>
				</tr>
				<tr>
					<td><img id="messageIcon" src="assets/img/messageIcon.png" alt="Message Icon"/> &nbsp; Message</td>
					<td><a href="#">You have new 1 message.</a></td>
				</tr>
				<tr>
					<td><img id="medicalIcon" src="assets/img/medicalIcon.png" alt="Medical Icon"/> &nbsp; Medical Info</td>
					<td><a href="#">You have new 2 test results.</a></td>
				</tr>
			</table>
			<div class="buttons">
				<div id="requestAppt"><a href="#">Request an appointment</a></div>
				<div id="sendMsg"><a href="#">Send message to your doctor</a></div>
				<div id="requestPres"><a href="#">Prescription refill</a></div>
			</div>
		</div>
	</div>
	
	<?php buildFooter(); ?>
</body>
</html>