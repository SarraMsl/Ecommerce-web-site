<?php 
	session_start();
	include 'init.php'; 

	$sort ='asc';

	$sort_array = array('asc', 'desc');

	if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {

		$sort = $_GET['sort'];

	}

	$stmt2 = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort");

	$stmt2->execute();

	$cats = $stmt2->fetchAll();


?>
<br><br><br>
<div class="container">
	<div class="row">
		<div class="col-md-3 col-md-4" >
			<ul id="sideManu" class="nav  nav-stacked"  style="
    color: #F0F0E9;">
			<li class="list-group-item text-center active lead"style="z-index: 2;
    color: #ffffff;
    background-color: #fe980f;
    border-color: #f7f7f0;">						
			    Categories
		    </li>

			<?php
				foreach($cats as $cat) {
					echo '<li class="subMenu open"> <a>'. $cat['Name'] .'<span class="glyphicon glyphicon-triangle-bottom pull-right"></span></a> ';

					// Get Child Categories
					$childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID", "ASC");
					if (! empty($childCats)) {

						echo "<ul>";
							foreach ($childCats as $c) {
								echo "<li class='child-link'>
										<a href='categories.php?pageid=" .$c['ID'] . "'><i class='icon-chevron-right'></i>" .$c['Name'] . "</a>
									</li>";
							} 
						echo "</ul>";
					}
					echo '</li>';										
				}
			?>
			</ul>
		</div>
		
<section>	
<div class="container">
<div class="col-sm-8 col-md-9">

<div class="row">
<div class="product">
	<?php 
    			echo'			<h2 class="title text-center">Features Items</h2>';

		


			if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
				$category = intval($_GET['pageid']);
				$allItems = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1", "Item_ID");
				foreach ($allItems as $item) {
			echo '<div class="col-sm-6 col-md-4">';
				echo '<div class="thumbnail item-box">';
					echo '<span class="price-tag" style="    background-color: #2ecc69;
					">' . $item['Price'] . ' DA</span>';
					if (empty($item['avatar'])) {
						echo "No Image";
					} else {
						echo "<img class='img-responsive product-img' src='uploads/product_img/" . $item['avatar'] .  "' alt='' style='display: block;width: 100%;height: 200px;'/>";
					}
					echo '<div class="caption">';
						echo '<h3><a style="    color: #333333;
						" href="items.php?itemid=' . $item['Item_ID'] . '">' . substr($item['Name'], 0, 16) . '...</a></h3>';
						echo '<p>' . substr($item['Description'], 0, 40) . '...</p>'; ?>
						<span>Quantity</span> : <?php 
						if ($item['Quantity'] == 0){
							echo '<span>Out of Stock</span>';
						} else {
							echo $item['Quantity'];
						}
						echo '<br>';
						echo '<br>';

											echo'<a href="items.php?itemid=' . $item['Item_ID'] . '" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Details</a>';

						echo '<div class="date">' . $item['Add_Date'] . '</div>';

					echo '</div>';
				echo '</div>';
			echo '</div>';	
		}}
	?>


							
</section>
<?php include $tpl . 'footer.php'; ?>		







