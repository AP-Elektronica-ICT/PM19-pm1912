<?php
// phpMyAdmin: https://remotemysql.com/phpmyadmin/sql.php
include 'database.php';

$dbhost = 'remotemysql.com';
$dbuser = 'Q6EhZWemZR';
$dbpass = 'iEkb5TgEqO';
$dbname = 'Q6EhZWemZR';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);

// Needs to be changed to SESSION
$id;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$account_id;
if (isset($_GET["account_id"])) {
    $account_id = $_GET["account_id"];
}

// http://localhost:8888/PM19-pm1912/?page=wall&id=1&account_id=1
?>
<div class="wall">
    <?php
        $posts = $db->query('SELECT * FROM posts order by date desc')->fetchAll();

        $should_check_for_friends = true;
        include_once "posts.php";
    ?>
</div>