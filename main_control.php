<script type="text/javascript" src="jquery.js"></script>
<style>
a.button {
    height: 18px;
    padding: 2px 8px;
    border: 1px solid #F3F3F3;
    -moz-box-shadow: 0 0 0 1px #707070;
    -webkit-box-shadow: 0 0 0 1px #707070;
    box-shadow: 0 0 0 1px #707070;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background: -moz-linear-gradient(top, #F2F2F2 0%, #EBEBEB 50%, #DDDDDD 51%, #CFCFCF 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0,#F2F2F2), color-stop(0.5,#EBEBEB),color-stop(0.51,#DDDDDD),color-stop(1,#CFCFCF));
    background: linear-gradient(top, #F2F2F2 0%, #EBEBEB 50%, #DDDDDD 51%, #CFCFCF 100%);
    font: normal 12px sans-serif;
    color: black;
    text-decoration: none;
	font-size: 15px;
}
a.button:hover {
    border: 1px solid #ECF7FD;
    -moz-box-shadow: 0 0 0 1px #3C7FB1;
    -webkit-box-shadow: 0 0 0 1px #3C7FB1;
    box-shadow: 0 0 0 1px #3C7FB1;
    background: -moz-linear-gradient(top, #EAF6FD 0%, #D9F0FC 50%, #BEE6FD 51%, #A7D9F5 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0,#EAF6FD), color-stop(0.5,#D9F0FC),color-stop(0.51,#BEE6FD),color-stop(1,#A7D9F5));
    background: linear-gradient(top, #EAF6FD 0%, #D9F0FC 50%, #BEE6FD 51%, #A7D9F5 100%);
}
a.button:active {
    padding: 2px 7px 3px 9px;
    border: 1px solid #73A7C4;
    border-bottom: 0;
    -moz-box-shadow: 0 0 0 1px #2C628B;
    -webkit-box-shadow: 0 0 0 1px #2C628B;
    box-shadow: 0 0 0 1px #2C628B;
    background: -moz-linear-gradient(top, #E5F4FC 0%, #C4E5F6 50%, #98D1EF 51%, #68B3DB 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0,#E5F4FC), color-stop(0.5,#C4E5F6),color-stop(0.51,#98D1EF),color-stop(1,#68B3DB));
}
</style>
<?php 
include ("conn.php"); 
$sql = mysql_query("
select
a.id_loket, 
CASE
	when a.queue_number < 1 then '000'
	else
		LPAD(a.queue_number, 3, '0')
End
 as queue_number,
a.loket_name, a.officer_name, a.queue_prefix
from trx_counter as a
"); 
if (mysql_num_rows($sql) == 0) { 
    $curr_number_1 = "data not found"; 
} else { 
    while ($row = mysql_fetch_array($sql)) { 
        if($row['id_loket']==1){
			$id_loket_1 = $row['id_loket']; 
			$curr_number_1 = $row['queue_number']; 
			$loket_name_1 = $row['loket_name'];
			$officer_name_1 = $row['officer_name'];
			$queue_prefix_1 = $row['queue_prefix'];
		}elseif($row['id_loket']==2){
			$id_loket_2 = $row['id_loket']; 
			$curr_number_2 = $row['queue_number']; 
			$loket_name_2 = $row['loket_name'];
			$officer_name_2 = $row['officer_name'];
			$queue_prefix_2 = $row['queue_prefix'];
		}elseif($row['id_loket']==3){
			$id_loket_3 = $row['id_loket'];
			$curr_number_3 = $row['queue_number']; 
			$loket_name_3 = $row['loket_name'];
			$officer_name_3 = $row['officer_name'];
			$queue_prefix_3 = $row['queue_prefix'];
		}elseif($row['id_loket']==4){
			$id_loket_4 = $row['id_loket'];
			$curr_number_4 = $row['queue_number']; 
			$loket_name_4 = $row['loket_name'];
			$officer_name_4 = $row['officer_name'];
			$queue_prefix_4 = $row['queue_prefix'];
		}elseif($row['id_loket']==5){
			$id_loket_5 = $row['id_loket'];
			$curr_number_5 = $row['queue_number']; 
			$loket_name_5 = $row['loket_name'];
			$officer_name_5 = $row['officer_name'];
			$queue_prefix_5 = $row['queue_prefix'];
		}
    } 
} 
mysql_close($link);
?>

<!--BEGIN AUDIO FILE-->
<audio id="bell" src="audio/bell.mp3"></audio>
<audio id="nomorantrian" src="audio/nomorantrian.mp3"></audio>

<audio id="a" src="audio/A.mp3"></audio>
<audio id="b" src="audio/B.mp3"></audio>
<audio id="c" src="audio/C.mp3"></audio>

<audio id="seratus" src="audio/100.mp3"></audio>
<audio id="duaratus" src="audio/200.mp3"></audio>
<audio id="tigaratus" src="audio/300.mp3"></audio>
<audio id="empatratus" src="audio/400.mp3"></audio>
<audio id="limaratus" src="audio/500.mp3"></audio>
<audio id="enamratus" src="audio/600.mp3"></audio>
<audio id="tujuhratus" src="audio/700.mp3"></audio>
<audio id="delapanratus" src="audio/800.mp3"></audio>
<audio id="sembilanratus" src="audio/900.mp3"></audio>

<audio id="sebelas" src="audio/11.mp3"></audio>
<audio id="duabelas" src="audio/12.mp3"></audio>
<audio id="tigabelas" src="audio/13.mp3"></audio>
<audio id="empatbelas" src="audio/14.mp3"></audio>
<audio id="limabelas" src="audio/15.mp3"></audio>
<audio id="enambelas" src="audio/16.mp3"></audio>
<audio id="tujuhbelas" src="audio/17.mp3"></audio>
<audio id="delapanbelas" src="audio/18.mp3"></audio>
<audio id="sembilanbelas" src="audio/19.mp3"></audio>

<audio id="sepuluh" src="audio/10.mp3"></audio>
<audio id="duapuluh" src="audio/20.mp3"></audio>
<audio id="tigapuluh" src="audio/30.mp3"></audio>
<audio id="empatpuluh" src="audio/40.mp3"></audio>
<audio id="limapuluh" src="audio/50.mp3"></audio>
<audio id="enampuluh" src="audio/60.mp3"></audio>
<audio id="tujuhpuluh" src="audio/70.mp3"></audio>
<audio id="delapanpuluh" src="audio/80.mp3"></audio>
<audio id="sembilanpuluh" src="audio/90.mp3"></audio>

<audio id="satu" src="audio/1_.mp3"></audio>
<audio id="dua" src="audio/2.mp3"></audio>
<audio id="tiga" src="audio/3.mp3"></audio>
<audio id="empat" src="audio/4.mp3"></audio>
<audio id="lima" src="audio/5.mp3"></audio>
<audio id="enam" src="audio/6.mp3"></audio>
<audio id="tujuh" src="audio/7.mp3"></audio>
<audio id="delapan" src="audio/8.mp3"></audio>
<audio id="sembilan" src="audio/9.mp3"></audio>

<audio id="loket" src="audio/diloket.mp3"></audio>

<audio id="cssatuaudio" src="audio/CS1.mp3"></audio>
<audio id="csduaaudio" src="audio/CS2.mp3"></audio>
<audio id="cstigaaudio" src="audio/CS3.mp3"></audio>
<audio id="ambilpasporaudio" src="audio/ambilpaspor.mp3"></audio>
<audio id="layanwniaudio" src="audio/layanwni.mp3"></audio>
<!--END AUDIO FILE-->

</br>
<!--BEGIN CONTROLLER CS1-->
<table background="img/bgtablewin.jpg" style="background-color: #0055e7;border: 1px solid #0055e7; border-radius: 10px 10px 1px 1px; width: 500px;">
	<tr>
		<td><font style="color:white; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000; font-size: 15px;">&nbsp;&nbsp;<?php echo $loket_name_1." (".$officer_name_1.")";?></font></td>
	</tr>
</table>

<form method="post" class="form-user1">
<table style="background-color: #efebde; border: 5px solid #0055e7; width: 500px; border-top-width: thin;">
	<tr>
		<td align="center">
			<div><font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="hurufinput"><?php echo $queue_prefix_1; ?></font></font></div>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input style="height:50px;color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;width:100px; text-align: center;" maxlength="3" value="<?php echo $curr_number_1; ?>" id="txtLoket1" name="txtLoket1" onkeypress='validate(event)' />
			<input name="txtid_loket1" id="txtid_loket1" value="<?php echo $id_loket_1; ?>" hidden />
		</td>
	</tr>
	<tr>
		<td align="center">
			</br>
			<a class="button" href="#" onclick="actPrev(1, document.getElementById('txtLoket1').value, 'txtLoket1')"><< Previous</a>
			<a class="button" href="#" onclick="setCall(document.getElementById('txtLoket1').value, document.getElementById('hurufinput').innerHTML, 'cssatu', 1, 'txtLoket1', document.getElementById('txtid_loket1').value)">Set & Call</a>
			<a class="button" href="#" onclick="actNext(1, document.getElementById('txtLoket1').value, 'txtLoket1')">Next >></a>
			</br></br>
		</td>
	</tr>
</table>
</form>
<!--END CONTROLLER CS1-->
</br>
<!--BEGIN CONTROLLER CS2-->
<table background="img/bgtablewin.jpg" style="background-color: #0055e7;border: 1px solid #0055e7; border-radius: 10px 10px 1px 1px; width: 500px;">
	<tr>
		<td><font style="color:white; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000; font-size: 15px;">&nbsp;&nbsp;<?php echo $loket_name_2." (".$officer_name_2.")";?></font></td>
	</tr>
</table>

<form method="post" class="form-user2">
<table style="background-color: #efebde; border: 5px solid #0055e7; width: 500px; border-top-width: thin;">
	<tr>
		<td align="center">
			<div><font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="hurufinput2"><?php echo $queue_prefix_2; ?></font></font></div>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input style="height:50px;color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;width:100px; text-align: center;" maxlength="3" value="<?php echo $curr_number_2; ?>" id="txtLoket2" name="txtLoket2" onkeypress='validate(event)' />
			<input name="txtid_loket2" id="txtid_loket2" value="<?php echo $id_loket_2; ?>" hidden />
		</td>
	</tr>
	<tr>
		<td align="center">
			</br>
			<a class="button" href="#" onclick="actPrev(1, document.getElementById('txtLoket2').value, 'txtLoket2')"><< Previous</a>
			<a class="button" href="#" onclick="setCall(document.getElementById('txtLoket2').value, document.getElementById('hurufinput2').innerHTML, 'csdua', 2, 'txtLoket2', document.getElementById('txtid_loket2').value)">Set & Call</a>
			<a class="button" href="#" onclick="actNext(1, document.getElementById('txtLoket2').value, 'txtLoket2')">Next >></a>
			</br></br>
		</td>
	</tr>
</table>
</form>
<!--END CONTROLLER CS2-->
</br>
<!--BEGIN CONTROLLER CS3-->
<table background="img/bgtablewin.jpg" style="background-color: #0055e7;border: 1px solid #0055e7; border-radius: 10px 10px 1px 1px; width: 500px;">
	<tr>
		<td><font style="color:white; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000; font-size: 15px;">&nbsp;&nbsp;<?php echo $loket_name_3." (".$officer_name_3.")";?></font></td>
	</tr>
</table>

<form method="post" class="form-user3">
<table style="background-color: #efebde; border: 5px solid #0055e7; width: 500px; border-top-width: thin;">
	<tr>
		<td align="center">
			<div><font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="hurufinput3"><?php echo $queue_prefix_3; ?></font></font></div>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input style="height:50px;color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;width:100px; text-align: center;" maxlength="3" value="<?php echo $curr_number_3; ?>" id="txtLoket3" name="txtLoket3" onkeypress='validate(event)' />
			<input name="txtid_loket3" id="txtid_loket3" value="<?php echo $id_loket_3; ?>" hidden />
		</td>
	</tr>
	<tr>
		<td align="center">
			</br>
			<a class="button" href="#" onclick="actPrev(1, document.getElementById('txtLoket3').value, 'txtLoket3')"><< Previous</a>
			<a class="button" href="#" onclick="setCall(document.getElementById('txtLoket3').value, document.getElementById('hurufinput3').innerHTML, 'cstiga', 3, 'txtLoket3', document.getElementById('txtid_loket3').value)">Set & Call</a>
			<a class="button" href="#" onclick="actNext(1, document.getElementById('txtLoket3').value, 'txtLoket3')">Next >></a>
			</br></br>
		</td>
	</tr>
</table>
</form>
<!--END CONTROLLER CS3-->
</br>
<!--BEGIN CONTROLLER AMBIL PASPOR-->
<table background="img/bgtablewin.jpg" style="background-color: #0055e7;border: 1px solid #0055e7; border-radius: 10px 10px 1px 1px; width: 500px;">
	<tr>
		<td><font style="color:white; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000; font-size: 15px;">&nbsp;&nbsp;<?php echo $loket_name_4." (".$officer_name_4.")";?></font></td>
	</tr>
</table>

<form method="post" class="form-user4">
<table style="background-color: #efebde; border: 5px solid #0055e7; width: 500px; border-top-width: thin;">
	<tr>
		<td align="center">
			<div><font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="hurufinput4"><?php echo $queue_prefix_4; ?></font></font></div>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input style="height:50px;color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;width:100px; text-align: center;" maxlength="3" value="<?php echo $curr_number_4; ?>" id="txtLoket4" name="txtLoket4" onkeypress='validate(event)' />
			<input name="txtid_loket4" id="txtid_loket4" value="<?php echo $id_loket_4; ?>" hidden />
		</td>
	</tr>
	<tr>
		<td align="center">
			</br>
			<a class="button" href="#" onclick="actPrev(1, document.getElementById('txtLoket4').value, 'txtLoket4')"><< Previous</a>
			<a class="button" href="#" onclick="setCall(document.getElementById('txtLoket4').value, document.getElementById('hurufinput4').innerHTML, 'ambilpaspor', 4, 'txtLoket4', document.getElementById('txtid_loket4').value)">Set & Call</a>
			<a class="button" href="#" onclick="actNext(1, document.getElementById('txtLoket4').value, 'txtLoket4')">Next >></a>
			</br></br>
		</td>
	</tr>
</table>
</form>
<!--END CONTROLLER AMBIL PASPOR-->
</br>
<!--BEGIN CONTROLLER LAYANAN WNI-->
<table background="img/bgtablewin.jpg" style="background-color: #0055e7;border: 1px solid #0055e7; border-radius: 10px 10px 1px 1px; width: 500px;">
	<tr>
		<td><font style="color:white; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000; font-size: 15px;">&nbsp;&nbsp;<?php echo $loket_name_5." (".$officer_name_5.")";?></font></td>
	</tr>
</table>

<form method="post" class="form-user5">
<table style="background-color: #efebde; border: 5px solid #0055e7; width: 500px; border-top-width: thin;">
	<tr>
		<td align="center">
			<div><font style="color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;" id="hurufinput5"><?php echo $queue_prefix_5; ?></font></font></div>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input style="height:50px;color:#91c44a; font-family:'Open Sans', sans-serif; font-weight: bold; text-shadow: 2px 2px #000000;font-size: 50px;width:100px; text-align: center;" maxlength="3" value="<?php echo $curr_number_5; ?>" id="txtLoket5" name="txtLoket5" onkeypress='validate(event)' />
			<input name="txtid_loket5" id="txtid_loket5" value="<?php echo $id_loket_5; ?>" hidden />
		</td>
	</tr>
	<tr>
		<td align="center">
			</br>
			<a class="button" href="#" onclick="actPrev(1, document.getElementById('txtLoket5').value, 'txtLoket5')"><< Previous</a>
			<a class="button" href="#" onclick="setCall(document.getElementById('txtLoket5').value, document.getElementById('hurufinput5').innerHTML, 'layanwni', 5, 'txtLoket5', document.getElementById('txtid_loket5').value)">Set & Call</a>
			<a class="button" href="#" onclick="actNext(1, document.getElementById('txtLoket5').value, 'txtLoket5')">Next >></a>
			</br></br>
		</td>
	</tr>
</table>
</form>
<!--END CONTROLLER LAYANAN WNI-->
</br>


<script type="text/javascript">
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function actPrev() {
	var loketNumber=arguments[0];
	var currNumber=arguments[1];
	var cursorCtl=String(arguments[2]);
	
	if(currNumber>0)
	prevVal=currNumber-1;
	
	document.getElementById(cursorCtl).value = String(prevVal).padStart(3, '0');
}

function actNext() {
	var loketNumber=arguments[0];
	var currNumber=arguments[1];
	var cursorCtl=String(arguments[2]);
	
	if(currNumber<999)
	prevVal=parseInt(currNumber)+1;
	
	document.getElementById(cursorCtl).value = String(prevVal).padStart(3, '0');
}

function setCall() {	
	
	//var data = $('.form-user1').serialize();
	var data = 'txtLoket='.concat(arguments[0].concat('&txtid_loket=').concat(arguments[5]));
	$.ajax({
		type: 'POST',
		url: "set_call.php",
		data: data
	});
	
	
	playAudio(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]);
}

var bell = document.getElementById("bell");
var nomorantrian = document.getElementById("nomorantrian");
var suaraloket = document.getElementById("loket");

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function playAudio() {
		var angka = arguments[0];
		
		var huruf = arguments[1];
		
		var suaralokasi = arguments[2];
		
		var angkarpad = String(pad(angka, 3));
		
		document.getElementById(arguments[4]).value = angkarpad;
		
		if(angka=="000" || angka=="0"){
			return;
		}
		
		var totalwaktu = 0;
		
		bell.pause();
		bell.currentTime=0;
		bell.play();
		
		totalwaktu=bell.duration*1000;	
		
		setTimeout(function() {
								nomorantrian.pause();
								nomorantrian.currentTime=0;
								nomorantrian.play();
							  }, totalwaktu);		
		totalwaktu=totalwaktu+(nomorantrian.duration*1000);
		
		/*huruf*/
		var hurufterpilih = huruf;
		
		if(hurufterpilih=='A') {
			var suarahuruf = document.getElementById("a");
		} else if(hurufterpilih=='B') {
			var suarahuruf = document.getElementById("b");
		} else if(hurufterpilih=='C') {
			var suarahuruf = document.getElementById("c");
		}
			
		setTimeout(function() {
				suarahuruf.pause();
				suarahuruf.currentTime=0;
				suarahuruf.play();
		}, totalwaktu);
		totalwaktu=totalwaktu+(suarahuruf.duration*1000);
		
		/*digit ketiga*/
		var angkasubstring = angkarpad.substring(0, 1);
		if(angkasubstring != '0') {
			if(angkasubstring == '1') {
				var digitketiga = document.getElementById("seratus");
			} else if(angkasubstring == '2') {
				var digitketiga = document.getElementById("duaratus");
			} else if(angkasubstring == '3') {
				var digitketiga = document.getElementById("tigaratus");
			} else if(angkasubstring == '4') {
				var digitketiga = document.getElementById("empatratus");
			} else if(angkasubstring == '5') {
				var digitketiga = document.getElementById("limaratus");
			} else if(angkasubstring == '6') {
				var digitketiga = document.getElementById("enamratus");
			} else if(angkasubstring == '7') {
				var digitketiga = document.getElementById("tujuhratus");
			} else if(angkasubstring == '8') {
				var digitketiga = document.getElementById("delapanratus");
			} else if(angkasubstring == '9') {
				var digitketiga = document.getElementById("sembilanratus");
			}
			
			setTimeout(function() {
					digitketiga.pause();
					digitketiga.currentTime=0;
					digitketiga.play();
			}, totalwaktu);
			totalwaktu=totalwaktu+(digitketiga.duration*1000);
		}
		
		/*digit kedua*/
		var angkasubstring = angkarpad.substring(1, 2);
		if(angkasubstring != '0') {
			if(angkasubstring == '1') {
				
				var angkasubstringterakhir = angkarpad.substring(2, 3);
				if(angkasubstringterakhir == '0') {
					var digitkedua = document.getElementById("sepuluh");
				} else if(angkasubstringterakhir == '1') {
					var digitkedua = document.getElementById("sebelas");
				} else if(angkasubstringterakhir == '2') {
					var digitkedua = document.getElementById("duabelas");
				} else if(angkasubstringterakhir == '3') {
					var digitkedua = document.getElementById("tigabelas");
				} else if(angkasubstringterakhir == '4') {
					var digitkedua = document.getElementById("empatbelas");
				} else if(angkasubstringterakhir == '5') {
					var digitkedua = document.getElementById("limabelas");
				} else if(angkasubstringterakhir == '6') {
					var digitkedua = document.getElementById("enambelas");
				} else if(angkasubstringterakhir == '7') {
					var digitkedua = document.getElementById("tujuhbelas");
				} else if(angkasubstringterakhir == '8') {
					var digitkedua = document.getElementById("delapanbelas");
				} else if(angkasubstringterakhir == '9') {
					var digitkedua = document.getElementById("sembilanbelas");
				}
				
			} else if(angkasubstring == '2') {
				var digitkedua = document.getElementById("duapuluh");
			} else if(angkasubstring == '3') {
				var digitkedua = document.getElementById("tigapuluh");
			} else if(angkasubstring == '4') {
				var digitkedua = document.getElementById("empatpuluh");
			} else if(angkasubstring == '5') {
				var digitkedua = document.getElementById("limapuluh");
			} else if(angkasubstring == '6') {
				var digitkedua = document.getElementById("enampuluh");
			} else if(angkasubstring == '7') {
				var digitkedua = document.getElementById("tujuhpuluh");
			} else if(angkasubstring == '8') {
				var digitkedua = document.getElementById("delapanpuluh");
			} else if(angkasubstring == '9') {
				var digitkedua = document.getElementById("sembilanpuluh");
			}
			
			setTimeout(function() {
					digitkedua.pause();
					digitkedua.currentTime=0;
					digitkedua.play();
			}, totalwaktu);
			totalwaktu=totalwaktu+(digitkedua.duration*1000);
		}
		
		/*digit kesatu*/
		var angkasubstringkedua = angkarpad.substring(1, 2);
		var angkasubstring = angkarpad.substring(2, 3);
		if(angkasubstring != '0' && angkasubstringkedua != '1') {
			if(angkasubstring == '1') {
				var digitkesatu = document.getElementById("satu");
			} else if(angkasubstring == '2') {
				var digitkesatu = document.getElementById("dua");
			} else if(angkasubstring == '3') {
				var digitkesatu = document.getElementById("tiga");
			} else if(angkasubstring == '4') {
				var digitkesatu = document.getElementById("empat");
			} else if(angkasubstring == '5') {
				var digitkesatu = document.getElementById("lima");
			} else if(angkasubstring == '6') {
				var digitkesatu = document.getElementById("enam");
			} else if(angkasubstring == '7') {
				var digitkesatu = document.getElementById("tujuh");
			} else if(angkasubstring == '8') {
				var digitkesatu = document.getElementById("delapan");
			} else if(angkasubstring == '9') {
				var digitkesatu = document.getElementById("sembilan");
			}
			
			setTimeout(function() {
					digitkesatu.pause();
					digitkesatu.currentTime=0;
					digitkesatu.play();
			}, totalwaktu);
			totalwaktu=totalwaktu+(digitkesatu.duration*1000);
		}
				
		/*loket*/
		setTimeout(function() {
				suaraloket.pause();
				suaraloket.currentTime=0;
				suaraloket.play();
		}, totalwaktu);
		totalwaktu=totalwaktu+(suaraloket.duration*1000);
				
		/*lokasi*/
		var lokasiterpilih = suaralokasi;
		
		if(lokasiterpilih=='cssatu') {
			var audiolokasi = document.getElementById("cssatuaudio");
		} else if(lokasiterpilih=='csdua') {
			var audiolokasi = document.getElementById("csduaaudio");
		} else if(lokasiterpilih=='cstiga') {
			var audiolokasi = document.getElementById("cstigaaudio");
		} else if(lokasiterpilih=='ambilpaspor') {
			var audiolokasi = document.getElementById("ambilpasporaudio");
		} else if(lokasiterpilih=='layanwni') {
			var audiolokasi = document.getElementById("layanwniaudio");
		}
		
		setTimeout(function() {
				audiolokasi.pause();
				audiolokasi.currentTime=0;
				audiolokasi.play();
		}, totalwaktu);
		totalwaktu=totalwaktu+(audiolokasi.duration*1000);
} 

</script>