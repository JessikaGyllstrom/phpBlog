<!-- content.php
present blog-post -->
<?php
    require_once './admin/db_credentials.php';
    require_once './admin/db.php';
    require_once './admin/sql_query.php';
    //if id is provided in url get post by id
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $result = getLatestPostbyId($id);
        $author = getAuthor($id);
    }
    else {
        // if id isn't present in url get latest post
        $result = getLatestPost ();
    }
?>
