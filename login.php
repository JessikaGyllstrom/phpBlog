<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login or Register Page</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="login">
        <div class="login wrapper">
            <!-- form using the HTTP POST method to send the data -->
            <form method="POST">
                <h3>Login</h3>
                <label for="username"></label>
                <input id="username" name='username' class="input" type="text" placeholder="Name" required>
                <label for="password"></label>
                <input id="password" name='password' class="input" type="password" minlength="6" placeholder="Password" required>
                <input name="login" type="submit" class="submitbtn" value="login">
                <h3>Register</h3>
                <label for="author"></label>
                <input id='author' name='author' class='input' type='text' placeholder='Enter name' >
                <label for="title"></label>
                <input id='title' name='title' class='input' type='text' placeholder='Enter your title' >
                <label for="image"></label>
                <input id='image' name='image' class='input' type='text' placeholder='Image name' >
                <label for="desc"></label>
                <textarea id='desc' name='desc' class='input' placeholder='Enter description' ></textarea>
                <input name="register" type="submit" class="submitbtn" value="register">
            </form>
        </div>
    <?php
    require_once './admin/db_credentials.php';
    require_once './admin/db.php';
    require_once './admin/sql_query.php';
    ?>
    <?php
    $password = "";
    $username = "";
    $validPassword = false;
    $userExist = false;
    $id = "";
    // if fields have values
    if(!empty($_POST['password']) && !empty($_POST['username'])) {
        $password = $_POST['password'];
        $username = $_POST['username'];
    }
    // if login or register is clicked
    if ( isset($_POST['login']) || isset($_POST['register'])) {
        // send query to get all usernames
        $result = getUsers();
        // check if username exists
        $users = array();
        foreach ($result as $value) {
            $users[$value['username']] = $value['password'];
            $users[$value['id']] = $value['username'];
            $id = $value['id'];
            // if user is found
            if ($users[$value['id']] == $username) {
                $userExist = true;
                // if login in clicked
                if (isset($_POST['login'])) {
                    if ($users[$value['username']] == $password) {
                        $validPassword = true;
                        //start session
                        session_start();
                        // pass in session variables
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $id;
                        echo "Hi $username !";
                        die ("<p><a href='./admin/administer.php'>Click here to continue</a></p>");
                    }
                }
            }
            // if register is clicked
            if ((isset($_POST['register'])) &&
                (isset($_POST['author'])) &&
                (isset($_POST['title'])) &&
                (isset($_POST['image'])) &&
                (isset($_POST['desc']))) {
                $author = $_POST['author'];
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $image = $_POST['image'];
                // if username is taken
                if ($userExist) {
                    echo '<script>alert("Username already taken")</script>';
                } // if username is available
                else {
                    //administer.php user to database
                    addUser($username, $password, $author, $title, $desc, $image);
                }
            }
        }
        if ($users[$value['id']] != $username)  {
            echo "invalid username/password";
        }
    }
    ?>
    </div>
    <?php
    require_once 'footer.php';
?>
</body>
</html>
