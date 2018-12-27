<?php 
include 'conn.php';
$txtLoket = $_POST['txtLoket'];
$txtid_loket = $_POST['txtid_loket'];

mysql_query("update trx_counter set queue_number = ".$txtLoket.", call_time = now() where id_loket = ".$txtid_loket."");

mysql_query("update mst_param set param_value = 'T' where param_name = 'BLINK'");

mysql_query("update mst_param set param_value = 'T' where param_name = 'BLINK_ADMIN'");

mysql_close($link);
?>