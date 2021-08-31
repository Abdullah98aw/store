<?php 
$title = 'Contact';
require_once 'templates/header.php';
require_once 'includes/uploader.php';
require_once 'classes/Service.php';


$total = new Service;
$total->taxRate = .15;


$products = $mysqli->query("SELECT id, name, price FROM products order by name")->fetch_all(MYSQLI_ASSOC);

if(isset($_SESSION['logged_in'])) { 
?>



<h1 style="margin-left: 38%"> Contact Us </h1>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
	
<div class="form-group">
	
	<label for="name">Your name </label>
	<input type="text" name="name" value="<?php if(isset($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name'] ?>" class="form-control" placeholder="your name">
	<span class="text-danger"><?php echo $nameError ?></span>
	
</div>

<div class="form-group">
	
	<label for="email"> e-mail </label>
	
	<input type="email" name="email" 
	value="<?php if(isset($_SESSION['contact_form']['email'])) echo $_SESSION['contact_form']['email'] ?>" 
	class="form-control" placeholder="email">
	
	<span class="text-danger"><?php echo $emailError ?></span>
				            									    
</div>


<div class="form-group">
   		<label for="products"> products </label>

<select name="product_id" id="products" class="form-control">

<?php foreach ($products as $product) { ?>
	
	<option value="<?php echo $product['id'] ?>">
		
	<?php echo $product['name'] ?>
	<?php $s = $product['price'] * .15; $b = $product['price'] + $s;  echo $b?> SAR 
		
	</option>

<?php } ?>

</select>
  
<div class="form-group">

	<label for="message">Notes </label>
	<textarea name="message" value="<?php echo $_SESSION['contact_form']['message'] ?>" class="form-control" placeholder="message"></textarea>
	<span class="text-danger"><?php echo $messageError ?></span>
	
</div>

<!-- for phone 

		<div class="form-group">
	
		<label for="number">Your number </label>
		<input type="text" name="phone" value="<?php // if(isset($_SESSION['contact_form']['phone'])) echo $_SESSION['contact_form']['phone'] ?>" class="form-control" placeholder="0500000000">
		<span class="text-danger"><?php // echo $phoneError ?></span>
	
		</div>
-->
	<button class="btn btn-primary"> Send </button>

</form>

<br><hr><br>

   <?php
  
  
}

else{
	
	echo "<div class='alert alert-danger' role='alert'>
	This is page for members, <a href='#' class='alert-link'>we sorry but must be   
	<a href='login.php'> Sign in</a> Or  <a href='logout.php'>Register</a>";
}

$mysqli->close();
 require_once 'templates/footer.php' ?>