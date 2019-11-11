<?php
include 'database.php';

include 'connect.php';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

session_start();

if (isset ($_SESSION['id'])) {
$sessionid = $_SESSION['id'];

$deletemessage="<div>
		<div> Are you sure you want to delete your account? </div>
		<button class='btn btn-outline-praimary btn-sm' onclick='delete_account()'>Delete account</button>
		</div>";
}
else {
	$deletemessage="<div>You must create an account or log in in order to delete your account.</div>";
}
?>
<div>
	<?php echo $deletemessage; ?>
</div>

<script>
	function delete_account() {
	var confirmation;
	if (confirm("Are you sure you want to delete your account?"))
		{
		confirmation = "yes";
		<?php
		$db->query("DELETE FROM accounts WHERE id='.$sessionid.'")
		?>
		} 
	else {};
</script>
