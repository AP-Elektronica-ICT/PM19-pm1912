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



$accounts = $db->query('SELECT * FROM accounts WHERE id=' . $account_id)->fetchAll();

foreach ($accounts as $account) {
    $account_content = $account;
}
?>
<?php
class profile 
{
    public $id;
    
    public $dbhosta = 'eu-sql.pebblehost.com';
    public $dbusera = 'customer_93889';
    public $dbpassa = '64a2b900dd';
    public $dbnamea = 'customer_93889';


	public $db;

    
    function __construct($userid)
    {
        $this->id = $userid;
        
        $this->db = new PDO('mysql:host='. $this->dbhosta.';dbname='. $this->dbnamea . ';charset=utf8', $this->dbusera, $this->dbpassa);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
    }
    
    public function getPosts()
    {   
		
        	return true;
    }
    public function getInfo()
    {   
		$sql = "INSERT INTO accounts (first_name, last_name, username, email, number, city, address, zip, tel, password ) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$stmtinsert = $this->db->prepare($sql);
		$result = $stmtinsert->execute([$this->first, $this->last,$this->user, $this->email,$this->number,$this->city,$this->address,$this->zip, $this->tel, $this->pass]);
        if($result)
        {
        	return true;
        }
        return false;
    }
}
?>

<?php

