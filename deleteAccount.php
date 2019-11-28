<?php
include 'database.php';

include 'connect.php';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

session_start();


if (isset ($_SESSION['id'])) {
$sessionid = $_SESSION['id'];

	if(isset($_POST['delete_account']))
	{
		$db->query("DELETE FROM accounts WHERE id=" . $sessionid);
		session_destroy();
	}

	$deletemessage="<div>
			<div> Are you sure you want to delete your account? </div>
				<form method='post' action='' enctype='multipart/form-data' method='post'>
					<input class='btn btn-danger btn-sm' type='submit' value='Delete account' name='delete_account'>
				</form>
				<form method='get' action='' enctype='multipart/form-data' method='get'>
					<button class='btn btn-outline-primary btn-sm' type='submit' value='profile' name='page'>Cancel</button>
				</form>
			</div>";
}
else {
	$deletemessage="<div>You must create an account or log in in order to delete your account.</div>";
}
?>
<div>
	<?php echo $deletemessage; ?>
</div>
