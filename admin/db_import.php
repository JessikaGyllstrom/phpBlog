<?php
require_once "db.php";
$db = db_connect();
db_import($db, 'cms.sql', true);
db_disconnect($db);
?>