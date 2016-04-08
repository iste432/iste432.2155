<?php
$db_host = "localhost";  // use "localhost" if the database is running on the same server as your PHP script
$db_user = "yxk6281";    // your RIT username
$db_pass = "fr1end";    // default is "fr1end", but you should change it
$db_name = "yxk6281";    // database name is the same as your username

$conn = mysqli_connect( $db_host, $db_user, $db_pass, $db_name );

function getPatientsOptions() {

	$result = mysqli_query($conn, "select_medication") or die("Query fail: " . mysqli_error());
	$html = "";

	//loop the result set
	while ($row = mysqli_fetch_array($result)){
		$tradeName = $row['TradeName'];
		$html .= "<option>" . $tradeName . "</option>";
	}
	return $html;
}

function getMedicationsOptions() {
	return "<option>test</option><option>test2</option>";
}

?>
