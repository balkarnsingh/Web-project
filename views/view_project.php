<?php
    include_once("db-config.php");
    $results = mysqli_query($mysqli, "select projects.*, users.*, projects.date_created AS project_date_created, projects.id AS project_id from projects JOIN users ON (users.id = projects.user_id) WHERE projects.id='".$_GET['id']."'");
    $row = mysqli_fetch_assoc($results);

    //Check if user is logged in
    if(!isset($_SESSION['user']))
        exit('<script>window.location = "index.php?page=login";</script>');
?>
<h1 class='title text-center'>Project Details</h1>
<?php if($row): ?>
    <div class="list-group">
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">ID</h5>
                <small>Posted on <?=$row['project_date_created'] ?></small>
            </div>
            <p class="mb-1"><?=$row['project_id'] ?></p>
        </a>
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Title</h5>
            </div>
            <p class="mb-1"><?=$row['title'] ?></p>
        </a>
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Description</h5>
            </div>
            <p class="mb-1"><?=$row['description'] ?></p>
        </a>
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Github Link</h5>
            </div>
            <p class="mb-1"><?=$row['git_link'] ?></p>
        </a>
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">File Uploaded</h5>
            </div>
            <p class="mb-1"><?=$row['file_upload'] ?></p>
        </a>
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Tags</h5>
            </div>
            <p class="mb-1">
            <?php 
                    $tags = mysqli_query($mysqli, "select * from tags JOIN users ON (users.id = tags.user_id) WHERE project_id='".$row['project_id']."'");
                    $count = mysqli_num_rows($results);
                    $counter = 0;
                    if($count) {
                        while($tags_row = mysqli_fetch_assoc($tags)) {
                            $counter++;
                            echo $counter == 1?'':', ';
                            echo $tags_row['name'];
                        }
                    }
                ?>
            </p>
        </a>
        <a href="#content" class="list-group-item list-group-item-action flex-column align-items-start">
            <small class="mb-1">Posted by <?=$row['name'] ?></small>
        </a>
    </div>

    <!-- Comments -->
    <div class="row ">
    <div class="col-md-12 mt-5">
        <div class="comment-wrapper" id='collaborations'>
            <div class="panel panel-info">
                <div class="panel-heading">
                    Collaborations & Discussions
                </div>
                <div class="panel-body">
                   <?php postComment($mysqli) ?>
                    <form method='post'>
                        <textarea class="form-control" placeholder="write a comment..." rows="3" name='comment' required></textarea>
                        <br>
                        <button type="submit" class="btn btn-info pull-right">Post</button>
                    </form>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list">
                        <?php
                        $comments = mysqli_query($mysqli, "select comments.*, users.*, comments.date_created AS comments_date_created from comments JOIN users ON (users.id = comments.user_id) WHERE project_id =".$_GET['id']);
                        $comments_count = mysqli_num_rows($comments);
                        ?>
                        <?php if($comments_count): ?>
                            <?php while($comment = mysqli_fetch_assoc($comments)): ?>
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="images/user_1.jpg" alt="" class="img-fluid rounded-circle img-thumbnail">
                                </a>
                                <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted"><?=$comment['comments_date_created'] ?></small>
                                    </span>
                                    <strong class="text-success">@<?=$comment['name'] ?></strong>
                                    <p>
                                        <?=$comment['comment_text'] ?>
                                    </p>
                                </div>
                            </li>
                            <?php endwhile;; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
    <!-- End comments -->
<?php else: ?>
    <div class='alert alert-danger'>No records found.</div>
<?php endif; ?>

 <?php 
 function postComment($mysqli) {
     if(isset($_POST['comment']) and !empty($_POST['comment'])) {
         $comment_text = $_POST['comment'];
         $user_id = $_SESSION['user']['id'];
         $project_id = $_GET['id'];

         $result   = mysqli_query($mysqli, "INSERT INTO comments(project_id,user_id, comment_text) VALUES('$project_id','$user_id','$comment_text')");
         // check if user data inserted successfully.
         if ($result) {
            echo "<div class='alert alert-success'>Posted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>An error occured. Please try again." . mysqli_error($mysqli)."</div>";
        }
     }
 }
 ?>