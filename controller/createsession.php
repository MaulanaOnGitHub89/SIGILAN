<?php
session_start();
if( !isset($_SESSION['session_id']) ){
	include ("../lib/conn.php");
	$sql = mysql_query("select `GET_SESSION_ID`()  AS SESSION_ID;") or die('Error, because ' . mysql_error()); 
	while ($row = mysql_fetch_array($sql)) {
		$_SESSION["session_id"] = $row['SESSION_ID'];
	}
	mysql_close($link);
}
?>