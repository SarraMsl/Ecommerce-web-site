<?php 
	ob_start();
	session_start();
	$pageTitle = 'Profile';
	include 'init.php'; 
	if(isset($_SESSION['user'])) {

	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($sessionUser));
	$info = $getUser->fetch();
	$userid = $info['UserID']; 
?>

<h1 class="text-center">My Profile</h1>

<div class="information block">
	<div class="container">
		<div class="panel panel-primary" style="    border-color: #f5f5f5;
">
			<div class="panel-heading" style="color: #e99002;
    background-color: #e99002;
    border-color: #e99002;">My Information</div>
			<div class="row">
				<div class="col-md-4">
					<br><img src="uploads/user_img/<?php echo $info['avatar'] ?>" class="img-responsive img-thumbnail" style="display: block;width: 80%;height: 285px;">
				</div>
				<div class="col-md-8">
					<div class="panel-body">
						<ul class="list-unstyled">
							<li>
								<i class="fa fa-unlock-alt fa-fw"></i>
								<span>Login Name</span> : <?php echo $info['Username'] ?>
							</li>
							<li>
								<i class="fa fa-envelope-o fa-fw"></i>
								<span>Email</span> : <?php echo $info['Email'] ?>
							</li>
							<li>
								<i class="fa fa-user fa-fw"></i>
								<span>Full Name</span> : <?php echo $info['FullName'] ?>
							</li>
							<li>
								<i class="fa fa-calendar fa-fw"></i>
								<span>Register Date</span> : <?php echo $info['Date'] ?>
							</li>
							<li>
								<i class="fa fa-tags fa-fw"></i>
								<span>Fav Category</span> :
							</li>
						</ul>
						<a href="#" class="btn btn-default">Edit Information</a>
						
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>


<div>
	<div></div>
	<div class="container">
		<div class="panel panel-primary" style="    border-color: #f5f5f5;
">
			<div class="panel-heading" style="color: #e99002;
    background-color: #e99002;
    border-color: #e99002;">My Products</div>
			<div class="panel-body">
			<?php 
				$myItems = getAllFrom("*", "items", "where Member_ID = $userid", "", "Item_ID");
				if (! empty($myItems)) {
					echo '<div class="row">';
					foreach ($myItems as $item) {
						echo '<div class="col-sm-6 col-md-3">';
							echo '<div class="thumbnail item-box">';
								if ($item['Approve'] == 0) { 
									echo '<span class="approve-status">Waiting Approval</span>';
								}
								echo '<span class="price-tag">DA' . $item['Price'] . '</span>';
								echo '<img class="img-responsive" src="uploads/product_img/'. $item['avatar'] .'" alt="" >';
								echo '<div class="caption">';
									echo '<h3><a href="items.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] . '</a></h3>';
									echo '<p>' . $item['Description'] . '</p>';
									echo '<div class="date">' . $item['Add_Date'] . '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					} 
					echo '</div>';
				} else {
					echo "Sorry There's No Add To Show, Create <a href='newad.php'> New Ad</a>";
			}

			?>
			<a class="btn btn-default" href="newad.php">New Product</a>
			</div>
		</div>
	</div>
</div>



<?php
	}else {
		header('location: login.php');
		exit();
	}
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>		
