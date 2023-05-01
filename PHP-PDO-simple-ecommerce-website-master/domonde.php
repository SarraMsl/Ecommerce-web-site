<?php 
	ob_start();
	session_start();
	$pageTitle = 'Profile';
	include 'init.php'; 
	if(isset($_SESSION['user'])) {

	$getUser = $con->prepare("SELECT * FROM request inner join users WHERE users.Username =request.Username ");
	$getUser->execute(array($sessionUser));
	$info = $getUser->fetch();

?>

<h1 class="text-center">My Request</h1>

<div class="information block">
	<div class="container">
		<div class="panel panel-primary" style="    border-color: #f5f5f5;
">
			<div class="panel-heading" style="color: #e99002;
    background-color: #e99002;
    border-color: #e99002;">Request</div>
			<div class="row">
				<div class="col-md-4">
				</div>
					<div class="panel-body">
						<ul class="list-unstyled">
                        <li>
								<i class="fa fa-unlock-alt fa-fw"></i>
								<span>Prodact name</span> : <?php echo $info['prodact'] ?>
							</li>
							<li>
								<i class="fa fa-unlock-alt fa-fw"></i>
								<span>category name</span> : <?php echo $info['category_name'] ?>
							</li>
							<li>
								<i class="fa fa-envelope-o fa-fw"></i>
								<span>Country Made</span> : <?php echo $info['Country_Made'] ?>
							</li>
							<li>
								<i class="fa fa-user fa-fw"></i>
								<span>Quantity</span> : <?php echo $info['Quantity'] ?>
							</li>
							<li>
								<i class="fa fa-calendar fa-fw"></i>
								<span>Shipping Address</span> : <?php echo $info['Shipping'] ?>
							</li>
                            <li>
								<i class="fa fa-calendar fa-fw"></i>
								<span>Subject</span> : <?php echo $info['Subject'] ?>
							</li> 
                               <li>
								<i class="fa fa-calendar fa-fw"></i>
								<span>Message</span> : <?php echo $info['message'] ?>
							</li>
						</ul>
						
					</div>
				</div>
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
