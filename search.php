<?php

    // parse the url
    $pathInfo = parse_url($_SERVER['REQUEST_URI']);
    // convert the query parameters to an array
    parse_str("", $queryArray);
    // add the new query parameter into the array
    $queryArray['account_id'] = $friend_search['id'];
    $queryArray['page'] = "profile";
    // build the new query string
    $newQueryStr = http_build_query($queryArray);

    echo "
    <div class='wall'>
    <div class='card-header'>
                <div class='row'>
                    <div class='col-sm-1'>
                        <img class='profile-pic-mini' src='img/dummy/profile-image.png'>
                    </div>
                    <div class='col-sm'>
                            <a href='".$pathInfo['host'].'?'.$newQueryStr."'>"  . $friend_search['first_name'] . " " . $friend_search['last_name'] . "</a>
                    </div>
                </div>
            </div>
    </div>
    ";   


if (isset($_GET["page"]) && $_GET["page"]=='wall') 
{
    echo "<script>window.location = 'index.php?account_id=".$_SESSION['id']."&page=wall'</script>";  
}
else if(isset($_GET["page"]) && $_GET["page"]=='profile')
{
    echo "<script>window.location = 'index.php?account_id=".$_SESSION['id']."&page=profile'</script>"; 
}

?> 