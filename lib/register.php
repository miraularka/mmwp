<?php

/*
	Registration Page for Mirau's Modular Website Platform
	Notice the use of /etc/settings.php
*/
include '../lib/header.php';
include '../etc/settings.php';


/*
	To do: add GET(url) and POST checks to determine the state of the registration.
	Order should be -> SESSION check to see if logged in, to give notice that user is already registered
					-> POST-hashedpassword, uid, two for final activation which includes querying the password into the database
					-> POST-hashedpassword, uid, one for verification page that requires confirmation input of password
					-> GET- username, uid, auth token for initial registration page to insert first password
*/
?>
	
    
	
		<div class="jumbotron">
				<h3>Grayles Gaming Account Registration</h3>
        		<p class="lead">You are about to register the username TEST as an official Grayles Gaming Account. With this account you will have access to all of the features of the website and games servers that we maintain. This account is loosely based on Discord Account that you used to request registration and will be used as your primary login for all Grayles Gaming Servers that requires an active account. Although Grayles Gaming will never disclose your account information to any third parties, we highly suggest you use a unique password for your Grayles Gaming Account for increased personal security.</p>
				<hr>
				<form action="register.php" class="needs-validation" method="post" novalidate>
					<div class="form-group">
						<label for="inputPass1">Username</label>
						<input type="text" class="form-control mb-2" value="TEST" readonly>
					</div>
					<div class="form-group">
						<label for="inputPass1">Password</label>
						<input type="password" class="form-control" id="inputPass1" placeholder="Password" required>
							<div class="invalid-feedback">Please enter your password to continue.</div>
					</div>
					<div class="form-group">
						<label for="inputPass2">Confirm</label>
						<input type="password" class="form-control" id="inputPass2" placeholder="Password" required>
						<div class="invalid-feedback">Please confirm your password to continue.</div>
					</div>
					<button type="submit" class="btn btn-primary">Register</button>
					<hr>
					<small class="form-text text-muted">
					By choosing to submit this registration form you agree to our Terms of Service.
					</small>
				</form>
			<script>
				// Self-executing function
				(function() {
					'use strict';
					window.addEventListener('load', function() {
						// Fetch all the forms we want to apply custom Bootstrap validation styles to
						var forms = document.getElementsByClassName('needs-validation');
						// Loop over them and prevent submission
						var validation = Array.prototype.filter.call(forms, function(form) {
							form.addEventListener('submit', function(event) {
								//This checks that all required fields are populated
								if (form.checkValidity() === false) {
									event.preventDefault();
									event.stopPropagation();
								}
								form.classList.add('was-validated');
							}, false);
						});
					}, false);
				})();
			</script>
		</div>	
<?php
require '../lib/footer.php';
?>
