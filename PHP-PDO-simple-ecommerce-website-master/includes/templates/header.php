<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php getTitle() ?></title>
  <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.css">
  <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css">
  <link rel="stylesheet" href="<?php echo $css; ?>front.css">
</head>

<body>	 <div class="header_top"><!--header_top-->

<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"style="color: #e99002;
    text-decoration: none;"><i class="fa fa-phone"style="color: #e99002;
    text-decoration: none;"></i> +2 95 01 88 821</a></li>
								<li><a href="#"style="color: #e99002;
    text-decoration: none;"><i class="fa fa-envelope"style="color: #e99002;
    text-decoration: none;"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"style="color: #e99002;
    text-decoration: none;"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"style="color: #e99002;
    text-decoration: none;"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"style="color: #e99002;
    text-decoration: none;"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"style="color: #e99002;
    text-decoration: none;"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"style="color: #e99002;
    text-decoration: none;"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			</div><!--/header_top-->
<nav class="navbar navbar-inverse navngh" style="background-color: #e99002;
    border-color: #F0F0">
  <div class="container">


    <!-- Brand and toggle get grouped for better mobile display  -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed drop" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img class="logo" src="images/home/logo.png"></a>
    </div>

    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav navbar-right">
        
        <?php 
          if (isset($_SESSION['user'])) { ?>

          <div class="pull-right">
            <div class="btn-group my-info">
              <span class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo $sessionUser ?>
                <sapn class="caret"></sapn>
              </span>
              <ul class="dropdown-menu">
              <li><a href="\PHP-PDO-simple-ecommerce-website-master\index.php">Visit EsmaShop</a></li>
              <li><a href="\PHP-PDO-simple-ecommerce-website-master\domonde.php">Request</a></li>

                <li><a href="profile.php">Profile</a></li>
                <li><a href="newad.php">New Product</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </div> 
          </div>

          <?php 

          } else {
      ?>
      <br>
      <a href="login.php" style="color: #ccc;">
          <span class="pull-right"><b>Login | Signup</b></span>
      </a>
      <?php } ?>
      </ul>
    </div>  
  </div>
  
</nav>

  