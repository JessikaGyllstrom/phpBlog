<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Blog Page</title>
        <link rel="stylesheet"  href="./css/style.css">
    </head>
    <body>
    <?php
    session_start ();
    if (isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        echo "<a href='http://students.www.ltu.se/~jesgyl-0/labb4a/admin/administer.php'>";
    }
    ?>
    <?php
        require_once 'header.php';
    ?>
    <main class="blog">
        <div class="container">
        <aside>
            <h3>Posts:</h3>
            <?php
            require_once 'menu.php';
            ?>
        </aside>
        <div>
            <?php
            require_once 'content.php';
            ?>
        </div>
        <div>
            <h3>Author: </h3>
            <?php
            require_once 'info.php';
            ?>
        </div>
        </div>
    </main>
    <?php
    require_once 'footer.php';
    ?>
    <script src="main.js"></script>
    </body>
</html>