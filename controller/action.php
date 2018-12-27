<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	echo "<script>location.href='../index.php';</script>";
}

include "myfunction.php";

$actionName = $_POST["actionName"];

//login
if($actionName=='login'){
	$return = $_POST;
	
	$nip = $_POST["nip"];
	$pswd = $_POST["pswd"];
	$pswd = md5($pswd);
	$sessionId = $_POST["sessionId"];
	
	include ("../conn.php"); 
	$sql = mysql_query("CALL `prcLogin`('$nip', '$pswd', '$sessionId', @outIdOfficer, @outForceChangePwd, @outErrCode, @outErrMsg)") or die('Error, because ' . mysql_error());
	$sql = mysql_query("SELECT @outIdOfficer AS outIdOfficer, @outForceChangePwd AS outForceChangePwd, @outErrCode as outErrCode, @outErrMsg as outErrMsg") or die('Error, because ' . mysql_error());
	while ($row = mysql_fetch_array($sql)) { 
		$return["outIdOfficer"] = $row['outIdOfficer'];
		$return["outForceChangePwd"] = $row['outForceChangePwd'];
		$return["outErrCode"] = $row['outErrCode'];
		$return["outErrMsg"] = $row['outErrMsg'];
		$return["json"] = json_encode($return);
		echo json_encode($return);
	} 
	
	mysql_close($link);
}

//change password
if($actionName=='changepwd'){
	$return = $_POST;
	
	$curpwd = $_POST["curpwd"];
	$newpwd = $_POST["newpwd"];
	$connewpwd = $_POST["connewpwd"];
	$idOfficer = $_POST["idOfficer"];
	
	$curpwd_hash = md5($curpwd);
	$newpwd_hash = md5($newpwd);
	$connewpwd_hash = md5($connewpwd);
	
	include ("../conn.php"); 
	$sql = mysql_query("CALL `prcChangePwd`('$idOfficer', '$curpwd', '$newpwd', '$connewpwd', '$curpwd_hash', '$newpwd_hash', '$connewpwd_hash', @outErrCode, @outErrMsg)") or die('Error, because ' . mysql_error());
	$sql = mysql_query("SELECT @outErrCode as outErrCode, @outErrMsg as outErrMsg") or die('Error, because ' . mysql_error());
	while ($row = mysql_fetch_array($sql)) {
		$return["outErrCode"] = $row['outErrCode'];
		$return["outErrMsg"] = $row['outErrMsg'];
		if(empty($return["outErrCode"])){
			createCookies('cookieChangePwd', 'F');
		}
		$return["json"] = json_encode($return);
		echo json_encode($return);
	}
	
	mysql_close($link);
}

//create cookies
if($actionName=='createCookies'){
	createCookies($_POST["cookie_name"], $_POST["cookie_value"]);
}

//destroy cookies
if($actionName=='destroyCookies'){
	destroyCookies($_POST["cookie_name"], $_POST["cookie_value"]);
}

/*
phpAlert(   $row['outErrCode']."\\n\\".$row['outErrMsg']   );
echo "<script>location.href='../index.php';</script>";
*/
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>