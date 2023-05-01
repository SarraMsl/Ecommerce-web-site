<?php 
	ob_start();
	session_start();
	$pageTitle = 'Login';

	if (isset($_SESSION['user'])) {
		header('Location: index.php');  
	}

	include 'init.php'; 
	// Check If User Coming Form HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			if(isset($_POST['login'])) {

				$user = $_POST['username'];
				$pass = $_POST['password'];
				$hashedPass = sha1($pass);


				//  Check If The User Exit In Database

				$stmt = $con->prepare("SELECT 
											UserID, Username, Password 
										FROM 
											users 
										WHERE 
											Username = ? 
										AND 
											Password = ?");
				$stmt->execute(array($user, $hashedPass));

				$get = $stmt->fetch();

				$count = $stmt->rowCount();

				//  If Count > 0 This Mean The Database Contain Record About This User name 

				if ($count > 0) {

					$_SESSION['user'] = $user; // Register Session Name

					$_SESSION['uid'] = $get['UserID']; // Register User Id in Session
 
					header('Location: index.php'); // Redirect To Dashboard Page
					exit();
				}
				
			} else {

				$formErrors = array();

				$username 	= $_POST['username'];
				$password	= $_POST['password'];
				$password2 	= $_POST['password2'];
				$email 		= $_POST['email'];


				if(isset($username)) {

					$filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

					if (strlen($filterdUser) < 4) {

						$formErrors[] = 'Username Must Be Larger Than 4 Characters'; 
					}
				}
  
				if(isset($password) && isset($password2)) {

					if (empty($password)) {

						$formErrors[] = "Sorry Password Cant't Be Empty";
					}					

					if (sha1($password) !== sha1($password2)) {

						$formErrors[] = 'Sorry Password Is Not Match';
					}

				}

				if(isset($email)) {

					$filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
 
					if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {

						$formErrors[] = 'This Email Is Not Valid';
					}
				}

				// Check If Ther's No Error Proced The User Add

				if (empty($formErrors)) {

					// Check If User Exist in Database

					$check =  checkItem("Username", "users", $username);

					if ($check == 1) {

						$formErrors[] = 'Sorry This User Is Exists';

					} else {
			
						// Inesrt Userinfo In The Database

						$stmt = $con->prepare("INSERT INTO 
												users(Username, Password, Email, RegStatus, Date)
											VALUES(:zuser,:zpass, :zmail, 0, now())");
 
						$stmt->execute(array(

							'zuser' => $username,
							'zpass' => sha1($password),
							'zmail' => $email
						));		

						// Echo Success Message  
						$succesMsg = 'Congrats You Are Now Registerd User';

					}

					}	

			}
			
	}	
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	
		
		
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li class="dropdown"><a href="#" class="active">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html" class="active">Products</a></li>
							
										<li><a href="login.php">Login</a></li> 
                                    </ul>
                                </li> 
								
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<form action="search_results.php" method="get">
					<div class="col-sm-3">
						<div class="search_box pull-right">
						<input type="text" id="search" name="search"placeholder="Search" class="form-control">
							<button type="submit" class="btn btn-default get">Search</button>
						</div>
					</div>
					</form>
				</div>
				</div>
			</div>
	</header>

<section>

<div class="container login-page">
		<h1 class="text-center">
			<span class="selected" data-class="login">Login</span> | 
			<span data-class="signup">Signup</span>
		</h1> 
		<!-- Start Login Form -->
		<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<div class="input-container">
				<input 
					class="form-control" 
					type="text" 
					name="username" 
					autocomplete="off" 
					placeholder="Type your username" required="required">
			</div>
			<div class="input-container">	
				<input 
					class="form-control" 
					type="password" 
					name="password" 
					autocomplete="new-password" 
					placeholder="Type your pasword" required="required">
			</div>		
				<input class="btn btn-primary btn-block" name="login" type="submit" value="Login">
		</form>
		<!-- End Login Form -->

		<!-- Start Signup Form -->
		<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<div class="input-container">
				<input 
					pattern=".{4,}" 
					title="Username Must Be Between 4 Chars" 
					class="form-control" 
					type="text" 
					name="username" 
					autocomplete="off" 
					placeholder="Type your username" 
					required>
			</div>	
			<div class="input-container">
				<input 
					minlength="4" 
					class="form-control" 
					type="password" 
					name="password" 
					autocomplete="new-password" 
					placeholder="Type a complex pasword" 
					required>
			</div>	
			<div class="input-container">	
				<input 
					class="form-control" 
					type="password" 
					name="password2" 
					autocomplete="new-password" 
					placeholder="Type pasword again"
					required>
			</div>	
			<div class="input-container">	
				<input 
					class="form-control" 
					type="email" 
					name="email" 
					placeholder="Type a valid email">
			</div>		
			<input class="btn btn-success btn-block" name="signup" type="submit" value="SingUp" style="color: #fff;
    background-color: #fe980f;
    border-color: #fe980f"> 
		</form>
		<!-- End Signup Form -->
		<div class="the-errors text-center">
			<?php 

				if (! empty($formErrors)) {

					foreach ($formErrors as $error) {
						
						echo '<div class="msg error">' . $error . '</div>';
					}
				}

				if (isset($succesMsg)) {

					echo '<div class="msg success">' . $succesMsg . '</div>';
				}

			?>
		</div>

	</div>

<?php 
	include $tpl . 'footer.php';
	ob_end_flush();
?>

</section>
<br>		<br>		<br>		<br>	<br>		<br>		<br>		<br>		<br>		<br>		<br>		<br>		<br>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">

					<p class="pull-left">Copyright © 2023 GL. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">SARRA & HOUDA</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>