<?php 
include ("conn.php");
$sql = mysql_query("
select
CASE
	when a.queue_number < 1 then '- - -'
	else
		concat(a.queue_prefix, ' ', LPAD(a.queue_number, 3, '0'))
End
 as queue_number
from trx_counter as a where a.id_loket = 4"); 
if (mysql_num_rows($sql) == 0) { 
    echo "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        echo $row['queue_number']; 
    } 
} 
mysql_close($link);
?>