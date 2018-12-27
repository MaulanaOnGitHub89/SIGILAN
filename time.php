<?php 
include ("conn.php");
$sql = mysql_query("select DATE_FORMAT(sysdate(), '%H:%i:%S') hours, CASE WHEN
    DATE_FORMAT(SYSDATE(), '%W') = 'Sunday' THEN 'Minggu' WHEN DATE_FORMAT(SYSDATE(), '%W') = 'Monday' THEN 'Senin' WHEN DATE_FORMAT(SYSDATE(), '%W') = 'Tuesday' THEN 'Selasa' WHEN DATE_FORMAT(SYSDATE(), '%W') = 'Wednesday' THEN 'Rabu' WHEN DATE_FORMAT(SYSDATE(), '%W') = 'Thursday' THEN 'Kamis' WHEN DATE_FORMAT(SYSDATE(), '%W') = 'Friday' THEN 'Jumat' ELSE 'Sabtu'
    END AS hari, DATE_FORMAT(sysdate(), ', %d %M %Y') tanggal, CASE WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '01' THEN 'Januari'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '02' THEN 'Februari'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '03' THEN 'Maret'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '04' THEN 'April'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '05' THEN 'Mei'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '06' THEN 'Juni'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '07' THEN 'Juli'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '08' THEN 'Agustus'
    WHEN
    DATE_FORMAT(SYSDATE(), '%m') = '09' THEN 'September'
    END AS bulan"); 
if (mysql_num_rows($sql) == 0) { 
    echo "jam kosong"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        echo
			'<font size="8" style="color:#FFF; font-family:Open Sans, sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;">'.$row['hours'].'</font>'
			.'<br>'.
			'<font size="3" style="color:#FFF; font-family:Open Sans, sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;">'.$row['hari'].$row['tanggal'].'</font>'; 
    } 
} 

mysql_close($link);
?>