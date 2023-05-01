<?php 
	ob_start();
	session_start();
	$pageTitle = 'Show Products';
	include 'init.php'; 

	// Chek If Get Request item Is Numiric & Get The Integer Value Of It 
	$itemid =  isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

	// Select All Data Depend On This ID
	$stmt = $con->prepare("SELECT 
								items.*, 
								categories.Name AS category_name,
								users.Username
						   FROM 
						   		items
						   INNER JOIN 
						   		categories
						   	ON 
						   		categories.ID = items.Cat_ID 
						   	INNER JOIN 
						   		users 
						   	ON    
						   		users.UserID = items.Member_ID		
						   WHERE 
						   		Item_ID = ?
						   AND
						   		Approve = 1");

	// Execute Query  
	$stmt->execute(array($itemid));

	$count = $stmt->rowCount();

	if ($count > 0) {
 
	// Fetch The Data
	$item = $stmt->fetch();	

?>
<br><br><br>


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
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
							<button type="button" class="btn btn-default get">Search</button>

						</div>
					</div>
				</div>
				</div>
			</div>
	</header>
	
<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-6 product-img-box">
			<?php
				if (empty($item['avatar'])) {
					echo "No Image";
				} else {
					echo "<img class='img-responsive product-img'  style='height: 350px;
					'src='uploads/product_img/" . $item['avatar'] .  "' alt='' />";
				}
			?>
		</div>
		<div class="col-md-8 col-sm-6 item-info">
			<h2><?php echo $item['Name'] ?></h2>
			<p><?php echo $item['Description'] ?></p>
			<ul class="list-unstyled">
				<li>
					<i class="fa fa-calendar fa-fw"></i>
					<span>Added Date</span> : <?php echo $item['Add_Date'] ?>
				</li>
				<li>
					<i class="fa fa-money fa-fw"></i>
					<span>Price</span> : DA<?php echo $item['Price'] ?>
				</li>
				<li>
					<i class="fa fa-count fa-fw"></i>
					<span>Quantity</span> : <?php 
						if ($item['Quantity'] == 0){
							echo 'This Product is not avaliable';
						} else {
							echo $item['Quantity'];
						}
						 
					?>
				</li>
				<li>
					<i class="fa fa-building fa-fw"></i>
					<span>Made In</span> : <?php echo $item['Country_Made'] ?>
				</li>
				<li>
					<i class="fa fa-tags fa-fw"></i>
					<span>Category</span> : <a href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name'] ?></a>
				</li>
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span>Added By</span> : <a href="#"><?php echo $item['Username'] ?></a>
				</li>
	


				<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Request </h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="\PHP-PDO-simple-ecommerce-website-master\back_add.php">
				            <div class="form-group col-md-6">
				                <input type="text" name="Username"   Value="<?php echo $item['Username'] ?>" class="form-control">
				            </div>
							<div class="form-group col-md-6">
				                <input type="text" name="category_name" class="form-control"   Value="<?php echo $item['category_name'] ?>">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="text" name="Country_Made" class="form-control" value=" <?php echo $item['Country_Made'] ?>">
				            </div>
							<div class="form-group col-md-6">
				                <input type="text" name="prodact" class="form-control" value=" <?php echo $item['Name'] ?>">
				            </div>
							<div class="form-group col-md-6">
				                <input type="number" name="Quantity" class="form-control" required="required"  placeholder="Quantity">
				            </div>
								<div class="form-group col-md-6">
				                <input type="text" name="Shipping" class="form-control" required="required"  placeholder="Shipping Address">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="Subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit"  class="btn btn-primary pull-right"value="Add" name="submit">
				            </div>
				        </form>
	    			</div>
	    		</div>	
			</ul>

			
		</div>
	</div>

	<br>
<br><br>	<br><br>	<br>	
</div>





		
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

<?php
	} else {
		echo '<div class="container">';
			echo "<div class='alert alert-danger'>There's no Such ID Or This Item Waiting Approval</div>";
		echo '</div>';	
	}
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>		


