<?php
    include_once("db-config.php");
    if(isset($_POST['search']) and !empty($_POST['search'])) {
        $results = mysqli_query($mysqli, "select * from projects WHERE title LIKE '%".$_POST['search']."%'");
    }else {
        $results = mysqli_query($mysqli, "select * from projects");
    }
    $count = mysqli_num_rows($results);
    //Check if user is logged in
    if(!isset($_SESSION['user']))
        exit('<script>window.location = "index.php?page=login";</script>');

?>
<h1 class='title text-center'>Search Projects</h1>
<form class="form-inline pull-right" method='post'>
  <div class="form-group mx-sm-3 mb-2">
    <label for="search" class="sr-only">Search</label>
    <input type="text" class="form-control" id="search" placeholder="search" name='search'>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
<div class="clearfix"></div>
<?php if($count): ?>
    <table class='table mt-5 mb-5'>
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>description</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($results)): ?>
                <tr>
                    <td><?=$row['id'] ?></td>
                    <td><?=$row['title'] ?></td>
                    <td><?=$row['description'] ?></td>
                    <td><?=$row['date_created'] ?></td>
                    <td><a href="index.php?page=view_project&id=<?=$row['id'] ?>">View</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class='alert alert-danger'>No records found.</div>
<?php endif; ?>
