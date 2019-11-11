<?php
include 'database.php';

include 'connect.php';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

session_start();

$sessionid;
if (isset ($_SESSION['id'])) {
    $sessionid = $_SESSION['id'];
}
?>
<?php
if(isset($POST)) {
	$updated = array();
	$toupdate = array("firstname","lastname","username","email","number","city","address","zip","tel","password");
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
    $username       = $_POST['username'];
	$email 			= $_POST['email'];
    $number         = $_POST['number'];
    $city           = $_POST['city'];
    $address        = $_POST['address'];
    $zip            = $_POST['zip'];
	$tel         	= $_POST['tel'];
	$password 		= $_POST['password'];
	array_push($firstname, $lastname, $username, $email, $number, $city, $address, $zip, $tel, $password);
	$var_count(count($toupdate));
	$sql = "INSERT INTO accounts SET ";
	$temp = false;
	for ($i = 0; $i<$var_count; $i++)
        {
		if ($temp == true) 
			{$sql .= ", ";}
		if ($updated[$i]!="" && $updated[$i]!=null )
            {
			$sql .= "{$toupdate[$i]}={$updated[$i]} ";
			}
	    $sql .= "WHERE {$id}={$sessionid}";
	    }
	$db->query($sql);
    }


if (isset ($_SESSION['id'])) {
$sessionid=$_SESSION['id'];
$deletemessage="
<div>
	<form action='registration.php' method='post'>
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
</div>";
}
else {
	$deletemessage="<div>You must create an account or log in in order to edit your account.</div>";
}


?>
<div>
	<?php echo $deletemessage; ?>
</div>
