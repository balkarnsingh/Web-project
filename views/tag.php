<?php 
 //including the database connection file
 include_once("db-config.php");
 //Check if user is logged in
 if(!isset($_SESSION['user']))
 exit('<script>window.location = "index.php?page=login";</script>');
?>
<h1 class='title text-center'>Tagging</h1>
<?php tag($mysqli); ?>
<form action="index.php?page=tag" method="post">
    <div class="form-group">
        <label>Project</label>
        <select name="project" class='form-control'>
            <option>Select project</option>
            <?php projects($mysqli); ?>
        </select>
    </div>
    <div class="form-group">
        <label>Tag Students</label>
        <select name="student" class='form-control'>
            <option>Select student</option>
            <?php students($mysqli); ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" name='register'>Confirm Tag</button>
</form>
<?php

function tag($mysqli) {
    // Check If form submitted, insert user data into database.
    if (isset($_POST['student']) and isset($_POST['project'])) {
        $student = $_POST['student'];
        $project = $_POST['project'];

        if(!empty($student) and !empty($project)) {
            // If tag already exists, throw error
            $tag_res = mysqli_query($mysqli, "select * from tags where project_id='$project' and user_id='$student'");

            // Count the number of row matched 
            $tag_matched = mysqli_num_rows($tag_res);

            // If number of user rows returned more than 0, it means email already exists
            if ($tag_matched > 0) {
                echo "<div class='alert alert-danger'><strong>Error: </strong> Tag already exists. </div>";
            } else {
                // Insert user data into database
                $result   = mysqli_query($mysqli, "INSERT INTO tags(project_id,user_id) VALUES('$project','$student')");

                // check if user data inserted successfully.
                if ($result) {
                    echo "<div class='alert alert-success'>Tag registered successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Tag registration error. Please try again." . mysqli_error($mysqli)."</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Fill the form.</div>";
        }
    }
}
function students($mysqli) {
    $results = mysqli_query($mysqli, "select * from users");
    while($row = mysqli_fetch_assoc($results)) {
        echo "<option value='".$row['id']."'>".$row['name']."</option>";
    }
}
function projects($mysqli) {
    $results = mysqli_query($mysqli, "select * from projects WHERE user_id=".$_SESSION['user']['id']);
    while($row = mysqli_fetch_assoc($results)) {
        echo "<option value='".$row['id']."'>".$row['title']."</option>";
    }
}
?>