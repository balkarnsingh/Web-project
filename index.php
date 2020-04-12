<?php
    // Start PHP session at the beginning 
    session_start();

    $viewPath = 'views/home.php';
    if(isset($_GET['page']) and !empty($_GET['page'])) {
        $viewPath = 'views/'.$_GET['page'].'.php';

        if(!file_exists($viewPath))
            $viewPath = 'views/404.php';

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Georgian</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="top-header" id="top">
    <div class="container">
        <div class="row">
            <div class="col-6 text-left">
                <a href="index.php"><img src="images/logo.svg" alt="Georgian" class="logo"></a>
            </div>
            <div class="col-6 text-right">
                <div class="auth-links"> 
                    
                    <?php
                        if(isset($_SESSION['user']))
                            echo '<a href="index.php?page=logout">Log out</a>';
                        else
                            echo '<a href="index.php?page=login">Login</a> / <a href="index.php?page=register">Register</a>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Nav -->
<div class="nav-wrapper bg-blue">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=home#actions">Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact Us</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" method='post' action='index.php?page=search_projects'> 
                            <div class="input-group">
                                <input type="text" class="form-control search" placeholder="Search..." name='search'>
                                <div class="input-group-append">
                                  <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                              </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- end nav -->
<!-- Slider -->
<div id="slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
        <img src="images/2.jpg" alt="First slide" class="img-fluid">
        <div class="carousel-caption d-none d-md-block">
            <h1>Georgian College</h1>
            <p>A Changemaker Campus</p>
        </div>
    </div>
    <div class="carousel-item">
        <img src="images/1.jpg" alt="Second slide" class="img-fluid">
        <div class="carousel-caption d-none d-md-block">
            <h1>Georgian College</h1>
            <p>A Changemaker Campus</p>
        </div>
    </div>
    <div class="carousel-item">
        <img src="images/3.jpg" alt="Second slide" class="img-fluid">
        <div class="carousel-caption d-none d-md-block">
            <h1>Georgian College</h1>
            <p>A Changemaker Campus</p>
        </div>
    </div>
    </div>
    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
</div>
<!-- end Slider -->
<!-- content -->
<div id="content">
    <div class="container">
        <div class="col">
            <?php include($viewPath); ?>
        </div>
    </div>
</div>
<!-- end content -->
<!-- Contact us -->
<div id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="title-light text-center">Contact us</h1> 
                <?php
                        require('contact_us.php');

                ?>
                <form method='post'>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Name" class="form-control" name='name'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Email Address" class="form-control" name='email'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Phone" class="form-control" name='phone'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="City" class="form-control" name='city'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="message" rows="10" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <input type="submit" value="Contact Us" class="btn btn-primary pull-right" name='contact'>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Contact us -->
<!-- functionality -->
<div id="functionality">
    <div class="container">
        <div class="col-12">
            <h2>functionality Platforms</h2>
            <div class="row">
                <div class="col-12"><img src="images/func.png" height="150" class="img-fluid"></div>
            </div>
        </div>
    </div>
</div>
<!-- end functionality -->
<!-- about -->
<div id="about">
    <div class="container">
        <h1 class="title text-center">About us</h1>
        <div class="about-text">
            <div class="row">
                <div class="col-md-3"><img src="images/pp.jpg" alt="pp" class="img-fluid rounded-circle img-thumbnail"></div>
                <div class="col-md-9">
                    <h2>The Prospers</h2>
                    <p>Someone who desire change in the world and gathers resources and knowledge to make the change happen.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about -->
<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted"> Copyright © 2020 The Prospers. All rights reserved. </p>
            </div>
            <div class="col-md-6 text-right">
                <ul class="social-network social-circle">
                    <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
                    <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                </ul>				
            </div>
        </div>
    </div>
</footer>
<!-- endfooter -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if ($(this).attr('href').charAt(0) == '#' && this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();
    
          // Store hash
          var hash = this.hash;
    
          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
       
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
    </script>
</body>
</html>