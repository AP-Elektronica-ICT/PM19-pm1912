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

<div>This site is not GDPR compliant as of now. Do not put any personal information at this moment.</div>
<div>
	<form action="process.php" method="post">
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
					<input class="btn btn-primary" input type="submit" id="register" value="Sign Up">
					<a href="login.php"> Back to login page</a>
				</div>
			</div>
		</div>
	</form>
</div>
</body>
</html>