

				

<?php
@ob_start();
session_start();
?>
<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "esmashop";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
       die('Could not Connect My Sql:' .mysql_error());
    }
if(isset($_POST['submit'])){
	$Username=$_POST['Username'];
	$category_name=$_POST['category_name'];
	$Country_Made=$_POST['Country_Made'];	
	$Quantity=$_POST['Quantity'];
	$Shipping=$_POST['Shipping'];
    $prodact=$_POST['prodact'];

	$Subject=$_POST['Subject'];
	$message=$_POST['message'];
	$sql="INSERT INTO  request (`Username`,`category_name`,`Country_Made`,`Quantity`,`Shipping`,`Subject`,`message`,`prodact`)VALUES('$Username','$category_name','$Country_Made','$Quantity','$Shipping','$Subject','$message','$prodact')";
    if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }

header("location:\PHP-PDO-simple-ecommerce-website-master\index.php");
mysqli_close($conn);
}

?>
