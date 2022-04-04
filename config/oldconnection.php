<?php
	//error_reporting(E_ERROR);
	require 'config.php';

	function getConnection() {
		try {
			global $servername;
			global $user;
			global $dbpass;
			global $dbname;
			
			//echo $servername;
			//$conn = new mysqli($servername, $user, $dbpass, $dbname);
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $dbpass);
			if($conn) {
				echo "--CONNECTED--- ".$dbname;
			}
			else {
				echo $servername." ".$dbname." ".$user." ".$dbpass;
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	//getConnection();

	function selectQuery($qry,$condition) {
		//$con = $this->getConnection();
		$result = $conn->query($qry);
		return $result;
	}
?>
