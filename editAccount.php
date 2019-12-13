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
<?php
if(isset($_POST['edit'])) {
	$updated = array();
	$toupdate = array("first_name","last_name","username","email","number","city","address","zip","tel");
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
    $username       = $_POST['username'];
	$email 			= $_POST['email'];
    $number         = $_POST['number'];
    $city           = $_POST['city'];
    $address        = $_POST['address'];
    $zip            = $_POST['zip'];
	$tel         	= $_POST['tel'];
	array_push($updated, $firstname, $lastname, $username, $email, $number, $city, $address, $zip, $tel);
	$sql = "UPDATE accounts SET ";
	$temp = false;
	for ($i = 0; $i<8; $i++)
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

if(isset($_POST['but_upload'])) {
		$name = $_FILES['file']['name'];
		$target_dir = "img/upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
    
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
        
            // Insert record
        $db->query("insert into images(ImageFileName, ImageOwner) values('".$name."', ".$id.")");
		$last_querys = $db->query('SELECT * FROM images ORDER BY ImageID DESC LIMIT 1')->fetchAll();
            foreach ($last_querys as $last_query) {
                $last = $last_query;
            }
			// Upload file
		move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

		$db->query("insert into profielfoto(userID, imageID) values(".$id.", ".$last['ImageId'].")");
		echo "<script>window.location = 'index.php?account_id=".$_SESSION['id']."&page=profile'</script>";

}
}
?>
<div>
	<div>Update profile-picture<div>
	<form method = 'post' enctype='multipart/form-data'>
						<input type='file' name='file' />
						<input type='submit' value='Save name' name='but_upload'>
	</form>
	<div>This site is not GDPR compliant as of now. Do not put any personal information at this moment.</div>
	<form method='post'>
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
					
					<hr class='mb-3'>
					<input class='btn btn-primary' type='submit' id='edit' name='edit' value='Post'>
				</div>
			</div>
		</div>
	</form>
</div>