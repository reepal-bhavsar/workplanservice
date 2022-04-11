<?php
header("Content-Type:application/json;charset=UTF-8");
//header("Access-Control-Allow-Origin:*");
session_start();
require "function.php";

/*Start: Login API*/
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'login') {
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
			}

			/*check if username or password is empty from the json array request*/
			if(!isset($username) || empty($username) || !isset($password) || empty($password)) {
				//echo "error";
				deliveryResponse(400,'Username and password is required',NULL);
			} else {
				$res = checkWorkerExist($username,$password,0);
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
			}	
		} else {
			deliveryResponse(400,'No data found',NULL);
		}
	} catch(Exception $e) {
		//echo "error";
		deliveryResponse(400,'Bad request'.$e,NULL);
	}
}
/*End: Login API*/

/*Start: Worker Registration Details API*/
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'workerRegistration') {
	try {
		$conn->beginTransaction();
		$requestArray = $_POST['data'];
		$decodeRequest = json_decode($requestArray,true);
		$decodeRequestCount = count($decodeRequest['registration']);
		if($decodeRequestCount>0) {
			foreach($decodeRequest as $key=>$val) {
				$fname = $val[0]['fname'];
				$lname = $val[0]['lname'];
				$email = $val[0]['email'];
				$phone = $val[0]['phone'];
				$username = $val[0]['username'];
				$password = $val[0]['password'];
			}
			if(!isset($fname) || empty($fname) || !isset($lname) || empty($lname) || 
				!isset($email) || empty($email) || !isset($phone) || empty($phone) ||
				!isset($username) || empty($username) || !isset($password) || empty($password)) {
				deliveryResponse(400,'All the fields are required',NULL);
		} else {
				$workerExist = checkWorkerExist($username,$email,1);//Check if worker already exist

				if($workerExist == 'exist') {
					deliveryResponse(400,'User already exist',NULL);
				} else {
					$workerRegistrationDetails = "INSERT INTO user_master(ufname,ulname,email,phone,uname,upassword)VALUES('$fname','$lname','$email','$phone','$username','$password')";
					$workerRegistrationDetailsQQ = $conn->query($workerRegistrationDetails);
					//if worker details added create dynamic worker shift table
					if($workerRegistrationDetailsQQ) {
						$lastId = $conn->lastInsertId();
						$tableName = $lastId."_worker_shift";

						$createWorkerShiftTable = "CREATE TABLE IF NOT EXISTS `".$tableName."` (
							shiftid INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
							shiftmasterid INT NOT NULL ,
							shiftdate DATE NOT NULL ,
							shifttype TINYINT( 4 ) NOT NULL COMMENT '1=0-8, 2=8-16, 3=16-24')";
						$createWorkerShiftTableQQ = $conn->query($createWorkerShiftTable);

						//if worker details added show success or revert worker details and show errormsg
						if($createWorkerShiftTableQQ) {
							deliveryResponse(200,'Worker registration successful',NULL);
						} else {
							$deleteWorkerDetails = "DELETE FROM user_master WHERE uid = '$lastId'";
							$deleteWorkerDetailsQQ = $conn->query($deleteWorkerDetails);

							deliveryResponse(400,'Error in Create worker shift',NULL);
						}
					} else {
						deliveryResponse(400,'Error in create new worker',NULL);
					}
				}
			}
		} else {
			deliveryResponse(400,'No data found',NULL);
		}
	} catch(Exception $e){
		deliveryResponse(400,'Bad request'.$e,NULL);
	}
}
/*End: Worker Registration Details API*/

/*Start: Get Worker Details API*/
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'getWorkerDetails') {
	try {
		$qry = "SELECT uid,uname,ufname,ulname,phone,email FROM user_master WHERE utype = 0";
		$checkUserQQ = $conn->query($qry);
		$checkUserRR = $checkUserQQ ->fetchAll();
		$checkUserNN = count($checkUserRR);

		$responseData = array();
		$i = 0;

		if($checkUserNN > 0)
		{
			foreach($checkUserRR as $key=>$val) {
				$responseData[$i]['uid'] = $val['uid'];
				$responseData[$i]['ufname'] = $val['ufname'];
				$responseData[$i]['ulname'] = $val['ulname'];
				$responseData[$i]['uname'] = $val['uname'];
				$responseData[$i]['phone'] = $val['phone'];
				$responseData[$i]['email'] = $val['email'];
				$i++;
			}
			deliveryResponse(200,'Record found',$responseData);
		}
		else
		{
			deliveryResponse(400,'No record found',NULL);
		}
	} catch(Exception $e) {
		//echo "error";
		deliveryResponse(400,'Bad request'.$e,NULL);
	}
}
/*End: Get Worker Details API*/

