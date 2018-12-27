<!DOCTYPE html>
<html lang="en">
<title>Nama App</title>
<link rel="icon" href="../imi.ico">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
<?PHP 
include "../controller/createsession.php";
include "../controller/myfunction.php";

if(!isset($_COOKIE['cookieIdOfficer'])) {
    echo "<script>location.href='../view/login.php';</script>";
}else{
	if(isset($_COOKIE['cookieChangePwd']) && $_COOKIE['cookieChangePwd']=='T') {
		echo "<script>location.href='forcechangepswd.php';</script>";
	}
}

if(isset($_GET['page'])) {
	$getPage = $_GET['page'];
}else{
	$getPage = null;
}
?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="#">Nama App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="<?php setMenuStyle('call', $getPage); ?>">
              <a class="nav-link" href="main.php?page=call">Call
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="<?php setMenuStyle('recall', $getPage); ?>">
              <a class="nav-link" href="main.php?page=recall">Recall</a>
            </li>
            <li class="<?php setMenuStyle('personalization', $getPage); ?>">
              <a class="nav-link" href="main.php?page=personalization">Personalization</a>
            </li>
            <li class="<?php setMenuStyle('signout', $getPage); ?>">
              <a class="nav-link" href="#" onclick="destroyCookies()">Sign out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
	<?php
		setContentPage($getPage);
	?>

    <!-- Bootstrap core JavaScript -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
function destroyCookies() {
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