<?php
    include_once("db-config.php");
    //Check if user is logged in
    if(!isset($_SESSION['user']))
        exit('<script>window.location = "index.php?page=login";</script>');
        
    if(isset($_POST['search']) and !empty($_POST['search'])) {
        $results = mysqli_query($mysqli, "select projects.*, users.*, projects.id AS project_id from projects JOIN users ON (users.id = projects.user_id) WHERE title LIKE '%".$_POST['search']."%' AND file_upload > ''");
    }else {
        $results = mysqli_query($mysqli, "select projects.*, users.*, projects.id AS project_id from projects JOIN users ON (users.id = projects.user_id) WHERE file_upload > ''");
    }
    $count = mysqli_num_rows($results);

?>
<h1 class='title text-center'>Download Project Files</h1>
<form class="form-inline pull-right" method='post'>
  <div class="form-group mx-sm-3 mb-2">
    <label for="search" class="sr-only">Search</label>
    <input type="text" class="form-control" id="search" placeholder="search" name='search'>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
<div class="clearfix"></div>
<?php if($count): ?>
    <div class="row">
    <?php while($row = mysqli_fetch_assoc($results)): ?>
        <div class='col-md-4'>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="index.php?page=view_project&id=<?=$row['project_id'] ?>"><?=$row['title'] ?></a></h5>
                    <p class="card-text"><?=$row['file_upload'] ?></p>
                    <a href="uploads/<?=$row['file_upload'] ?>" class="btn btn-primary" target="_blank">Download</a>
                </div>
                <div class="card-footer text-muted">
                    Posted by <?=$row['name'] ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class='alert alert-danger'>No records found.</div>
<?php endif; ?>
