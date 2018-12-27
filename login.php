<!DOCTYPE html>
<html lang="en">
<title>Login - Kanim Ketapang</title>
<link rel="icon" href="imi.ico">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  
  <link rel="stylesheet" href="lib/4_1_3_bootstrap.min.css">
  <script src="lib/3_3_1_jquery.min.js"></script>
  <script src="lib/1_14_3_umd_popper.min.js"></script>
  <script src="lib/4_1_3_js_bootstrap.min.js"></script>  
  <script src="lib/3_3_7_js_bootstrap.min.js"></script>
  <link rel="stylesheet" href="lib/3_3_7_css_bootstrap.min.css">
</head>
<body>

<?PHP 
session_start();
if( !isset($_SESSION['session_id']) ){
	include ("conn.php");
	$sql = mysql_query("select `GET_SESSION_ID`()  AS SESSION_ID;"); 
	while ($row = mysql_fetch_array($sql)) {
		$_SESSION["session_id"] = $row['SESSION_ID'];
	}
	mysql_close($link);
}
?>
<div class="container">
  <h2>Login User</h2>
  
<div id="alertBox" class="alert alert-danger alert-dismissible fade in" onclick="hideBox()">
<a href="#" class="close" >&times;</a>
<strong>Attention!</strong>
<div class="the-return">
</div>
</div>
  
  <form class="needs-validation" novalidate method="post">
    <input name="actionName" type="hidden" value="login" />
	<input name="sessionId" type="hidden" value=<?php echo $_SESSION["session_id"]; ?> />
	<div class="form-group">
      <label for="nip">NIP:</label>
      <input type="number" class="form-control" id="nip" placeholder="Enter NIP" name="nip" required>
      <div class="invalid-feedback">
        Please input your NIP.
      </div>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
      <div class="invalid-feedback">
        Please input your password.
      </div>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <button id="btnSubmit" type="button" class="btn btn-primary" onclick="doLogin()">Submit</button>
  </form>
  <div class="the-return2" align="center"></div>
</div>

<script type="text/javascript">

var input = document.getElementById("pwd");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("btnSubmit").click();
    }
});

$("#alertBox").hide();

function hideBox(){
	$("#alertBox").hide(10);
}

function doLogin(){
	$(".the-return2").html(
		"Please Wait..."
	)
	
	var data = $('.needs-validation').serialize();
	$.ajax({
		type: 'POST',
		dataType: "json",
		url: "controller/action.php",
		data: data,
		success: function(data) {
			if(data["outErrCode"]==null){
				
				createCookies(data["outIdOfficer"]);
				
				if(data["outForceChangePwd"]=='T'){
					location.href='view/forcechangepswd.php';
				}else{
					location.href='view/main.php';
				}
			}else{
				document.getElementById('pwd').value = "";
				$(".the-return2").html(
					""
				)
				$(".the-return").html(
					data["outErrCode"] + " " +data["outErrMsg"]
				)
				$("#alertBox").hide(10);
				$("#alertBox").show(1000);
			}
		}
	});
}

function createCookies(){
	
	var data = 'outIdOfficer='.concat(arguments[0].concat('&actionName=createCookies'));
	$.ajax({
		type: 'POST',
		url: "controller/action.php",
		data: data
	});
	
}
</script>
</body>
</html>