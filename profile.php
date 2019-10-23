<?php
include 'database.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';
$dbname = 'facebooklite';

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
    <div class="profile-info">
        <div class="card" style="width: 18rem;">
            <img src="img/dummy/profile-image.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">
                    <?php  echo account_content['first_name'];  echo ' '; echo account_content['last_name']; ?>
                    <h6>
                        (<?php echo account_content['username'];?>)
                    </h6>
                </h5>
                    <small>
                        <?php echo account_content['quote'];?>
                    </small>
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Naam: <?php echo account_content['last_name'];?></li>
                <li class="list-group-item">Voornaam: <?php echo account_content['first_name'];?></li>
                <li class="list-group-item">Telefoonnummer: <?php echo account_content['tel'];?></li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Edit</a>
            </div>
        </div>
    </div>

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
            $posts = $db->query('SELECT * FROM posts WHERE user_id=' . $id)->fetchAll();
            foreach ($posts as $post) {
                $post_content = $post;

                $comments = $db->query('SELECT * FROM comments WHERE comment_id=' . $post_content['id'])->fetchAll();

                $postcard = "<div class='card'>
                <!-- Posts | Text post (user header) -->
                <div class='card-header'>
                    <div class='row'>
                        <div class='col-sm-1'>
                            <img class='profile-pic-mini' src='img/dummy/profile-image.png'>
                        </div>
                        <div class='col-sm'>" .
                            $account_content['first_name']
                            . "<p class='card-text'>
                                <small>5 minutes ago</small>
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
                </div>
                <!-- Posts | Text post (command section) -->
                <div class='card-footer'>
                    <div class='form-group'>
                        
                        <p>Comments: <small> (". "" . " comment)</small></p>
                        
                        <!-- Posts | Text post (command) -->
                        <div class='card-header'>
                            <div class='row'>
                                <div class='col-sm-1'>
                                    <img class='profile-pic-mini-comment' src='img/dummy/profile-image.png'>
                                </div>
                                Jens
                            </div>
                            <div class='card-body'>
                                <p class='card-text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores non mollitia repellat, soluta molestias quasi explic</p>
                                <button type='button' class='btn btn-primary btn-sm'>Like</button>
                                <small>1 Like</small>
                            </div>
                        </div>
                        <!-- Posts | Text post (new command) -->
                        <label for='exampleFormControlTextarea1'>New comment:</label>
                        <textarea class='form-control' id='exampleFormControlTextarea1' rows='3'></textarea>
                    </div>
                    <button type='button' class='btn btn-outline-primary btn-sm'>Comment</button>
                
            </div>";
            echo $postcard;
            }
            
        ?>
        </div>

        <!-- Posts | Foto post (dummy) -->
        <div class="card">
            <!-- Posts | Text post (user header) -->
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-1">
                        <img class="profile-pic-mini" src="img/dummy/profile-image.png">
                    </div>
                    <div class="col-sm">
                        Jens
                        <p class="card-text">
                            <small>20 minutes ago</small>
                        </p>
                    </div>
                    <!-- Posts | Text post (edit dutton) -->
                    <div class="col-sm1">
                        <button type="button" class="btn btn-outline-primary btn-sm">...</button>
                    </div>
                </div>
            </div>
            <!-- Posts | Text post (post) -->
            <div class="card-body">
                <img src="img/dummy/banner.jpg" class="card-img-top" alt="...">
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores non mollitia repellat, soluta molestias quasi explic</p>
                <button type="button" class="btn btn-primary btn-sm">Like</button>
                <small>7 Likes</small>
            </div>
            <!-- Posts | Text post (command section) -->
            <div class="card-footer">
                <div class="form-group">
                    
                    <p>Comments: <small> (0 comments)</small></p>
                    <!-- Posts | Text post (new command) -->
                    <label for="exampleFormControlTextarea1">New comment:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm">Comment</button>
            </div>
        </div>
    </div>
</div>