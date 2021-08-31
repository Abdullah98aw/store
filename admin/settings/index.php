<?php 

$title = 'Settings';
$icon = 'gear';
include __DIR__.'/../template/header.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

     $st = $mysqli->prepare('UPDATE settings set app_name = ?, admin_email = ? where id = 1');
     
     $st->bind_param( 'ss' , $dbAppName, $dbAdminEmail) ;
     $dbAppName = $_POST['app_name'];
     $dbAdminEmail = $_POST['admin_email'];
     
     
     $st->execute();

     echo "<script>location.href ='index.php'</script>";
}

?>


<div class="card">
     
     <div class="content">
     
     <h3> Update Settings </h3>

          <form action="" method="POST">
          
               <div class="form-group">

                    <label for="app_name"> Application Name </label>
                    <input type="text" name="app_name" value="<?php echo $config['app_name'] ?>" id="app_name" class="form-control">

               </div>


               <div class="form-group">

                    <label for="admin_email"> Admin Email </label>
                    <input type="email" name="admin_email" value="<?php echo $config['admin_email'] ?>" id="admin_email" class="form-control">

               </div>

               <div class="form-group">

               <button class="btn btn-success">Update Settings</button>

         
               </div>


          </form>

     </div>

</div>

<?php

include __DIR__.'/../template/footer.php';
?>