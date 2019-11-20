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

if(isset($POST['edit'])) {
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
	$sql = "UPDATE accounts SET ";
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

if(isset($_POST['but_upload'])) {
		$target_dir = "img/upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
    
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
        
            // Insert record
        $db->query("insert into images(ImageFileName, ImageOwner) values('".$name."', ".$sessionid.")");
		$last_querys = $db->query('SELECT * FROM images ORDER BY ImageID DESC LIMIT 1')->fetchAll();
            foreach ($last_querys as $last_query) {
                $last = $last_query;
            }
		$db->query("insert into profielfoto(userID, imageID) values(".$sessionid.', "'.$last['ImageId'].")");

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
					<form method="post" action="" enctype='multipart/form-data'>
						<input type='file' name='file' />
						<input type='submit' value='Save name' name='but_upload'>
						</form>
					<input class='btn btn-outline-primary btn-sm' type='submit' value='Post' name='but_upload'>
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
