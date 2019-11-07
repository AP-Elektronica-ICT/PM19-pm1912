<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Registration | PHP</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>


<div>
	<form action="registration.php" method="post">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-3">
					<h1>Registration</h1>
					<p>Fill up the form with correct values.</p>
					<hr class="mb-3">
					<label for="firstname"><b>First Name</b></label>
					<input class="form-control" id="firstname" type="text" name="firstname" required>

					<label for="lastname"><b>Last Name</b></label>
					<input class="form-control" id="lastname"  type="text" name="lastname" required>
                                    
				    <label for="username"><b>Username</b></label>
					<input class="form-control" id="username"  type="text" name="username" required>

					<label for="email"><b>Email Address</b></label>
					<input class="form-control" id="email"  type="email" name="email" required>
					
				    <label for="number"><b>House number</b></label>
					<input class="form-control" id="number"  type="text" name="number" required>
					
				    <label for="address"><b>Street address</b></label>
					<input class="form-control" id="address"  type="text" name="address" required>
					
				    <label for="city"><b>City</b></label>
					<input class="form-control" id="city"  type="text" name="city" required>
					
				    <label for="zip"><b>Zip code</b></label>
					<input class="form-control" id="zip"  type="text" name="zip" required>
					

					<label for="tel"><b>Phone Number</b></label>
					<input class="form-control" id="tel"  type="text" name="tel" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control" id="password"  type="password" name="password" required>
					
					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
					<a href="login.php"> Back to login page</a>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var firstname 	= $('#firstname').val();
			var lastname	= $('#lastname').val();
            var username    = $('#username').val();
			var email 		= $('#email').val();
            var number      = $('#number').val();
            var city        = $('#city').val(); 
            var address     = $('#address').val(); 
            var zip         = $('#zip').val(); 
			var tel         = $('#tel').val();
			var password 	= $('#password').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {firstname: firstname,lastname: lastname,username: username,email: email,number: number,city: city,address: address,zip: zip,tel: tel,password: password},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
	
</script>
</body>
</html>