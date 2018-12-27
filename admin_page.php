<!DOCTYPE html>
<html>
<link rel="icon" href="imi.ico">
<title>Admin Page</title>
<script src="jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	// blink "on" state
	function show()
	{
		if (document.getElementById)
		document.getElementById("queue_number").style.visibility = "visible";
	}
	// blink "off" state
	function hide()
	{
		if (document.getElementById)
		document.getElementById("queue_number").style.visibility = "hidden";
	}
	
    var auto_refresh = setInterval(
    function () {
       $('#load_content').load('time.php');
       $('#loket_name').load('current_queue.php');
       $('#queue_number').load('current_queue_number.php');
       $('#queue_number2').load('current_queue_number.php');
       $('#blink_flag').load('blink_flag_admin.php');
       $('#queue_number_loket1').load('queue_number_loket1.php');
       $('#queue_number_loket2').load('queue_number_loket2.php');
       $('#queue_number_loket3').load('queue_number_loket3.php');
       $('#queue_number_loket4').load('queue_number_loket4.php');
       $('#queue_number_loket5').load('queue_number_loket5.php');
	   	   
       var curr_number_txt = document.getElementById("txtcurr_number").value;
	   var curr_number_dbase = document.getElementById("queue_number").innerHTML;
	   var blinkFlag = document.getElementById("blink_flag").innerHTML;
	   
	   //if (curr_number_txt!=curr_number_dbase){
	   if (blinkFlag=="T" && curr_number_dbase != "- - -"){
		    document.getElementById("txtcurr_number").value = curr_number_dbase;
			
			// toggle "on" and "off" states every 450 ms to achieve a blink effect
			// end after 10000 ms
		    for(var i=900; i < 10000; i=i+900)
			{
				setTimeout("hide()",i);
				setTimeout("show()",i+450);
			}
	   }
	   
    }, 1000); // refresh setiap 10000 milliseconds
    
</script>


<style>
video {
	object-fit: fill;
}

.scrollbar
{
	box-shadow: 10px 10px 20px black;
	width: 1200px;
	background: #F8F8F8;
	overflow-y: scroll;
	border-style: solid;
	border: 5px solid #0055e7;
	height: 559px;
	border-top-width: thin;
}

/*
 *  STYLE 11
 */

#style-11::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F8F8F8;
	border-radius: 10px;
}

#style-11::-webkit-scrollbar
{
	width: 10px;
	background-color: #F8F8F8;
}

#style-11::-webkit-scrollbar-thumb
{
	background-color: #3366FF;
	border-radius: 10px;
	background-image: -webkit-linear-gradient(0deg,
	                                          rgba(255, 255, 255, 0.5) 25%,
											  transparent 25%,
											  transparent 50%,
											  rgba(255, 255, 255, 0.5) 50%,
											  rgba(255, 255, 255, 0.5) 75%,
											  transparent 75%,
											  transparent)
}

</style>

<body background="img/BG.jpg" onload="play()">

<?php 
session_start();
include ("conn.php");
$sql = mysql_query("
select a.id_loket, a.loket_name, a.officer_name
from trx_counter as a where a.id_loket = 1
union all
select a.id_loket, a.loket_name, a.officer_name
from trx_counter as a where a.id_loket = 2
union all
select a.id_loket, a.loket_name, a.officer_name
from trx_counter as a where a.id_loket = 3
union all
select a.id_loket, a.loket_name, a.officer_name
from trx_counter as a where a.id_loket = 4
union all
select a.id_loket, a.loket_name, a.officer_name
from trx_counter as a where a.id_loket = 5"); 

if (mysql_num_rows($sql) == 0) { 
    $loket_officer_name1 = "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
		if ($row['id_loket']==1){
			$loket_name1 = $row['loket_name'];
			$loket_officer_name1 = $row['officer_name'];
		}elseif ($row['id_loket']==2){
			$loket_name2 = $row['loket_name'];
			$loket_officer_name2 = $row['officer_name'];
		}elseif ($row['id_loket']==3){
			$loket_name3 = $row['loket_name'];
			$loket_officer_name3 = $row['officer_name'];
		}elseif ($row['id_loket']==4){
			$loket_name4 = $row['loket_name'];
			$loket_officer_name4 = $row['officer_name'];
		}elseif ($row['id_loket']==5){
			$loket_name5 = $row['loket_name'];
			$loket_officer_name5 = $row['officer_name'];
		}
    } 
}

mysql_close($link);
?>

<!--begin header-->
<?php include "header.php" ?>
<!--end header-->

<!--begin middle-->
<table width="100%" border="0">
	<tr>
		<td width="40%" height="150" align="center" valign="middle">
			<table bgcolor="#1a3b70" width="97%" height="90%" style="box-shadow: 10px 10px 20px black; border-radius: 4px;">
				<tr>
					<td align="center" valign="middle">
						<font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;
						font-size: 50px;">
						<!--CUSTOMER SERVICE 1-->
						<div id="loket_name"></div>
						</font>
					</td>
				</tr>
			</table>
		</td>
		<td rowspan="2" width="60%" align="center" valign="top">
			<div align="left" style="padding-top: 5px; padding-bottom: 5px; background-image: url('img/bgtablewin.jpg'); background-color: #0055e7;border: 1px solid #0055e7; border-radius: 10px 10px 1px 1px; width: 1208px; ">
				<font style="color:white; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000; font-size: 15px;">&nbsp;&nbsp;&nbsp;Admin Control</font>
			</div>
			<div class="scrollbar" id="style-11">
			<!--<div style="border-style: solid; border-width: 1px 1px 1px 1px ; height: 559px; overflow-y: scroll;">-->
				<!--begin form-->
				<?php include "main_control.php" ?>
				<!--end form-->	
			</div>
		</td>
	</tr>
	<tr>
		<td height="450" align="center" valign="middle">
			<table bgcolor="#1a3b70" width="97%" height="90%"
				style="box-shadow: 10px 10px 20px black; border-radius: 5px;
					   border: 15px solid #1a3b70;
					  ">
				<tr>
					<td align="center" valign="middle" height="30%">
						<font size="6" style="color:#FFFFFF; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;">NOMOR ANTRIAN</font>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" bgcolor="#1379a1" style="box-shadow: 0px 0px 15px 2px black; border-radius: 5px; ">
						<font  style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 5px 5px 5px #000000;
						font-size: 150px;
						">
						<blink><div id="queue_number"></div></blink>
						</font>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!--end middle-->

<!--begin footer-->
<?php include "footer.php" ?>
<!--end footer-->

</body>
</html>