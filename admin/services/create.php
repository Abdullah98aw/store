<?php 

$title = 'Create service';
$icon = 'cubes';
include __DIR__.'/../template/header.php';


$errors = [];
$name = ''; 
$price = '';
$description = '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {


		$name = mysqli_real_escape_string($mysqli , $_POST['name']);
          $price = mysqli_real_escape_string($mysqli , $_POST['price']);
          $description = mysqli_real_escape_string($mysqli , $_POST['description']);
	
	 
		if (empty($name)){ array_push($errors, 'Name is required');}
		if (empty($description)){ array_push($errors, 'description is required');}
          if (empty($price)){ array_push($errors, 'Price is required');}

		
          
          if (!count($errors)){
			
		
			$query = "INSERT INTO services (name, description, price) VALUES ('$name','$description', '$price')";
			$mysqli->query($query);
		 
               if($mysqli->error){
                    array_push($errors , $mysqli->error);
               }else{
			echo "<script>location.href ='index.php'</script>";
               }
		}

}

?>

<div class="card">

     <div class="content">

     <?php include __DIR__.'/../template/errors.php' ?>
       
     <form action="" method="post">



          <div class="form-group">

               <label for="name"> your name </label>
               <input type="name" name="name" class="form-control" placeholder="your name" id="name" value="<?php echo $name ?>">
                                                                                     
          </div>


          <div class="form-group">
               
               <label for="description"> description </label>
               <textarea type="description" name="description" cols="30" rows="10" class="form-control" placeholder="description" id="description" value="<?php echo $description ?>"></textarea>

          </div>

          <div class="form-group">
               
               <label for="price"> price </label>
               <input type="price" name="price" class="form-control" placeholder="price" id="price" value="<?php echo $price ?>"> 

          </div>
          

          <div class="form-group">

               <button class="btn btn-success">Create</button>

         
          </div>
      
     </form>
     
     </div>

</div>

<?php
include __DIR__.'/../template/footer.php';
?>