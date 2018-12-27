<?php 
include ("conn.php"); 
$sql = mysql_query("select param_value from mst_param where param_name = 'BLINK'"); 
if (mysql_num_rows($sql) == 0) { 
    echo "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        echo $row['param_value']; 
		if($row['param_value']=="T"){
			mysql_query("update mst_param set param_value = 'F' where param_name = 'BLINK'");
		}
    } 
} 
mysql_close($link);
?>