<?php 
header("Content-Type:application/json");
//header("Access-Control-Allow-Origin:*");
session_start();
require "function.php";
try {

	$conn->beginTransaction();
	$requestArray = $_GET['data'];
	$decodeRequest = json_decode($requestArray,true);
	$decodeRequestCount = count($decodeRequest['signin']);

	//print_r($decodeRequest['signin']);
	//die();

	if($decodeRequestCount > 0) {
		foreach($decodeRequest as $key=>$val) {
			$username = $val[0]['username'];
			$password = $val[0]['password'];

			if(!isset($username) || empty($username)) {
				//echo "error";
				deliveryResponse(400,'Bad Request',NULL);
			} else {
				$res = checkUser($username,$password);
				//print_r($res);
				if($res != 'fail'){
					foreach($res as $key=>$val) {
						if($key == 'uid') {
							$uid = $val;
						} elseif($key == 'ufname') {
							$ufname = $val;
						} elseif($key == 'ulname') {
							$ulname = $val;
						} elseif($key == 'utype') {
							$utype = $val;
						}
					}

					/*Start: Set Session*/
					$_SESSION['uid'] = $uid;
					$_SESSION['uname'] = $username;
					$_SESSION['ufname'] = $ufname;
					$_SESSION['ulname'] = $ulname;
					/*End: Set Session*/

					deliveryResponse(200,'Login successfull',$utype);
				} else {
					deliveryResponse(400,'Invalid username or password',NULL);
				}
				//echo "{status: 200, message: 'Login Successfull', data: '1'}";
			}
		}
	}
} catch(Exception $e) {
	//echo "error";
	deliveryResponse(400,'1 Bad Request'.$e,NULL);
}


?>