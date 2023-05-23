<!--menu.php
page that contains a list of all blogg-posts -->
<?php
    require_once './admin/db_credentials.php';
    require_once './admin/db.php';
    require_once './admin/sql_query.php';
    getListOfPosts ();
?>