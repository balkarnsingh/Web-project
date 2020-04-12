<h1 class='title text-center'>Upload Project</h1>
<?php 
//Check if user is logged in
if(!isset($_SESSION['user']))
exit('<script>window.location = "index.php?page=login";</script>');

create(); 
?>
<form action="index.php?page=create_project" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" placeholder="title" name='title' required>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" cols="30" rows="10" class='form-control' required></textarea>
    </div>
    <div class="form-group">
        <label>GITHUB link</label>
        <input type="text" class="form-control" placeholder="GIT link" name='git_link'>
    </div>
    <div class="form-group">
        <label>File</label>
        <input type="file" name="file_upload">
    </div>
    <button type="submit" class="btn btn-primary" name='create_project'>Upload</button>
</form>
<?php
function create() {
    //including the database connection file
    include_once("db-config.php");

    // Check If form submitted, insert user data into database.
    if (isset($_POST['create_project'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $git_link = $_POST['git_link'];
        $user_id = $_SESSION['user']['id'];
        $file_upload = '';
        $error = false;

        if(!empty($title)) {
            if(isset($_FILES["file_upload"]) && $_FILES["file_upload"]["error"] == 0) {
                $filename = $_FILES["file_upload"]["name"];
                if(file_exists("uploads/" . $filename)){
                    echo '<div class="alert alert-danger">This file already exist.</div>';
                    $error = true; // this will stop further proccessing.
                }else {
                    move_uploaded_file($_FILES["file_upload"]["tmp_name"], "uploads/" . $filename);
                    $file_upload = $filename;
                }
            }
            // Check if there is any error with file upload
            if($error === false) {
                $result = mysqli_query($mysqli, "INSERT INTO projects(title,description,git_link,file_upload,user_id) VALUES('$title','$description','$git_link','$file_upload','$user_id')") or die(mysqli_error($mysqli));
                if($result) {
                    echo '<div class="alert alert-success">Successfully added.</div>';
                }
            }else {
                echo '<div class="alert alert-danger">An error occured. Please try again.</div>';
            }
            
        }else {
            echo '<div class="alert alert-danger">Pleae fill the form.</div>';
        }
    }
}
?>