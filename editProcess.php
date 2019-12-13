<?php
require_once('config.php');
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
<?php
if(isset($_POST['edit'])) {
	$updated = array();
	$toupdate = array("first_name","last_name","username","email","number","city","address","zip","tel","password");
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
    $username       = $_POST['username'];
	$email 			= $_POST['email'];
    $number         = $_POST['number'];
    $city           = $_POST['city'];
    $address        = $_POST['address'];
    $zip            = $_POST['zip'];
	$tel         	= $_POST['tel'];
	$password 		= sha1($_POST['password']);
	array_push($updated, $firstname, $lastname, $username, $email, $number, $city, $address, $zip, $tel, $password);
	$sql = "UPDATE accounts SET ";
	$temp = false;
	for ($i = 0; $i<9; $i++)
        {
		if ($updated[$i]!="" && $updated[$i]!=null && $updated[$i]!=" ")
            {
			if ($temp == true) 
			{$sql .= ", ";}
			$sql .= "$toupdate[$i]='$updated[$i]'";
			$temp = true;
			}
	    }
	$sql .= " WHERE id=$id";
	if ($db->query($sql) == TRUE) {
		echo "Record updated successfully";
		header('Location: index.php?page=editAccount');
	} else {
		echo "Error updating record: " . mysqli_error($db);
		header('Location: index.php?page=editAccount');
	}
	
}
	//header('Location: index.php?page=editAccount');

/* Nog even bijhouden in case bugfix niet werkt.

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
	$semaphore = false;
	$query = "UPDATE accounts SET ";
	$fields = array('firstname','lastname','username','email','number','city','address','zip','tel','password')
	foreach ($fields as $field) {
	if (isset($_POST[$field]) and !empty($_POST[$field]) {
		$var = mysql_real_escape_string($_POST[$field]);
		$query .= uppercase($field) . " = '$var'";
		$semaphore = true;
		}
	}
	if ($semaphore) {
   $query .= "WHERE 'id'={$sessionid}";
   mysql_query($query);
	}
	*/
?>