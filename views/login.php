<h1 class='title text-center'>Login</h1>
<?php login(); ?>
<form action="index.php?page=login" method="post">
    <div class="form-group">
        <label >Email address</label>
        <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name='email'>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Password" name='password'>
    </div>
    <button type="submit" class="btn btn-success" name='login'>Login</button>
</form>
<?php
function login() {
    //including the database connection file
    include_once("db-config.php");
    // If form submitted, collect email and password from form
    if (isset($_POST['login'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) and !empty($password)) {
            // Check if a user exists with given username & password
            $result = mysqli_query($mysqli, "select * from users
                where email='$email' and password='$password'");

            // Count the number of user/rows returned by query 
            $user_matched = mysqli_num_rows($result);
            $result = mysqli_fetch_assoc($result);
            // Check If user matched/exist, store user email in session and redirect to sample page-1
            if ($user_matched > 0) {
                $_SESSION["user"] = ['id' => $result['id'], 'email' => $result['email'], 'name' => $result['name']];
                exit('<script>window.location = "index.php";</script>');
            } else {
                echo "User email or password is not matched <br/><br/>";
            }
        }else {
            echo "<div class='alert alert-danger'>Fill the form.</div>";
        }
    }
}
?>