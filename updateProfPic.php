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
		$db->query("insert into profielfoto(userID, imageID) values(".$id.", ".$last['ImageId'].")");
		echo "<script>window.location = 'index.php?account_id=".$_SESSION['id']."&page=profile'</script>";

}
}
?>
