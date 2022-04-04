<?php
require '../config/connection.php';

/*Start: Check if worker exist*/
function checkWorkerExist($username,$data,$status) {
	global $conn;
	/*1 = registration, 0 = login*/
	if($status == 1) {
		$fetchUserDataStr = "uid";
		$whereConditionStr = "email = '$data'";
	} else {
		$fetchUserDataStr = "uid,ufname,ulname,utype";
		$whereConditionStr = "upassword = '$data'";
	}

	$qry = "SELECT $fetchUserDataStr FROM user_master 
	WHERE uname ='$username' AND $whereConditionStr";
	$checkUserQQ = $conn->query($qry);
	$checkUserRR = $checkUserQQ ->fetchAll();
	$checkUserNN = count($checkUserRR);

	if($checkUserNN > 0)
	{
		if($status == 1) {
			return "exist";//User already exist
		} else {
			$uid = $checkUserRR[0]['uid'];
			$ufname = $checkUserRR[0]['ufname'];
			$ulname = $checkUserRR[0]['ulname'];
			$utype = $checkUserRR[0]['utype'];

			return array("uid"=>$uid,"ufname"=>$ufname,"ulname"=>$ulname,"utype"=>$utype);
		}
	}
	else
	{
		return "fail";
	}

	/*$checkUserQry = $conn->prepare("SELECT * FROM user_master WHERE uname ='$username' AND upassword = '$password'");
	$checkUserQry->execute();
	$result = $checkUserQry->fetch();
	return $result;*/
}
/*End: Check if worker exist*/

/*Start: Check if worker schedule already exist in schedule master*/
function checkWorkerScheduleExist($workerid) {
	global $conn;

	$checkWorkerSchedule = "SELECT shiftmasterid FROM shift_master WHERE userid ='$workerid'";
	$checkWorkerScheduleQQ = $conn->query($checkWorkerSchedule);
	$checkWorkerScheduleRR = $checkWorkerScheduleQQ ->fetchAll();
	$checkWorkerScheduleNN = count($checkWorkerScheduleRR);

	if($checkWorkerScheduleNN > 0)
	{
		return $checkWorkerScheduleRR[0]['shiftmasterid'];//Worker schedule already exist
	}
	else
	{
		return "fail";
	}
}
/*End: Check if worker schedule already exist in schedule master*/

/*Start: API Call with CURL*/
function curlCall($url,$args=array(),$method) {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);  
	if($method != "GET") {
		curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($args));
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'$method');
	}
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
/*End: API Call with CURL*/

/*Start: API Delivery Response*/
function deliveryResponse($status,$msg,$res) {
	$response = array("status"=>$status,"message"=>$msg,"res"=>$res);
	echo json_encode($response);
}
/*End: API Delivery Response*/
?>