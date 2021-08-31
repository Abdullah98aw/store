<?php 

$title = 'Create user';
$icon = 'user';
include __DIR__.'/../template/header.php';


$errors = [];
$email = ''; 
$name = ''; 
$role = '';

	if ($_SERVER['REQUEST_METHOD'] == "POST") {


		$name = mysqli_real_escape_string($mysqli , $_POST['name']);
		$email = mysqli_real_escape_string($mysqli , $_POST['email']);
		$password = mysqli_real_escape_string($mysqli , $_POST['password']);
		$role = mysqli_real_escape_string($mysqli , $_POST['role']);
	
	// array_push() ->> take a certain job and inside to array 
		if (empty($email)){ array_push($errors/* array */, 'Email is required' /* value for this array */);}
		if (empty($name)){ array_push($errors, 'Name is required');}
		if (empty($password)){ array_push($errors, 'Password is required');}
		if (empty($role)){ array_push($errors, 'Role is required');}		

// for show errors ..

	// if(!count($errors)){
	// 		$userExists = $mysqli->query("SELECT id, email from users where email='$email' limit 1");
		
	// 	if($userExists->num_rows){
		
	// 		array_push($errors, "Email already registred");

	// 	}
	// }


		// password crypted

		if (!count($errors)){
			
			$password = password_hash($password , PASSWORD_DEFAULT);
		
			$query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email','$password', '$role')";
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

               <label for="email"> your email </label>
               <input type="email" name="email" class="form-control" placeholder="email" id="email" value="<?php echo $email ?>">
                                                                                     
          </div>

          <div class="form-group">

               <label for="name"> your name </label>
               <input type="name" name="name" class="form-control" placeholder="your name" id="name" value="<?php echo $name ?>">
                                                                                     
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

                    <option vlaue="admin"
                     <?php if ($role == 'admin') echo 'selected' ?> 
                     >Admin </option>
               
               </select>
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