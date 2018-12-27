<div align="center">
<table width="99%" border="0">
	<tr>
		<td width="20%" height="150" align="center" valign="middle" bgcolor="#1a3b70" style="box-shadow: 10px 10px 20px black; border-radius: 4px;">
		<font style="color:#ffffff; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 15px;"><?php echo $loket_name1; ?></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="queue_number_loket1"></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 20px;"><?php echo $loket_officer_name1; ?></font>
		</td>
		
		<td>
		</td>
		<td>
		</td>
		
		<td width="20%" height="150" align="center" valign="middle" bgcolor="#1a3b70" style="box-shadow: 10px 10px 20px black; border-radius: 4px;">
		<font style="color:#ffffff; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 15px;"><?php echo $loket_name2; ?></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="queue_number_loket2"></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 20px;"><?php echo $loket_officer_name2; ?></font>
		</td>
		
		<td>
		</td>
		<td>
		</td>
		
		<td width="20%" height="150" align="center" valign="middle" bgcolor="#1a3b70" style="box-shadow: 10px 10px 20px black; border-radius: 4px;">
		<font style="color:#ffffff; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 15px;"><?php echo $loket_name3; ?></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="queue_number_loket3"></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 20px;"><?php echo $loket_officer_name3; ?></font>
		</td>
		
		<td>
		</td>
		<td>
		</td>
		
		<td width="20%" height="150" align="center" valign="middle" bgcolor="#1a3b70" style="box-shadow: 10px 10px 20px black; border-radius: 4px;">
		<font style="color:#ffffff; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 15px;"><?php echo $loket_name4; ?></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="queue_number_loket4"></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 20px;"><?php echo $loket_officer_name4; ?></font>
		</td>
		
		<td>
		</td>
		<td>
		</td>
		
		<td width="20%" height="150" align="center" valign="middle" bgcolor="#1a3b70" style="box-shadow: 10px 10px 20px black; border-radius: 4px;">
		<font style="color:#ffffff; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 15px;"><?php echo $loket_name5; ?></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="queue_number_loket5"></font>
		</br>
		<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 20px;"><?php echo $loket_officer_name5; ?></font>
		</td>
	</tr>
</table>
</div>

<input type="text" value="<?php echo $_SESSION['gqueue_number']; ?>" id="txtcurr_number" hidden></input>

<marquee background="img/bgtablewin.jpg" scrollamount="15" style="background-color:#211e33; color: #dddb3e; font-family: arial; font-size: 33px; position:fixed;left:0px;bottom:0px; height:40px;">
<?php
include ("conn.php"); 
$sql = mysql_query("
SELECT textdesc FROM runningtext where activeflag = 'T'"); 
if (mysql_num_rows($sql) == 0) { 
    echo "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        echo '&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/logo2.png" height="30" />&nbsp;&nbsp;&nbsp;&nbsp;'.$row['textdesc'];
    } 
} 
mysql_close($link);
?>
&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/logo2.png" height="30" />
</marquee>