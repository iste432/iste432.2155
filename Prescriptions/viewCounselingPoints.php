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
	echo getPoints(htmlspecialchars($_GET["mednum"]));
}
//echo out the counseling point information for the med in the URL
?>