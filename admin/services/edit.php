<?php 

$title = 'Edit service';
$icon = 'cubes';
include __DIR__.'/../template/header.php';


if(!isset($_GET['id']) || !$_GET['id']){
     die('Missing id parameter');
}


     $st = $mysqli->prepare('SELECT * from services where id = ? limit 1');
     $st->bind_param('i', $serviceId );
     $serviceId = $_GET['id'];
     $st->execute();

$service = $st-> get_result()->fetch_assoc();

$name = $service['name'];
$description = $service['description'];
$price = $service['price'];

$errors = [];

// for update user acount ..   (2) and validate user pass without show old pass but you can a new pass for his.
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	
     if (empty($_POST['name'])){ array_push($errors, 'Name is required');}
     if (empty($_POST['description'])){ array_push($errors, 'Description is required');}
     if (empty($_POST['price'])){ array_push($errors, 'price is required');}


     if(!count($errors)){
  
     $st = $mysqli->prepare(" UPDATE services set name = ?, description = ?, price = ? where id = ?");
     $st->bind_param('ssdi' , $dbName , $dbDescription , $dbPrice, $dbId);
     $dbName = $_POST['name'];
     $dbDescription = $_POST['description'];
     $dbPrice = $_POST['price'];
     $dbId = $_GET['id'];

     $st->execute();

     if($st->error){
          array_push($errors, $st->error);
     }else{
          echo "<script>location.href='index.php'</script>";
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