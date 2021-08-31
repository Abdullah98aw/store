<?php 

$title = 'Users';
$icon = 'users';
include __DIR__.'/../template/header.php';
$users = $mysqli->query("SELECT * from users order by id")->fetch_all(MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $st = $mysqli->prepare("DELETE from users where id = ? ");
     $st->bind_param('i', $userId );
     $userId = $_POST['user_id'];

     $st->execute();

     echo "<script>location.href = 'index.php'</script>";

}

?>

<div class="card">

     <div class="content">
          <a href="create.php" class="btn btn-success"> Create a new user </a> <br />
          <p>Users: <?php echo count($users) ?> </p>
         
          <div class="table-responsive">

               <table class="table table-striped">
                    <thead>

                         <tr>
                              <th width="0">#</th>
                              <th>Email</th>
                              <th>Name</th>
                              <th>Role</th>
                              <th width="250">Actions</th>
                         </tr>

                    </thead>
                    
                    <tbody>
                         <?php foreach($users as $user): ?>

                         <tr>
                              <td><?php echo $user['id'] ?></td>
                              <td><?php echo $user['email'] ?></td>
                              <td><?php echo $user['name'] ?></td>
                              <td><?php echo $user['role'] ?></td>
                              <td>
                                   <a href="edit.php?id=<?php echo $user['id']?>" class="btn btn-warning">Edit</a>
                              
                              <form action="" method="post" style="display: inline;">
                                   <input type="hidden" value="<?php echo $user['id'] ?>" name="user_id">
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