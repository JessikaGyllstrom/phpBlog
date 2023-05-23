<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome Page</title>
        <link rel="stylesheet" href="http://students.www.ltu.se/~jesgyl-0/labb4a/css/style.css">
    </head>
    <body>
        <?php
            require_once 'header.php';
        ?>
        <main class="welcome">
            <div class="welcome wrapper">
                <div>
                    <h3>Bloggers: </h3>
                    <?php require_once  'bloggerlist.php';
                    ?>
                </div>
                <div>
                    <h3>New Posts: </h3>
                    <?php require_once  'news.php';
                    ?>
                </div>
            </div>
        </main>
        <?php
            require_once 'footer.php';
        ?>
    </body>
</html>