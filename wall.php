<?php
include 'database.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';
$dbname = 'facebooklite';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

/*
$accounts = $db->query('SELECT * FROM accounts')->fetchAll();

foreach ($accounts as $account) {
	echo $account['name'] . '<br>';
}
*/
?>