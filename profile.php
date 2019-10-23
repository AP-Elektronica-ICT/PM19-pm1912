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
$account_content;
foreach ($accounts as $account) {
    $account_content = $account;
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
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">New post:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </form>
                <form>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm">Post</button>
                </form>
            </div>
        </div>
        
        <!-- Posts -->
        <?php
            $post_count = 0;
            $posts = $db->query('SELECT * FROM posts WHERE user_id=' . $id)->fetchAll();
            foreach ($posts as $post) {
                $post_content = $post;
                $post_count++;

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