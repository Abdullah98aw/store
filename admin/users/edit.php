<?php 

$title = 'Edit user';
$icon = 'user';
include __DIR__.'/../template/header.php';

if(!isset($_GET['id']) || !$_GET['id']){
     die('Missing id parameter');
}
// because user can input information.
$st = $mysqli->prepare('SELECT * from users where id = ? limit 1');

$st->bind_param('i', $userId);
$userId = $_GET['id'];

$st->execute();

$user = $st-> get_result()->fetch_assoc();

$name = $user['name'];
$email = $user['email'];
$role = $user['role'];
$errors = [];

// for update user acount ..   (2) and validate user pass without show old pass but you can a new pass for his.
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	// array_push() ->> take a certain job and inside to array 
     if (empty($_POST['email'])){ array_push($errors, 'Email is required');}
     if (empty($_POST['name'])){ array_push($errors, 'Name is required');}
     if (empty($_POST['role'])){ array_push($errors, 'Role is required');}


     if(!count($errors)){
  
     $st = $mysqli->prepare(" UPDATE users set name = ?, email = ?, role = ?, password = ? where id = ?");
     $st->bind_param('ssssi' , $dbName , $dbEmail , $dbRole , $dbPassword , $dbId);
     $dbName = $_POST['name'];
     $dbEmail = $_POST['email'];
     $dbRole = $_POST['role'];
     $_POST['password'] ? $dbPassword = password_hash($_POST['password'], PASSWORD_DEFAULT) : $dbPassword = $user['password']; 
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

               <label for="email"> your email </label>
               <input type="email" name="email" class="form-control" placeholder="email" id="email" value="<?php echo $email ?>">
                                                                                     
          </div>


          <div class="form-group">

               <label for="password"> your password </label>
               <input type="password" name="password" class="form-control" placeholder="password" id="password">
                                                                                     
          </div>

          <div class="form-group">
               <label for="role">Role: </label>
               <select name="role" id="role" class="form-control">
               
                    <option value="user" 
                    <?php if ($role == 'user') echo 'selected' ?> 
                    >User </option>

                    <option value="admin"
                     <?php if ($role == 'admin') echo 'selected' ?> 
                     >Admin </option>
               
               </select>
          </div>

          <div class="form-group">

               <button class="btn btn-success"> Update </button>

         
          </div>
      
     </form>
     
     </div>

</div>

<?php 
include __DIR__.'/../template/footer.php';
?>