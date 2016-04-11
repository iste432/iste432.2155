<?php
	function buildHead($path = ""){
		echo
		'<link href="' . $path . 'assets/css/style.css" rel="stylesheet" />
		<meta charset="UTF-8">';
	}

	function buildBanner($path){
		echo
		'<!-- MyHealth Div -->
		<div id = "myHealthDiv">
			<div id="myHealthWrapper">
			<h1 id="myHealthH1">MyHealth</h1>
			<form id="searchForm">
				<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" size="20px" />
				<button class="btn btn-default" id="searchBar" type="submit">Search</button>
			</form>
			</div>
		</div>';
	}

	function buildNavigation($path = ""){
		echo
		'<div id="navSide">
			<div class="row">
				<div class="span8">
					<ul class="nav nav-tabs nav-stacked">
						<li class="active"><a href="#"><i class="fa fa-home"></i>Home</a>   </li>
						<li><a href="#"><img id="apptIcon" src="' . $path . 'assets/img/apptIcon.png" alt="Appointment Icon"/></i>Appointment</a></li>
						<li><a href="#"><img id="messageIcon" src="' . $path . 'assets/img/messageIcon.png" alt="Message Icon"/>Message</a></li>
						<li><a href="#"><i class="fa fa-clipboard"></i>Medical Info</a></li>
						<li><a href="#"><i class="fa fa-stethoscope"></i>Tests</a></li>
						<li><a href="Perscriptions/index.php"><i class="fa fa-plus-square"></i>Prescriptions</a></li>
						<li><a href="#"><i class="fa fa-user-md"></i>Find a Physician</a></li>
						<li><a href="#"><i class="fa fa-sign-out"></i>Log out</a></li>
					</ul>
				</div>
			</div>
		</div>';
	}

	function buildFooter($path = ""){
		echo
		'<footer id="global-footer">
			<p>
				<!-- replace # with mailto: destinated email address -->
				Got lost? Let us help you: <a href="#">abc1234@rit.edu</a>
			</p>
			<p>
				Designed and developed by the class of
				Database Development Applications (ISTE.432.01) of Spring 2016
				&copy; Rochester Institute of Technology 2016
			</p>
		</footer>';
	}

?>
