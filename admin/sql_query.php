<!-- sql_query.php
queries to database -->
<?php
    require_once ('db.php');
    function getUsers()
    {
        $sql = "SELECT id, username, password FROM user ORDER BY created";
        $db = db_connect();
        $result = db_select($db, $sql);
        db_disconnect($db);
        return $result;
    }
    function getPostsById($id)
    {
        $db = db_connect();
        $sql = 'SELECT * FROM post WHERE userId=\'' . db_escape($db, $id) . '\'';
        $result = db_select($db, $sql);
        db_disconnect($db);
        return $result;
    }
    function addUser($username, $password, $author, $title, $desc, $image) {
        $db = db_connect();
        // Skapa SQL-frågan, glöm inte att "escapa" värden som skickas in
        $sql = 'INSERT INTO user (username, password, author, title, presentation, image) ';
        $sql .= 'VALUES (\'' . db_escape($db, $username) . '\', \'' . db_escape($db, $password)   . '\', \'' . db_escape($db, $author)  . '\', \'' . db_escape($db, $title)  . '\', \'' . db_escape($db, $desc). '\', \'' . db_escape($db, $image). '\')';
        db_query($db, $sql);
        db_disconnect($db);
        echo "Registration complete!";
    }
    function addPost($userId, $title, $content) {
        //set current date
        $date = date("Y-m-d H:i:s");
        $id = "22222222";
        $db = db_connect();
        $sql =   'INSERT INTO post (title, content, created, userId)';
        $sql .= 'VALUES (\'' . db_escape($db, $title) . '\' , \'' . db_escape($db, $content) . '\' , \'' . db_escape($db, $date) . '\', \'' . db_escape($db, $userId). '\')';
        db_query($db, $sql);
        db_disconnect($db);
        echo '<script>alert("Post added!")</script>';
        echo $userId;
    }
    function deletePost($postId) {
        $db = db_connect();
        $query = 'DELETE FROM `post` WHERE `post` . id=\'' . db_escape($db, $postId) . '\'';
        $result = db_query($db, $query);
        db_disconnect($db);
        if (!$result) echo "DELETE failed<br><br>";
        echo '<script>alert("Post deleted!")</script>';
    }
    function getNewPosts() {
      $sql = "SELECT  * FROM post ORDER BY created DESC LIMIT 0,5";
      $db = db_connect();
      $result = db_select($db, $sql);
      foreach ($result as $value)
      {
          $id = $value['id'];
          $title = substr($value['title'], 0, 30); // Hämtar tit
          echo "<a href='blog.php?id=$id'>$title</a><br>";
      }
          db_disconnect($db);
      return $result;
    }
    function getLatestPostbyId($id) {
        $db = db_connect();
        $sql = 'SELECT * FROM `post` WHERE `post` . id=\'' . db_escape($db, $id) . '\'';
        $result = db_select($db, $sql);
        foreach ($result as $value)
        {
            $id = $value['id'];
            $title = $value['title'];                     
            $content = $value['content'];
            $created = $value['created'];
            echo "<h3>$title</h3><br>
                  <p>$content</p><br> 
                  <p>$created</p><br>    
            ";
        }
        db_disconnect($db);
        return $result;
    }
    function getListOfPosts() {
       $db = db_connect();
       $query = 'SELECT * FROM post';
       $res = db_select($db, $query);
       foreach ($res as $value)
       {
           $id = $value['id'];
           $userId = $value['userId'];
           $title = substr($value['title'], 0, 30);
           echo "<a href='blog.php?id=$id'>	&#9830$title</a><br>";
       }
       db_disconnect ($db);
   }
   function getAuthor($id) {
       $db = db_connect();
       //$sql = "SELECT user.author FROM user INNER JOIN post ON user.id = post.userId WHERE post.id='$id'";
       $sql = 'SELECT * FROM user WHERE `user` . id=\'' . db_escape($db, $id) . '\'';
       $result = db_select($db, $sql);
       foreach ($result as $value) {
          echo $value['author'];
       }
       db_disconnect ($db);
   }
   function getAuthorInfo($id) {
      $db = db_connect();
      $sql = "SELECT user.author, user.title, user.presentation, user.image FROM user INNER JOIN post ON user.id = post.userId WHERE post.id='$id'";
       $result = db_select($db, $sql);
          foreach ($result as $value)
          {
              $author = $value['author'];
              $title = $value['title'];
              $desc = $value['presentation'];
              $path = $value['image'];
              echo "
                <h3>$author</h3><br>
                <p>$title</p><br>   
                <p>$desc</p><br>  
                <img src ='http://students.www.ltu.se/~jesgyl-0/labb4a/images/".$path."' width='150' alt='authorimage'> 
              ";
          }

          db_disconnect ($db);
          return $result;
          }
          function getLatestPost() {
              $db = db_connect();
              $sql = 'SELECT * FROM post ORDER BY created DESC LIMIT 0,1';
              $result = db_select($db, $sql);
              foreach ($result as $value)
              {
                  $id = $value['id'];
                  $title = $value['title'];
                  $content = $value['content'];
                  $created = $value['created'];
                  echo "<h3>$title</h3><br>
                  <p>$content</p><br> 
                  <p>$created</p><br>    
            ";
              }
              db_disconnect($db);
              return $result;
    }
    function getListOfBloggers() {
        $db = db_connect();
       // $query = 'SELECT * FROM post';
        //$query = "SELECT user.author, post.userId, post.id FROM user, post WHERE post.userId = user.id";
        $query = "SELECT post.userId, post.id, user.author FROM post INNER JOIN user ON post.userId = user.id";
        $users = Array();
        $res = db_select($db, $query);
        foreach ($res as $value)
        {
            //222222223332 = id
            $id = $value['id'];
            //1 = userid
            $userId = $value['userId'];
            $author = $value['author'];
            if (!in_array($users, $value))
            {
                $users = $value['author'];
                echo "<a href='blog.php?id=$id'>$author</a><br>";

            }

        }
        db_disconnect ($db);
    }