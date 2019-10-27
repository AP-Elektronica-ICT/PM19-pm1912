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
    if ($name == "")
    {
        $db->query("insert into posts(user_id, text) values(".$account_content['id'].',"'.$post_text.'")');
    }
    else {
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
}

?>
<!-- Wall -->
    <!-- Posts -->
    <div class="wall">
        <!-- Posts | New post -->
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
            $posts = $db->query('SELECT * FROM posts')->fetchAll();
            foreach ($posts as $post) {
                $post_content = $post;
                $post_count++;
                /*
                Check die kijkt of de post van een vriend is: (werkt nog niet)

                $post_content = $post;
                $posts = $db->query('
                    SELECT * FROM accounts A
                    LEFT JOIN friends F
                    ON A.id = F.id_second
                    WHERE F.id_first = '. $id .'
                    UNION
                    SELECT * FROM accounts A
                    LEFT JOIN friends F
                    ON A.id = F.id_first
                    WHERE F.id_second = ' . $post_content['user_id']
                )->fetchAll();
                foreach ($posts as $post) {
                    $post_content = $post;
                    $post_count++;
                } */
                $post_posters = $db->query('SELECT * FROM accounts WHERE id=' . $post_content['user_id'])->fetchAll();
                foreach ($post_posters as $post_poster) {
                    $poster = $post_poster;
                }

                $comments = $db->query('SELECT * FROM comments WHERE comment_id=' . $post_content['id'])->fetchAll();
                
                $post_section = "
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
                            <!-- Posts | Text post (edit dutton) -->
                            <div class='col-sm1'>
                                <button type='button' class='btn btn-outline-primary btn-sm'>...</button>
                            </div>
                        </div>
                    </div>
                    <!-- Posts | Text post (post) -->
                    <div class='card-body'>
                        <p class='card-text'>" . $post_content['text'] . "</p>
                        <button type='button' class='btn btn-primary btn-sm'>Like</button>
                        <small>" . $post_content['likes'] . " Likes</small>
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

                                            <!-- <img src='img/dummy/banner.jpg' class='card-img-top' alt='...'> -->
                                            <p class='card-text'>" . $comment_content['text'] . "</p>
                                            <button type='button' class='btn btn-primary btn-sm'>Like</button>
                                            <small>" . $comment_content['likes'] . " Likes</small>
                                        </div>
                                    </div>");
                                }
                                $comment_new = "<!-- Posts | Text post (new command) -->
                                <label for='exampleFormControlTextarea1'>New comment:</label>
                                <textarea class='form-control' id='exampleFormControlTextarea1' rows='3'></textarea>
                            </div>
                            <button type='button' class='btn btn-outline-primary btn-sm'>Comment</button>
                        </div>";
                    

                if ($post_count > 0)
                {
                    echo $post_section;
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