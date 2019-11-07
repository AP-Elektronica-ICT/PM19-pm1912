<?php
require_once('config.php');
?>
<?php

if(isset($_POST)){

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

		$sql = "INSERT INTO accounts (first_name, last_name, username, email, number, city, address, zip, tel, password ) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$firstname, $lastname,$username, $email,$number,$city,$address,$zip, $tel, $password]);
		if($result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
}else{
	echo 'No data';
}