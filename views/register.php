<h1 class='title text-center'>Register</h1>
<?php 
register(); 
?>
<form action="index.php?page=register" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Enter Name" name='name'>
    </div>
    <div class="form-group">
        <label >Email address</label>
        <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name='email'>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Password" name='password'>
    </div>
    <button type="submit" class="btn btn-primary" name='register'>Register</button>
</form>
<?php
function register() {
    //including the database connection file
    include_once("db-config.php");

    // Check If form submitted, insert user data into database.
    if (isset($_POST['register'])) {
        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($name) and !empty($email) and !empty($password)) {
            // If email already exists, throw error
            $email_result = mysqli_query($mysqli, "select 'email' from users where email='$email' and password='$password'");

            // Count the number of row matched 
            $user_matched = mysqli_num_rows($email_result);

            // If number of user rows returned more than 0, it means email already exists
            if ($user_matched > 0) {
                echo "<div class='alert alert-danger'><strong>Error: </strong> User already exists with the email id '$email'. </div>";
            } else {
                // Insert user data into database
                $result   = mysqli_query($mysqli, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");

                // check if user data inserted successfully.
                if ($result) {
                    echo "<div class='alert alert-success'>User Registered successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Registration error. Please try again." . mysqli_error($mysqli)."</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Fill the form.</div>";
        }
    }
}
?>