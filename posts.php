<?php
$profileImageIDs;
$imageNames;
$imageName;
$imageLocation;
$profilepicture;
$profileImageIDs = $db->query('SELECT * FROM profielfoto WHERE userID=' . $account_content['id'] . ' ORDER BY ImageID DESC LIMIT 1')->fetchall();
foreach ($profileImageIDs as $imageID) {
    $profileImageID = $imageID['imageID'];
}
if ($profileImageID != null) {
    $imageNames= $db->query('SELECT * FROM images WHERE ImageId=' . $profileImageID)->fetchall();          
    foreach ($imageNames as $imagename) {
        $imageName = $imagename['ImageFileName'];
        }
    $imageLocation = "upload/" . $imageName ;
}
else {
$imageLocation = "dummy/profile-image.png";
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
        $db->query('DELETE FROM images WHERE ImageId=' . $_POST['postImageID']);
    }
    $db->query('DELETE FROM likes WHERE post_id=' . $_POST['post-id']);
    $db->query('DELETE FROM comments WHERE post_id=' . $_POST['post-id']);
    $db->query('DELETE FROM posts WHERE id=' . $_POST['post-id']);
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

$post_count = 0;
foreach ($posts as $post) {
    $post_content = $post;

    
    if ($should_check_for_friends == true)
    {
        $are_friends = false;
        $friends_checks = $db->query('SELECT * FROM friends WHERE (id_first=' . $id . ' AND id_first_confirmed=1 AND id_second='.$post_content['user_id'].' AND id_second_confirmed=1) OR (id_first=' . $post_content['user_id'] . ' AND id_first_confirmed=1 AND id_second='.$id.' AND id_second_confirmed=1)')->fetchAll();
        foreach ($friends_checks as $friends_check) {
            $are_friends = true;
        }
    }
    else
    {
        $are_friends = true;
    }
    
    if ($are_friends == true || $should_check_for_friends == false)
    {

    
        $posts_likes_query = $db->query('SELECT * FROM likes WHERE post_id="' . $post_content['id'] . '"');
        $posts_likes = $posts_likes_query->numRows();

        $post_count++;

        $post_posters = $db->query('SELECT * FROM accounts WHERE id=' . $post_content['user_id'])->fetchAll();
        foreach ($post_posters as $post_poster) {
            $poster = $post_poster;
            
        }
        

        $comments = $db->query('SELECT * FROM comments WHERE post_id=' . $post_content['id'])->fetchAll();

        $picture_tags = "";
        // Check if user uploaded a picture + get image info
        if ($post_content['postImageID'] != NULL)
        {
            $images = $db->query('SELECT * FROM images WHERE ImageId=' . $post_content['postImageID'])->fetchAll();
            foreach ($images as $image) {
                $image_name = $image;
            }
            
            $picture_tags = "<img class='card-img-top' src='img/upload/" . $image_name['ImageFileName'] ."'><p></p>";
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
        // parse the url
        $pathInfo = parse_url($_SERVER['REQUEST_URI']);
        $queryString = $pathInfo['query'];
        // convert the query parameters to an array
        parse_str($queryString, $queryArray);
        // add the new query parameter into the array
        $queryArray['account_id'] = $post_content['user_id'];
        $queryArray['page'] = "profile";
        // build the new query string
        $newQueryStr = http_build_query($queryArray);
        $post_section = "
        <div class='card'>
            <!-- Posts | Text post (user header) -->
            <div class='card-header'>
                <div class='row'>
                    <div class='col-sm-1'>
                        <img class='profile-pic-mini' src='img/" . $imageLocation . ">
                    </div>
                    <div class='col-sm'>
                            <a href='".$pathInfo['host'].'?'.$newQueryStr."'>"  . $poster['first_name'] . " " . $poster['last_name'] . "</a>"
                        . "<p class='card-text'>
                            <small>" . $post['date'] . "</small>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Posts | Text post (post) -->
            <div class='card-body'>
                <p class='card-text'>" . $post_content['text'] . "</p>
                ". $picture_tags ."
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
                            // parse the url
                            $pathInfo = parse_url($_SERVER['REQUEST_URI']);
                            $queryString = $pathInfo['query'];
                            // convert the query parameters to an array
                            parse_str($queryString, $queryArray);
                            // add the new query parameter into the array
                            $queryArray['account_id'] = $comment_content['user_id'];
                            $queryArray['page'] = "profile";
                            // build the new query string
                            $newQueryStr = http_build_query($queryArray);
                
                            $post_content['likes'];
                            array_push($comment_fields, "
                            <!-- Posts | Text post (command) -->
                            <div class='card-header'>
                                <div class='row'>
                                    <div class='col-sm-1'>
                                        <img class='profile-pic-mini-comment' src='img/" . $imageLocation . "'>
                                    </div>
                                    <a href='".$pathInfo['host'].'?'.$newQueryStr."'>"  . $comment_sender['first_name'] . " " . $comment_sender['last_name'] . "</a>
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
                            <p></p>
                            <input class='btn btn-outline-primary btn-sm' type='submit' value='Comment' name='but_react'>
                        </form>
                    </div>
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
}
if ($post_count == 0)
{
    $no_posts = "
    <div class='card' style='margin-bottom:1000px;'>
        <div class='card-header'>
            <p class='card-text'>No posts yet</p>
        </div>
        <div class='card-body'>
            <p class='card-text'>Add friends to fill your wall with posts.</p>
        </div>
    </div>";
    echo $no_posts;
        
}
?>