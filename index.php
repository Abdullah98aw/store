<?php 
$title = 'Home Page';
require_once 'templates/header.php';

require 'classes/Service.php';
require 'classes/Product.php';
require 'config/app.php';
require_once 'config/database.php';

$total = new Service;


/* check connection */
if($mysqli->connect_error){
   die('Error connecting to database' . $mysqli->connect_error);
}

?>

	<?php if($total->available) { ?>		
 	
 	 <h1 class="card-header text-center">the Products </h1><br><br> 
   
   <?php 

   $products = $mysqli->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC)

   ?>

<div class="row">

   <?php foreach($products as $product) { ?> 
   <div class="col-md-4">
      <div class="card mb-3 shadow">


      <div class="custom-card-image" style="background-image: url('<?php echo $config['app_url'].$product['image'] ?>')">
      
            <!-- <?php if(!isset($product['description'])) { ?>
               
            <button class="btn btn-danger btn-sm mr-1 mb-2"> <span>Sold out</span></button>

            <?php } ?>  -->
      
      </div>
      

            <div class="card-body">
     
               <h4 class="card-title" class="name"> <?php echo $product['name'] ?></h4>
               
               <h6 class="description"><?php echo $product['description'] ?></h6>
               
               <h6 class="text-success" class="price" ><?php echo $product['price'] ?> SAR</h6>


            </div>
         </div>
      </div>
   <?php } ?>
</div>



<?php 

}

$mysqli->close();

require_once 'templates/footer.php'; ?>