<?php 



session_start();
if(!isset($_SESSION['userlogin']))
{
    header('Location: login.php');
}

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION);
		header("Location: login.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css" type="text/css">

    <title>FaceBook Lite</title>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">
                <img src="img/fb-icon.png" width="30" height="30" class="d-inline-block align-top" alt="">FaceBook Lite
            </a>
            <!-- Navigation | Tabs -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <?php
                            // parse the url
                            $pathInfo = parse_url($_SERVER['REQUEST_URI']);
                            $queryString = $pathInfo['query'];
                            // convert the query parameters to an array
                            parse_str($queryString, $queryArray);
                            // add the new query parameter into the array

                            $queryArray['page'] = "wall";
                            // build the new query string
                            $newQueryStr = http_build_query($queryArray);
                            echo "<a class='nav-link' href='".$pathInfo['host'].'?'.$newQueryStr."'>Wall</a>";
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                            $queryArray['page'] = "profile";
                            // build the new query string
                            $newQueryStr = http_build_query($queryArray);
                            echo "<a class='nav-link' href='".$pathInfo['host'].'?'.$newQueryStr."'>Profile</a>";
                        ?>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="?page=editAccount">Edit Account</a>
                            <a class="dropdown-item" href="?page=deleteAccount">Delete Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php?logout=true">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Navigation | Search box -->
            <form class="form-inline my-2 my-lg-0">

                    <form method='post' action='' enctype='multipart/form-data' method='post'>
                        <input class="form-control mr-sm-2" type='text' name='search-input' id='search-input' class='form-control' id='exampleFormControlTextarea1' placeholder="Search Friends" aria-label="Search">
                        <input class='btn btn-outline-light my-2 my-sm-0' type='submit' value='Search' name='button_search'>
                    </form>
            </form>
        </nav>
        
        <!-- Main -->
        <main>
            <?php
                if ($_GET['search-input'])
                {
                    include 'database.php';

                    include 'connect.php';

                    $db = new db($dbhost, $dbuser, $dbpass, $dbname);
                    
                    $friend_searches = $db->query("SELECT * FROM accounts WHERE username LIKE '%" . $_GET['search-input'] . "%'")->fetchAll();
                    $found = false;
                    foreach ($friend_searches as $friend_search) {
                        include_once "search.php";
                        $found = true;
                    }
                    if ($found == false)
                    {
                        echo "<div>No accounts found for that input</div>";
                    }
                }
                else if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                    include_once "$page.php";
                }
                else
                {
                    echo "<div>ERROR 404: This page does not exist.</div>";
                }
                

                
            ?>
            
        </main>

        <!-- Footer -->
        <footer id="sticky-footer" class="py-4 navbar-dark bg-primary text-white-50">
            <div class="container text-center">
                <small>Copyright &copy; Social Satellite</small>
            </div>
        </footer>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>