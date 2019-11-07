<?php
include 'database.php';

include 'connect.php';

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
else
{
    $account_id = $id;
}

?>
<div class="wall">
    <?php
        $posts = $db->query('SELECT * FROM posts order by date desc')->fetchAll();

        $should_check_for_friends = true;
        include_once "posts.php";
    ?>
</div>