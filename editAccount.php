<?php
include 'database.php';

include 'connect.php';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);
session_start();
$id;
if (isset ($_SESSION['id'])) {
    $id = $_SESSION['id'];
}

$account_id;
if (isset($_GET["account_id"])) {
    $account_id = $_GET["account_id"];
}
else 
{
    $account_id = $id;
}
?>
<div>
	<div>Update profile-picture<div>
	<form action = "updateProfPic.php" method = 'post' enctype='multipart/form-data'>
						<input type='file' name='file' />
						<input type='submit' value='Save name' name='but_upload'>
	</form>
	<div>This site is not GDPR compliant as of now. Do not put any personal information at this moment.</div>
	<form action='editProcess.php' method='post'>
		<div class='container'>
			<div class='row'>
				<div class='col-sm-3'>
					<h1>Edit account</h1>
					<hr class='mb-3'>
					<label for='firstname'><b>First Name</b></label>
					<input class='form-control' id='firstname' type='text' name='firstname'>

					<label for='lastname'><b>Last Name</b></label>
					<input class='form-control' id='lastname'  type='text' name='lastname'>
                                    
				    <label for='username'><b>Username</b></label>
					<input class='form-control' id='username'  type='text' name='username'>

					<label for='email'><b>Email Address</b></label>
					<input class='form-control' id='email'  type='email' name='email'>
					
				    <label for='number'><b>House number</b></label>
					<input class='form-control' id='number'  type='text' name='number'>
					
				    <label for='address'><b>Street address</b></label>
					<input class='form-control' id='address'  type='text' name='address'>
					
				    <label for='city'><b>City</b></label>
					<input class='form-control' id='city'  type='text' name='city'>
					
				    <label for='zip'><b>Zip code</b></label>
					<input class='form-control' id='zip'  type='text' name='zip'>

					<label for='tel'><b>Phone Number</b></label>
					<input class='form-control' id='tel'  type='text' name='tel'>

					<label for='password'><b>Password</b></label>
					<input class='form-control' id='password'  type='password' name='password'>
					
					<hr class='mb-3'>
					<input class='btn btn-primary' type='submit' id='edit' name='edit' value='Post'>
				</div>
			</div>
		</div>
	</form>
</div>