<?php 
$title = 'Order';
require_once 'templates/header.php';
require 'classes/Service.php';
require 'classes/Product.php';


$total = new Service;
$total->taxRate = .15;

$Product = new Product;
$Product->taxRate = .15;

$mysqli = new mysqli('127.0.0.1', 'root', '', 'app');

// check connection 

if($mysqli->connect_error){
	die('Error connecting to database' . $mysqli->connect_error);
}else{
	echo ' database has been contacted ';
}

?>

	
		
			<h1 style="margin-left: 38%">the schedule </h1><br>
			<div class="row">
	<?php foreach (Service::all() as $service) { ?>

		<div class="col-md-4">
			<div class="card">

				<h4 class="card-header"> Price: </h4>
			  		<div class="card-body">
						<p><?php echo $service['price']?> </p>
			  		</div>

				<h4 class="card-header"> Tax: </h4>
					<div class="card-body">
						<p> 15% </p>
					</div>

				<h4 class="card-header"> Total price: </h4>
					<div class="card-body">
						<p><?php echo $total->totalPrice($service['price']) ?></p>
					</div>
			</div> 
		</div>
	<?php } ?>
  </div>

  <br> <hr> <br>

			<div class="row">
	<?php foreach (Product::all() as $product) { ?>

		<div class="col-md-4">
			<div class="card">

				<h4 class="card-header"> Type: </h4>
			  		<div class="card-body">
						<p> <?php echo $product['name'] ?> </p>
			  		</div>
			  	<h4 class="card-header"> Price: </h4>
			  		<div class="card-body">
						<p> <?php echo $product['price'] ?> </p>
			  		</div>
				<h4 class="card-header"> Tax: </h4>
					<div class="card-body">
						<p> 15% </p>
					</div>
				<h4 class="card-header"> Total price: </h4>
					<div class="card-body">
						<p><?php echo $Product->totalPrice($product['price']) ?></p>
					</div>
			</div> 
		</div>
	<?php } ?>
  </div>
<br><br>
<?php require_once 'templates/footer.php'?><br>