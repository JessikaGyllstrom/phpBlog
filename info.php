<!-- info.php
page that displays info about the blog-author -->
<?php
require_once './admin/db_credentials.php';
require_once './admin/db.php';
require_once './admin/sql_query.php';
    //if id is provided in url get post by id
    if (isset( $_GET["id"]))  {
        $id = $_GET["id"];
        getAuthorInfo ($id);
    }
    else {
        // if id isnt present in url get latest post
        $result = getLatestPost ();
        foreach ($result as $value) {
            $id = $value['id'];
        }
        getAuthorInfo ($id);
    }
?>




