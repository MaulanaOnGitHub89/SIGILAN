<?php 
include ("conn.php"); 
$sql = mysql_query("select 
CASE
	when a.queue_number < 1 then '- - -'
	else
		a.loket_name
End as loket_name from trx_counter as a
order by a.call_time desc
limit 1"); 
if (mysql_num_rows($sql) == 0) { 
    echo "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        echo $row['loket_name']; 
    } 
} 
mysql_close($link);
?>