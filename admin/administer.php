<!-- administer
page for logged in user to administer their blog-post -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
    <body>
    <div class="admin">
        <div class="admin header">
            <?php
            session_start();
            require_once 'db_credentials.php';
            require_once 'db.php';
            require_once 'sql_query.php';
            echo "
               <form method='post'>
                    <input name='logout' type='submit' class='submitbtn' value='Log Out'>
               </form>";
            // if user clicks logout
            if (isset($_POST['logout'])) {
                // destroy curren session
                session_destroy ();
                die ("<p><a href='http://students.www.ltu.se/~jesgyl-0/labb4a/'>Click here to continue</a></p>");
            }
            // if session is provided both username and id
            if (isset($_SESSION['username'], $_SESSION['id'])) {
                $user = htmlspecialchars ($_SESSION['username']);
                $userId = htmlspecialchars ($_SESSION['id']);
                echo "Welcome back $user !<br>";
            } else {
                echo ("<p><a href='http://localhost:63342/labb4a/index.php'>Click here to continue</a></p>");
            }
            echo "<a href='http://students.www.ltu.se/~jesgyl-0/labb4a/blog.php'>Go To Blogpage</a><br>";
            ?>
            </div>
            <div class="admin container">
                <div class="admin wrapper">
            <?php
            require_once 'uploadimg.php';
            echo
            <<<_END
            <h2>Add a new post</h2>
            <form method='post'>
            Title:<input type='text' name='postTitle'>    
            Content:<textarea name='postContent' rows="15"></textarea>              
            <input type='submit' name='addBtn' value='ADD POST'>                                                                                                                                   
            </form>   
            _END;
            if((!empty($_POST['postTitle'])) && (!empty( $_POST['postContent']))  && (isset( $_POST['addBtn'])) )   {
                $userId = $_SESSION['id'];
                //get posts by id
                $result = getPostsById ($userId);
                $postTitle = $_POST['postTitle'];
                $postContent = $_POST['postContent'];
                addPost ($userId,$postTitle,$postContent);
            }
            echo "<h2>Delete Posts</h2>";
            $userId = $_SESSION['id'];
            //get posts by id
            $result = getPostsById ($userId);
            if(!$result) echo "No posts to display...";
            else {
                foreach ($result as $value) {
                    $title = htmlspecialchars ($value['title']);
                    $content = htmlspecialchars ($value['content']);
                    $created = htmlspecialchars ($value['created']);
                    $postId = htmlspecialchars ($value['id']);
                    echo
                    <<<_END
                Title: $title <br>
                Content: $content <br>
                Date: $created <br>
                Id: $postId <br>
                 <form method='post'> 
                 <input type='hidden' name='delete' value='yes'>
                            <input type='hidden' name='postId' value='$postId'>
                    <input type='submit' name='deleteBtn' value='DELETE POST'>
                  </form>
                _END;
                }
                if (isset($_POST['delete'])) {
                    $postId = $_POST['postId'];
                    deletePost ($postId);
                    header ("Refresh:0");
                }
            }
        ?>
                </div>
        </div>
    </div>
</body>
</html>






