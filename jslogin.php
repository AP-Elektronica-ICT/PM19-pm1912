<?php
session_start();
require_once('config.php');

$username = $_POST['username'];
$password = sha1($_POST['password']);

$sql = "SELECT * FROM accounts WHERE username = ? AND password = ? LIMIT 1";
$stmtselect  = $db->prepare($sql);
$result = $stmtselect->execute([$username, $password]);

while($row = $stmtselect->fetch()) {
    $user = $row["username"];
    $pass = $row["password"];
    $id = $row["id"];
}

if($result){
	if($stmtselect->rowCount() > 0){
        $_SESSION['userlogin'] = $result;
		$_SESSION['id'] = $id;
	}else{
		echo 'There no user for that combo';		
	}
}else{
	echo 'There were errors while connecting to database.';
}