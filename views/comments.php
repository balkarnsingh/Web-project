<?php
    include_once("db-config.php");
    //Check if user is logged in
    if(!isset($_SESSION['user']))
        exit('<script>window.location = "index.php?page=login";</script>');
        
    $comments = mysqli_query($mysqli, "select comments.*, users.*, projects.* from comments JOIN users ON (users.id = comments.user_id) JOIN projects ON (projects.id = comments.project_id)");
    $comments_count = mysqli_num_rows($comments);
?>
<h1 class='title text-center'>Collaborations</h1>
<ul class="list-group">
  <?php if($comments_count): ?>
    <?php while($comment = mysqli_fetch_assoc($comments)): ?>
        <li class="list-group-item"><b>@<?=$comment['name'] ?></b> commented "<?=$comment['comment_text'] ?>" on <a href="index.php?page=view_project&id=<?=$comment['project_id'] ?>#collaborations"><?=$comment['title'] ?></a></li>
    <?php endwhile;; ?>
<?php endif; ?>
</ul>



