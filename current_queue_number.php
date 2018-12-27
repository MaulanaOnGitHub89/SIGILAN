<?php 
session_start();
include ("conn.php");
$sql = mysql_query("
select
CASE
	when a.queue_number < 1 then '- - -'
	else
		concat(a.queue_prefix, ' ', LPAD(a.queue_number, 3, '0'))
End
 as queue_number
from trx_counter as a
order by a.call_time desc
limit 1"); 
if (mysql_num_rows($sql) == 0) { 
    echo "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        echo $row['queue_number'];
		$_SESSION["gqueue_number"] = $row['queue_number'];
    } 
} 
mysql_close($link);
?>