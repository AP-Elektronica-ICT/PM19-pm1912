<?php
// phpMyAdmin: https://remotemysql.com/phpmyadmin/sql.php
include 'database.php';

$dbhost = 'remotemysql.com';
$dbuser = 'Q6EhZWemZR';
$dbpass = 'iEkb5TgEqO';
$dbname = 'Q6EhZWemZR';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);


$id;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
// http://localhost:8888/PM19-pm1912/?page=profile&id=1

$accounts = $db->query('SELECT * FROM accounts WHERE id=' . $id)->fetchAll();

foreach ($accounts as $account) {
    $account_content = $account;
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
if(isset($_POST['like']))
{
    $posts_likes_query = $db->query('SELECT * FROM likes WHERE post_id="' . $_POST['post-id'] . '" AND user_id="' . $id . '"');
    $posts_likes = $posts_likes_query->numRows();

    if ($posts_likes == 0)
    {
        $db->query("INSERT INTO likes(user_id, post_id) values('".$id."','".$_POST['post-id']."')");
    }
    else {
        $message = "You have already liked this post!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
if(isset($_POST['delete']))
{
    if ($_POST['postImageID'] != NULL)
    {   
        $posts_likes_query = $db->query('DELETE FROM images WHERE ImageId=' . $_POST['postImageID']);
    }
    $posts_likes_query = $db->query('DELETE FROM likes WHERE post_id=' . $_POST['post-id']);
    $posts_likes_query = $db->query('DELETE FROM comments WHERE post_id=' . $_POST['post-id']);
    $posts_likes_query = $db->query('DELETE FROM posts WHERE id=' . $_POST['post-id']);
}
if(isset($_POST['but_react']))
{
    $comment_text = $_POST['react-input'];

    if ($comment_text != "")
    {
        $db->query("INSERT INTO comments(user_id, post_id, text) values('".$id."','".$_POST['post-id']."','".$comment_text."')");
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
        $profile = "
            <div class='profile-info'>
                <div class='card' style='width: 18rem;'>
                    <img src='img/dummy/profile-image.png' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $account_content['first_name'] . " " . $account_content['last_name'] . "
                            <h6>" . $account_content['user_name'] . "</h6>
                        </h5>
                            <small>" . $account_content['quote'] . "</small>
                        </p>
                    </div>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item'>Naam: " . $account_content['last_name'] . "</li>
                        <li class='list-group-item'>Voornaam: " . $account_content['first_name'] . "</li>
                        <li class='list-group-item'>Telefoonnummer: " . $account_content['tel'] . "</li>
                    </ul>
                    <div class='card-body'>
                        <a href='#' class='card-link'>Edit</a>
                    </div>
                </div>
            </div>";
        echo $profile
    ?>
                
    <!-- Posts -->
    <div class="profile-wall">
        <!-- Posts | New post -->
        <!-- TODO: if session is own profile -->
        <div class="card">
            <div class="card-body">
                <form method="post" action="" enctype='multipart/form-data' method="post">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">New post:</label>
                        <textarea type="text" name="post-input" id="post-input" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name='file' class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <input class="btn btn-outline-primary btn-sm" type='submit' value='Post' name='but_upload'>
                </form>
            </div>
        </div>
        
        <!-- Posts -->
        <?php
            $post_count = 0;
            $posts = $db->query('SELECT * FROM posts WHERE user_id=' . $id . ' order by date desc')->fetchAll();
            foreach ($posts as $post) {
                $post_content = $post;

                $posts_likes_query = $db->query('SELECT * FROM likes WHERE post_id="' . $post_content['id'] . '"');
                $posts_likes = $posts_likes_query->numRows();

                $post_count++;

                $post_posters = $db->query('SELECT * FROM accounts WHERE id=' . $post_content['user_id'])->fetchAll();
                foreach ($post_posters as $post_poster) {
                    $poster = $post_poster;
                    
                }

                $comments = $db->query('SELECT * FROM comments WHERE post_id=' . $post_content['id'])->fetchAll();

                if ($post_content['postImageID'] != NULL)
                {
                    $images = $db->query('SELECT * FROM images WHERE ImageId=' . $post_content['postImageID'])->fetchAll();
                    foreach ($images as $image) {
                        $image_name = $image;
                    }
                }
                // Check if the post belongs to the loggid in user
                if ($post_content['user_id'] == $id)
                {
                    $delete_button = "
                    <div class='btn-group mr-2' role='group' aria-label='First group'>
                        <form method='post' action='' enctype='multipart/form-data' method='post'>
                            <input hidden='true' type='text' name='post-id' id='post-id' class='form-control' value='". $post_content['id'] ."'>
                            <input class='btn btn-outline-danger btn-sm' type='submit' value='Delete' name='delete'>
                        </form>
                    </div>";
                } 
                else {
                    $delete_button = "";
                }
                $post_section_text = "
                <div class='card'>
                    <!-- Posts | Text post (user header) -->
                    <div class='card-header'>
                        <div class='row'>
                            <div class='col-sm-1'>
                                <img class='profile-pic-mini' src='img/dummy/profile-image.png'>
                            </div>
                            <div class='col-sm'>" .
                                    $poster['first_name'] . " " . $poster['last_name']
                                . "<p class='card-text'>
                                    <small>" . $post['date'] . "</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Posts | Text post (post) -->
                    <div class='card-body'>
                        <p class='card-text'>" . $post_content['text'] . "</p>
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            ". $delete_button ."
                            <div class='btn-group mr-2' role='group' aria-label='Second group'>
                                <form method='post' action='' enctype='multipart/form-data' method='post'>
                                    <input hidden='true' type='text' name='post-id' id='post-id' class='form-control' value='". $post_content['id'] ."'>
                                    <input class='btn btn-outline-primary btn-sm' type='submit' value='Like' name='like'>
                                    <small>" . $posts_likes . " Likes</small>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>";
                $post_section_pictrue = "
                <div class='card'>
                    <!-- Posts | Text post (user header) -->
                    <div class='card-header'>
                        <div class='row'>
                            <div class='col-sm-1'>
                                <img class='profile-pic-mini' src='img/dummy/profile-image.png'>
                            </div>
                            <div class='col-sm'>" .
                                    $poster['first_name'] . " " . $poster['last_name']
                                . "<p class='card-text'>
                                    <small>" . $post['date'] . "</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Posts | Text post (post) -->
                    <div class='card-body'>
                        <p class='card-text'>" . $post_content['text'] . "</p>
                        <img class='card-img-top' src='img/upload/" . $image_name['ImageFileName'] ."'>
                        
                        <div class='btn-toolbar' role='toolbar' aria-label='Toolbar with button groups'>
                            ". $delete_button ."
                            <div class='btn-group mr-2' role='group' aria-label='Second group'>
                                <form method='post' action='' enctype='multipart/form-data' method='post'>
                                    <input hidden='true' type='text' name='post-id' id='post-id' class='form-control' value='". $post_content['id'] ."'>
                                    <input class='btn btn-outline-primary btn-sm' type='submit' value='Like' name='like'>
                                    <small>" . $posts_likes . " Likes</small>
                                </form>
                            </div>
                        </div>
                    </div>";
                    

                    $comment_count = 0;
                    foreach ($comments as $comment) {
                        $comment_content = $comment;
                        $comment_count++;
                    }
                        $comment_section = "
                        <!-- Posts | Text post (command section) -->
                        <div class='card-footer'>
                            <div class='form-group'>
                                
                                <p>Comments: <small> (". $comment_count . " comments)</small></p>";
                                
                                
                                $comment_fields = array();
                                foreach ($comments as $comment) {
                                    $comment_content = $comment;
                                    
                                    $comment_posters = $db->query('SELECT * FROM accounts WHERE id=' . $comment_content['user_id'])->fetchAll();
                                    foreach ($comment_posters as $comment_poster) {
                                        $comment_sender = $comment_poster;
                                    }

                                    $post_content['likes'];
                                    array_push($comment_fields, "
                                    <!-- Posts | Text post (command) -->
                                    <div class='card-header'>
                                        <div class='row'>
                                            <div class='col-sm-1'>
                                                <img class='profile-pic-mini-comment' src='img/dummy/profile-image.png'>
                                            </div>
                                            " . $comment_sender['first_name'] . " " . $comment_sender['last_name'] . "
                                        </div>
                                        <div class='card-body'>

                                            <p class='card-text'>" . $comment_content['text'] . "</p>
                                        </div>
                                    </div>");
                                }
                                $comment_new = "<!-- Posts | Text post (new command) -->
                                <label for='exampleFormControlTextarea1'>New comment:</label>

                                <form method='post' action='' enctype='multipart/form-data' method='post'>
                                    <input hidden='true' type='text' name='post-id' id='post-id' class='form-control' value='". $post_content['id'] ."'>

                                    <input  type='text' name='react-input' id='react-input' class='form-control' value=''>
                                    <input class='btn btn-outline-primary btn-sm' type='submit' value='Comment' name='but_react'>
                                </form>
                            </div>
                        </div>";
                    

                if ($post_count > 0)
                {
                    if ($post_content['postImageID'] != NULL)
                    {   
                        echo $post_section_pictrue;
                    }
                    else 
                    {
                        echo $post_section_text;
                    }
                    echo $comment_section;
                    if ($comment_count > 0)
                    {
                        foreach ($comment_fields as $comment_field) {
                            echo $comment_field;
                        }
                    }
                    echo $comment_new;
                }
                echo "</div>";
            }
        ?>
    </div>
</div>