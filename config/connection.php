<?php
//error_reporting(E_ERROR);
require 'config.php';
try {
		//$conn = new mysqli($servername, $user, $dbpass, $dbname);
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $dbpass);
	if($conn) {
			//echo "--CONNECTED--- ".$dbname;
	}
	else {
			//echo $servername." ".$dbname." ".$user." ".$dbpass;
	}

} catch (PDOException $e) {
	echo $e->getMessage();
}

?>