/*Start: Add Worker Schedule API*/
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'addSchedule') {
	try {
		$conn->beginTransaction();
		$requestArray = $_POST['data'];
		$decodeRequest = json_decode($requestArray,true);
		$decodeRequestCount = count($decodeRequest['addSchedule']);
		if($decodeRequestCount>0) {
			foreach($decodeRequest as $key=>$val) {
				$workerId = $val[0]['workerid'];
				$scheduleDate = $val[0]['scheduledate'];
				$scheduleTime = $val[0]['scheduletime'];
			}
			if(!isset($workerId) || empty($workerId) || !isset($scheduleDate) || empty($scheduleDate) || 
				!isset($scheduleTime) || empty($scheduleTime)) {
				deliveryResponse(400,'All the fields are required',NULL);
		} else {
				//Check if worker schedule already exist
			$shiftMasterId = checkWorkerScheduleExist($workerId);

			if($shiftMasterId == 'fail') {
				$addIntoScheduleMaster = "INSERT INTO shift_master(userid)VALUES('$workerId')";
				$addIntoScheduleMasterQQ = $conn->query($addIntoScheduleMaster);
				if($addIntoScheduleMasterQQ) {
					$shiftMasterId = $conn->lastInsertId();
				} else {
					deliveryResponse(400,'Error in insert into shift master',NULL);
				}
			}

			$tableName = $workerId."_worker_shift";
			$addIntoWorkerSchedule = "INSERT INTO `".$tableName."`(shiftmasterid,shiftdate,shifttype)VALUES('$shiftMasterId','$scheduleDate','$scheduleTime')";
			$addIntoWorkerScheduleQQ = $conn->query($addIntoWorkerSchedule);

				//if worker schedule added into dynamic worker shift table
			if($addIntoWorkerScheduleQQ) {
				deliveryResponse(200,'Worker schedule added successfully',NULL);
			} else {
				if($shiftMasterId == 0) {
					$deleteIntoScheduleMaster = "DELETE FROM shift_master WHERE userid = '$workerId'";
					$deleteIntoScheduleMasterQQ = $conn->query($deleteIntoScheduleMaster);
				}
				deliveryResponse(400,'Error in insert into worker shift',NULL);
			}
		}
	} else {
		deliveryResponse(400,'No data found',NULL);
	}
} catch(Exception $e){
	deliveryResponse(400,'Bad request'.$e,NULL);
}
}
/*End: Add Worker Schedule API*/

/*Start: Check & Disable PreScheduled Days API*/
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'disablePreScheduledDays') {
	try {
		$conn->beginTransaction();
		$requestArray = $_POST['data'];
		$decodeRequest = json_decode($requestArray,true);
		$decodeRequestCount = count($decodeRequest['preScheduleDays']);
		if($decodeRequestCount>0) {

			foreach($decodeRequest as $key=>$val) {
				$workerId = $val[0]['workerid'];
			}

			//Check if worker schedule already exist
			$shiftMasterId = checkWorkerScheduleExist($workerId);

			if($shiftMasterId>0) {
				$tableName = $workerId."_worker_shift";
				$getScheduledDate = "SELECT shiftdate FROM `".$tableName."` WHERE shiftmasterid = '$shiftMasterId'";
				$getScheduledDateQQ = $conn->query($getScheduledDate);
				$getScheduledDateRR = $getScheduledDateQQ ->fetchAll();
				$getScheduledDateNN = count($getScheduledDateRR);

				$responseData = array();

				if($getScheduledDateNN > 0) {
					foreach($getScheduledDateRR as $key=>$val) {
						$responseData[] = $val['shiftdate'];
					}
					deliveryResponse(200,'Record found',$responseData);
				} else {
					deliveryResponse(400,'No record found',NULL);
				}
			} else {
				deliveryResponse(200,'No data found',NULL);
			}
		}
	} catch(Exception $e) {
		//echo "error";
		deliveryResponse(400,'Bad request'.$e,NULL);
	}
}
/*End: Check & Disable PreScheduled Days API*/
?>