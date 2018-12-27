<!DOCTYPE html>
<html lang="en">
<title>Nama App</title>
<link rel="icon" href="../imi.ico">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="../lib/4_1_3_bootstrap.min.css">
  <script src="../lib/3_3_1_jquery.min.js"></script>
  <script src="../lib/1_14_3_umd_popper.min.js"></script>
  <script src="../lib/4_1_3_js_bootstrap.min.js"></script>  
  <script src="../lib/3_3_7_js_bootstrap.min.js"></script>
  <link rel="stylesheet" href="../lib/3_3_7_css_bootstrap.min.css">
</head>
<body>

<?PHP 
include "../controller/createsession.php";
include "../controller/myfunction.php";

if(!isset($_COOKIE['cookieIdOfficer'])) {
    echo "<script>location.href='login.php';</script>";
}
else{
	if(isset($_COOKIE['cookieChangePwd']) && $_COOKIE['cookieChangePwd'] == 'F') {
		echo "<script>location.href='main.php';</script>";
	}
}
?>
<div class="container">
  <h2>Hi <?php echo ucfirst(getOfficerDispName($_COOKIE['cookieIdOfficer']));?>, to activation please change your password first!</h2>
  
  
<div id="alertBox" class="alert alert-danger alert-dismissible fade in" onclick="hideBox()">
<a href="#" class="close" >&times;</a>
<strong>Attention!</strong>
<div class="the-return">
</div>
</div>

  <form class="needs-validation" novalidate method="post">
    <input name="actionName" type="hidden" value="changepwd" />
	<input name="sessionId" type="hidden" value=<?php echo $_SESSION["session_id"]; ?> />
	<input name="idOfficer" type="hidden" value=<?php echo $_COOKIE['cookieIdOfficer']; ?> />
    <div class="form-group">
      <label for="pwd">Your Current Password:</label>
      <input type="password" class="form-control" id="curpwd" placeholder="Current password" name="curpwd" required autofocus>
      <div class="invalid-feedback">
        Please input your current password.
      </div>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="form-group">
      <label for="pwd">New Password:</label>
      <input type="password" class="form-control" id="newpwd" placeholder="New password" name="newpwd" required>
      <div class="invalid-feedback">
        Please input new password.
      </div>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="form-group">
      <label for="pwd">Confirm New Password:</label>
      <input type="password" class="form-control" id="connewpwd" placeholder="Confirm New password" name="connewpwd" required>
      <div class="invalid-feedback">
        Please input confirm new password.
      </div>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <button id="btnSubmit" type="button" class="btn btn-primary" onclick="doSubmit()">Submit</button>
	<button id="btnCancel" type="button" class="btn btn-primary" onclick="doCancel()">Cancel</button>
  </form>
  <div class="the-return2" align="center"></div>
  
</div>

<script type="text/javascript">

var input = document.getElementById("connewpwd");
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

function doSubmit(){
	$(".the-return2").html(
		"Please wait..."
	)
	
	var data = $('.needs-validation').serialize();
	$.ajax({
		type: 'POST',
		dataType: "json",
		url: "../controller/action.php",
		data: data,
		success: function(data) {
			if(data["outErrCode"]==null){
				location.href='../view/main.php';
			}else{		
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

function doCancel(){
	$(".the-return2").html(
		"Please wait..."
	)
    jQuery.ajax({
        type: "POST",
        url: "../controller/action.php",
        data: {actionName: 'destroyCookies', cookie_name: 'cookieChangePwd', cookie_value: ''}, 
		success:function(data) {
			null;
		}
    });
    jQuery.ajax({
        type: "POST",
        url: "../controller/action.php",
        data: {actionName: 'destroyCookies', cookie_name: 'cookieIdOfficer', cookie_value: ''}, 
		success:function(data) {
			location.href='../view/login.php';
		}
    });
	
}
</script>

</body>
</html>