<?php
function getOfficerDispName($IdOfficer) {
	include ("../lib/conn.php");
	$sql = mysql_query("select `GET_OFFICER_DISP_NAME`(".$IdOfficer.")  AS OFFICER_DISP_NAME") or die('Error, because ' . mysql_error()); 
	while ($row = mysql_fetch_array($sql)) {
		$vRet = $row['OFFICER_DISP_NAME'];
		
	}
	mysql_close($link);
	$vRet = strtolower($vRet);
	return $vRet;
}

function createCookies($cookieName, $cookieValue) {
	setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
}

function destroyCookies($cookieName, $cookieValue) {
	setcookie($cookieName, $cookieValue, time() - (86400 * 30), "/");
	unset($_COOKIE[$cookieName]);
}

function setMenuStyle($menuName, $pageName) {
	if ($menuName==$pageName) {
		echo "nav-item active";
	} else {
		echo "nav-item";
	}
}

function setContentPage($getPage) {
	switch ($getPage) {
		case "call":
			include "../view/call.php";
			break;
		case "recall":
			include "../view/recall.php";
			break;
		case "personalization":
			include "../view/personalization.php";
			break;
		default:
			include "../view/default.php";
	}
}

function getQueueGroup($IdOfficer) {
	include ("../lib/conn.php");
	$sql = mysql_query("select `GET_QUEUE_GROUP`(".$IdOfficer.")  AS QUEUE_GROUP") or die('Error, because ' . mysql_error()); 
	while ($row = mysql_fetch_array($sql)) {
		$vRet = $row['QUEUE_GROUP'];
		
	}
	mysql_close($link);
	return $vRet;
}

function getCurrQueue($IdOfficer) {
	include ("../lib/conn.php");
	$sql = mysql_query("select `GET_CURR_QUEUE`(".$IdOfficer.")  AS QUEUE_NUMBER") or die('Error, because ' . mysql_error()); 
	while ($row = mysql_fetch_array($sql)) {
		$vRet = $row['QUEUE_NUMBER'];
		
	}
	mysql_close($link);
	return $vRet;
}
?>