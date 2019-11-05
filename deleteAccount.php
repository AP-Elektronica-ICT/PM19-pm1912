<?php
// phpMyAdmin: https://remotemysql.com/phpmyadmin/sql.php
include 'database.php';

$dbhost = 'remotemysql.com';
$dbuser = 'Q6EhZWemZR';
$dbpass = 'iEkb5TgEqO';
$dbname = 'Q6EhZWemZR';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

session_start();

if (isset ($_SESSION[sessionid])) {
$sessionid=$_SESSION['sessionid'];
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
