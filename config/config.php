<?php

$servername = "localhost";
$user = "root";
$dbname = "work_planning_service_db";
$dbpass = "";

$path = $_SERVER['DOCUMENT_ROOT']."/worksystem/api/";
define('ROOTAPIURL',$path,true);//access the path while using "include"
define('APIURL',"http://localhost/worksystem/api/",true);

?>
