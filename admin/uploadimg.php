<!-- uploadimg.php
upload images -->
<?php
    echo <<<_END
        <h2>Upload image</h2>
            <form enctype="multipart/form-data" method='post'>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" >
                 Add image: <input type="file" name="file_upload" accept="image/*" >  
                <input type='submit' name='upload' value='UPLOAD'>
            </form>
    _END;
?>
<?php
    if(isset($_POST['upload'])) {
        $tmp_filename = $_FILES['file_upload']['tmp_name'];
        $upload_dir = "uploads/";
        $target_file = basename($_FILES['file_upload']['name']);
        if(move_uploaded_file($tmp_filename, $upload_dir . $target_file))
        {
            $file = $_FILES['file_upload']['name'];
            $message = "File uploaded! " . $file;
            echo $message;
        }
        else
        {
            $error = $_FILES['file_upload']['error'];
            echo $error;
        }
    }
?>