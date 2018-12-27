<div class="container">
</br>
<form class="needs-validation" novalidate method="post">
	<div class="row">
		<div class="col">
			<label for="queueGroup">Queue Group:</label>
			<input type="text" class="form-control" id="queueGroup" placeholder="Queue Group" name="queueGroup" disabled value="<?php echo getQueueGroup($_COOKIE['cookieIdOfficer']); ?>" />
		</div>
		<div class="col">
			<label for="currentQueue">Current Queue:</label>
			<input type="number" class="form-control" id="currentQueue" placeholder="Current Queue" name="currentQueue" disabled value="<?php echo getCurrQueue($_COOKIE['cookieIdOfficer']); ?>" />
		</div>
	</div>
	</br>
	<div class="row">
		<div class="col">
			<button id="btnNext" type="button" class="btn btn-primary" onclick="doLogin()">Call Next</button>
		<div>
	<div>
</form>
</div>