if(isset($_POST['but_upload']))
{
    $post_text = $_POST['post-input'];

    $name = $_FILES['file']['name'];
    if ($name == "" && $post_text != "")
    {
        $db->query("insert into posts(user_id, text) values(".$account_content['id'].',"'.$post_text.'")');
    }
    else if ($name != "")
    {
        $target_dir = "img/upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
    
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
        
            // Insert record
            $db->query("insert into images(ImageFileName, ImageOwner) values('".$name."', ".$account_content['id'].")");
    
            $last_querys = $db->query('SELECT * FROM images ORDER BY ImageID DESC LIMIT 1')->fetchAll();
            foreach ($last_querys as $last_query) {
                $last = $last_query;
            }
    
            $db->query("insert into posts(user_id, text, postImageID) values(".$account_content['id'].',"'.$post_text.'",'.$last['ImageId'].")");
            
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    
        }
    }
    else {
        $message = "No input!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}


?>
<!-- Profile -->
<div class="profile">
    <!-- Profile info -->
    <?php 
        if(isset($_POST['button_remove_friend']))
        {
            $db->query("DELETE FROM friends WHERE id=" . $_POST['friendship_id']);
        }
        if(isset($_POST['button_send_friend_request']))
        {
            $db->query("INSERT INTO friends(id_first, id_second, id_first_confirmed, id_second_confirmed) values('". $id ."','". $account_id . "', 1 , 0)");
        }
        if(isset($_POST['button_accept_friend_request']))
        {
            if ($_POST['account_to_accept'] == "first")
            {
                $db->query("UPDATE friends SET id_first_confirmed=".'1'." WHERE id=". $_POST['friendship_id']);
            }
            else if ($_POST['account_to_accept'] == "second")
            {
                $db->query("UPDATE friends SET id_second_confirmed=".'1'." WHERE id=". $_POST['friendship_id']);
            }
        }
        
        // Check if the account belongs to the loggid in user
        if ($account_content['id'] == $id)
        {
            $new_post = "
            <div class='card'>
                <div class='card-body'>
                    <form method='post' action='' enctype='multipart/form-data' method='post'>
                        <div class='form-group'>
                            <label for='exampleFormControlTextarea1'>New post:</label>
                            <textarea type='text' name='post-input' id='post-input' class='form-control' id='exampleFormControlTextarea1' rows='3'></textarea>
                        </div>
                        <div class='form-group'>
                            <input type='file' name='file' class='form-control-file' id='exampleFormControlFile1'>
                        </div>
                        <input class='btn btn-outline-primary btn-sm' type='submit' value='Post' name='but_upload'>
                    </form>
                </div>
            </div>";
        } 
        else {
            $new_post = "";
        }



        // Create friendlist
        $found_friends = false;
        $friend_list = "";

        $friends_found_matches = $db->query('SELECT * FROM friends WHERE (id_first=' . $account_id . ' AND id_first_confirmed=1 AND id_second_confirmed=1) OR (id_second=' . $account_id . ' AND id_first_confirmed=1 AND id_second_confirmed=1)')->fetchAll();
        foreach ($friends_found_matches as $friends_found_match) {
            $found_friends = true;
            
            $friends_list_friend = $friends_found_match;

            if ($friends_list_friend['id_first'] == $account_id)
            {
                // parse the url
                $pathInfo = parse_url($_SERVER['REQUEST_URI']);
                $queryString = $pathInfo['query'];
                // convert the query parameters to an array
                parse_str($queryString, $queryArray);
                // add the new query parameter into the array
                $queryArray['account_id'] = $friends_list_friend['id_second'];
                // build the new query string
                $newQueryStr = http_build_query($queryArray);

                $friend_names_querys = $db->query('SELECT * FROM accounts WHERE id=' . $friends_list_friend['id_second'])->fetchAll();
                foreach ($friend_names_querys as $friend_names_query) {
                    $friend_name = $friend_names_query;
                    $friend_list .= "<p><a href='".$pathInfo['host'].'?'.$newQueryStr."'> " . $friend_name['first_name'] . " " . $friend_name['last_name'] . "</a><p>";
                }
            }
            else if ($friends_list_friend['id_second'] == $account_id)
            {
                // parse the url
                $pathInfo = parse_url($_SERVER['REQUEST_URI']);
                $queryString = $pathInfo['query'];
                // convert the query parameters to an array
                parse_str($queryString, $queryArray);
                // add the new query parameter into the array
                $queryArray['account_id'] = $friends_list_friend['id_first'];
                // build the new query string
                $newQueryStr = http_build_query($queryArray);

                $friend_names_querys = $db->query('SELECT * FROM accounts WHERE id=' . $friends_list_friend['id_first'])->fetchAll();
                foreach ($friend_names_querys as $friend_names_query) {
                    $friend_name = $friend_names_query;
                    $friend_list .= "<p><a href='".$pathInfo['host'].'?'.$newQueryStr."'> " . $friend_name['first_name'] . " " . $friend_name['last_name'] . "</a><p>";
                }
            }
            
        }
        if ($found_friends == false)
        {
            $friend_list = "No friends";
        }


        $profile = "
            <div class='profile-info'>
                <div class='card' style='width: 18rem;'>
                    <img src='img/dummy/profile-image.png' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $account_content['first_name'] . " " . $account_content['last_name'] . "
                            <h6>" . $account_content['user_name'] . "</h6>
                        </h5>
                            <small>" . $account_content['username'] . "</small>
                        </p>
                    </div>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>Naam: " . $account_content['last_name'] . "</li>
                        <li class='list-group-item'>Voornaam: " . $account_content['first_name'] . "</li>
                        <li class='list-group-item'>Telefoonnummer: " . $account_content['tel'] . "</li>
                    </ul>
                </div>
                
                <div class='card' style='width: 18rem;'>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>Friends</li>
                        <li class='list-group-item'>
                            " . $friend_list . "
                        </li>
                    </ul>
                </div>
            </div>";
        echo $profile;
    ?>
    <!-- Friends Section -->
    <?php
        $friend_section = "
            <p>You aren't friends with <b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b>.</p>
            <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                    <input class='btn btn-outline-primary btn-sm' type='submit' value='Send a friend request' name='button_send_friend_request'>
                </div>
            </div>
        ";
        $friends_matches = $db->query('SELECT * FROM friends WHERE (id_first=' . $account_id . ' AND id_second=' . $id . ' ) OR (id_first=' . $id . ' AND id_second=' . $account_id . ' )')->fetchAll();
        foreach ($friends_matches as $friends_match) {
            
            $friendship = $friends_match;
            if ($friendship['id_first'] == $id && $friendship['id_second'] == $account_id)
            {
                if ($friendship['id_first_confirmed'] == 1 && $friendship['id_second_confirmed'] == 1)
                {
                    // Friends
                    $friend_section = "
                        <p>You are friends with <b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b>.</p>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                <input class='btn btn-success btn-sm' value='You are friends'>
                            </div>
                            <div class='btn-group mr-2' role='group' aria-label='second group'>
                                <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                                <input class='btn btn-danger btn-sm' type='submit' value='Unfriend' name='button_remove_friend'>
                            </div>
                        </div>
                    ";
                }
                else if ($friendship['id_first_confirmed'] == 1)
                {
                    // Request sent
                    $friend_section = "
                        <p>You have send a friend request to <b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b>.</p>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                <input class='btn btn-warning btn-sm' value='Waiting for response...'>
                            </div>
                            <div class='btn-group mr-2' role='group' aria-label='second group'>
                                <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                                <input class='btn btn-danger btn-sm' type='submit' value='Cancel' name='button_remove_friend'>
                            </div>
                        </div>
                    ";
                }
                else if ($friendship['id_second_confirmed'] == 1)
                {
                    // Accept request
                    $friend_section = "
                        <p><b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b> has send you a friend request.</p>
                        <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                <input hidden='true' type='text' name='account_to_accept' id='account_to_accept' class='form-control' value='first'>
                                <input class='btn btn-success btn-sm' type='submit' value='Accept' name='button_accept_friend_request'>
                            </div>
                            <div class='btn-group mr-2' role='group' aria-label='second group'>
                                <input class='btn btn-danger btn-sm' type='submit' value='Deny' name='button_remove_friend'>
                            </div>
                        </div>
                    ";
                }
            }
            else if ($friendship['id_first'] == $account_id && $friendship['id_second'] == $id)
            {
                if ($friendship['id_first_confirmed'] == 1 && $friendship['id_second_confirmed'] == 1)
                {
                    // Friends
                    $friend_section = "
                        <p>You are friends with <b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b>.</p>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                <input class='btn btn-success btn-sm' value='You are friends'>
                            </div>
                            <div class='btn-group mr-2' role='group' aria-label='second group'>
                                <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                                <input class='btn btn-danger btn-sm' type='submit' value='Unfriend' name='button_remove_friend'>
                            </div>
                        </div>
                    ";
                }
                else if ($friendship['id_second_confirmed'] == 1)
                {
                    // Request sent
                    $friend_section = "
                        <p>You have send a friend request to <b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b>.</p>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                <input class='btn btn-warning btn-sm' value='Waiting for response...'>
                            </div>
                            <div class='btn-group mr-2' role='group' aria-label='second group'>
                                <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                                <input class='btn btn-danger btn-sm' type='submit' value='Cancel' name='button_remove_friend'>
                            </div>
                        </div>
                    ";
                }
                else if ($friendship['id_first_confirmed'] == 1)
                {
                    // Accept request
                    $friend_section = "
                        <p><b>" . $account_content['first_name'] . " " . $account_content['last_name'] . "</b> has send you a friend request.</p>
                        <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                <input hidden='true' type='text' name='account_to_accept' id='account_to_accept' class='form-control' value='second'>
                                <input class='btn btn-success btn-sm' type='submit' value='Accept' name='button_accept_friend_request'>
                            </div>
                            <div class='btn-group mr-2' role='group' aria-label='second group'>
                                <input class='btn btn-danger btn-sm' type='submit' value='Deny' name='button_remove_friend'>
                            </div>
                        </div>
                    ";
                }
            }
        }
        

        $friend_section_card =  "
        <div class='card'>
            <div class='card-body'>
                <form method='post' action='' enctype='multipart/form-data' method='post'>
                    " . $friend_section . "
                </form>
            </div>
        </div>";
    ?>

    <!-- Posts -->
    <div class="profile-wall">
        <?php
            if ($account_content['id'] != $id)
            {
                echo $friend_section_card;
            }
            // Check if there are friend requests
            else if ($account_content['id'] == $id)
            {
                $found_request = false;

                $friends_request_matches = $db->query('SELECT * FROM friends WHERE (id_first=' . $id . ' AND id_first_confirmed=0) OR (id_second=' . $id . ' AND id_second_confirmed=0)')->fetchAll();
                foreach ($friends_request_matches as $friends_request_match) {
                    $found_request = true;

                    $friendship = $friends_request_match;

                    
                    if ($friendship['id_first_confirmed'] == 1 && $friendship['id_second_confirmed'] == 0)
                    {
                        
                        $friendrequest_names = $db->query('SELECT * FROM accounts WHERE id=' . $friendship['id_first'])->fetchAll();
                        foreach ($friendrequest_names as $friendrequest_name) {
                            $friend_request = $friendrequest_name;
                        }

                        // parse the url
                        $pathInfo = parse_url($_SERVER['REQUEST_URI']);
                        $queryString = $pathInfo['query'];
                        // convert the query parameters to an array
                        parse_str($queryString, $queryArray);
                        // add the new query parameter into the array
                        $queryArray['account_id'] = $friend_request['id'];
                        // build the new query string
                        $newQueryStr = http_build_query($queryArray);
                        $friend_check_section .= "
                            <div>
                                <form method='post' action='' enctype='multipart/form-data' method='post'>
                                <p><b><a href='".$pathInfo['host'].'?'.$newQueryStr."'>"  . $friend_request['first_name'] . " " . $friend_request['last_name'] . "</a></b> has send you a friend request.</p>
                                    <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                                    <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                                        <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                            <input hidden='true' type='text' name='account_to_accept' id='account_to_accept' class='form-control' value='second'>
                                            <input class='btn btn-success btn-sm' type='submit' value='Accept' name='button_accept_friend_request'>
                                        </div>
                                        <div class='btn-group mr-2' role='group' aria-label='second group'>
                                            <input class='btn btn-danger btn-sm' type='submit' value='Deny' name='button_remove_friend'>
                                        </div>
                                    </div>
                                </form>
                            </div>";
                    }
                    else if ($friendship['id_first_confirmed'] == 0 && $friendship['id_second_confirmed'] == 1)
                    {

                        $friendrequest_names = $db->query('SELECT * FROM accounts WHERE id=' . $friendship['id_first'])->fetchAll();
                        foreach ($friendrequest_names as $friendrequest_name) {
                            $friend_request = $friendrequest_name;
                        }
                        // parse the url
                        $pathInfo = parse_url($_SERVER['REQUEST_URI']);
                        $queryString = $pathInfo['query'];
                        // convert the query parameters to an array
                        parse_str($queryString, $queryArray);
                        // add the new query parameter into the array
                        $queryArray['account_id'] = $friend_request['id'];
                        // build the new query string
                        $newQueryStr = http_build_query($queryArray);
                        $friend_check_section .= "
                            <div>
                                <form method='post' action='' enctype='multipart/form-data' method='post'>
                                    <p><b><a href='".$pathInfo['host'].'?'.$newQueryStr."'>"  . $friend_request['first_name'] . " " . $friend_request['last_name'] . "</a></b> has send you a friend request.</p>
                                    <input hidden='true' type='text' name='friendship_id' id='friendship_id' class='form-control' value='". $friendship['id'] ."'>
                                    <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                                        <div class='btn-group mr-2' role='group' aria-label='Primary group'>
                                            <input hidden='true' type='text' name='account_to_accept' id='account_to_accept' class='form-control' value='first'>
                                            <input class='btn btn-success btn-sm' type='submit' value='Accept' name='button_accept_friend_request'>
                                        </div>
                                        <div class='btn-group mr-2' role='group' aria-label='second group'>
                                            <input class='btn btn-danger btn-sm' type='submit' value='Deny' name='button_remove_friend'>
                                        </div>
                                    </div>
                                </form>
                            </div>";
                    
                    }
                }

                if ($found_request == false)
                {
                    $friend_check_section = "<p>You have no new friend requests.</p>";
                }
                echo "
                    <div class='card'>
                        <div class='card-body'>
                        " . $friend_check_section . "
                        </div>
                    </div>
                ";
            }

            echo $new_post;

            
            
            $posts = $db->query('SELECT * FROM posts WHERE user_id=' . $account_id . ' order by date desc')->fetchAll();
            $should_check_for_friends = false;
            include_once "posts.php";
        ?>
    </div>
</div>