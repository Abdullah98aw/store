<?php 

$title = 'products';
$icon = 'dropbox';
include __DIR__.'/../template/header.php';
$products = $mysqli->query("SELECT * from products order by id")->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $st = $mysqli->prepare("DELETE from products where id = ? ");
     $st->bind_param('i', $productId );
     $productId = $_POST['product_id'];

     $st->execute();

     if($_POST['image']){
          unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'flexCourses/'.$_POST['image']);
     }

     echo "<script>location.href = 'index.php'</script>";

}

?>

<div class="card">

     <div class="content">
          <a href="create.php" class="btn btn-success"> Create a new product </a> <br />
          <p>Products: <?php echo count($products) ?> </p>
         
          <div class="table-responsive">

               <table class="table table-striped">
                    <thead>

                         <tr>
                              <th width="0">#</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Price</th>
                              <th>Image</th>
                              <th width="250">Actions</th>
                         </tr>

                    </thead>
                    
                    <tbody>
                         <?php foreach($products as $product): ?>

                         <tr>
                              <td><?php echo $product['id'] ?></td>
                              <td><?php echo $product['name'] ?></td>
                              <td><?php echo $product['description'] ?></td>
                              <td><?php echo $product['price'] ?></td>
                              <td><img src="<?php echo $config['app_url'].'/'.$product['image'] ?>" width="50" alt=""></td>

                              <td>
                                   <a href="edit.php?id=<?php echo $product['id']?>" class="btn btn-warning">Edit</a>
                              

                              <form action="" method="post" style="display: inline;">
                              
                                   <input type="hidden" value="<?php echo $product['id'] ?>" name="product_id">
                                   <input type="hidden" value="<?php echo $product['image'] ?>" name="image">
                                   <button onclick="return confirm('are you sure?')" class="btn btn-danger" type="submit">Delete</button>
                              
                              </form>        
                         
                              </td>

                         </tr>
                         <?php endforeach; ?>
                    </tbody>
               </table>

          </div>

     </div>

</div>


<?php
include __DIR__.'/../template/footer.php';
?>