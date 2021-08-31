<?php 
$title = 'Register';
require_once 'templates/header.php';
require 'config/app.php';
require_once 'config/database.php';

if (isset($_SESSION['logged_in'])) {
	header('location:index.php');
}

$errors = [];
$email = ''; // for don't delete email if found problem  *++* see to value=""

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// this is for validation before inside to DB ** (you can use filter_var(trim($**), FILTER_ *** _EMAIL)  && also you can use $mysqli->prepare())

		$email = mysqli_real_escape_string($mysqli , $_POST['email']);
		$password = mysqli_real_escape_string($mysqli , $_POST['password']);

	
	// array_push() ->> take a certain job and inside to array 
		if (empty($email)){ array_push($errors/* array */, 'Email is required' /* value for this array */);}
		if (empty($password)){ array_push($errors, 'Password is required');}

	if(!count($errors)){
			$userExists = $mysqli->query("SELECT id, email, password, name, role from users where email='$email' limit 1");
		}
		if(!$userExists->num_rows){
		
			array_push($errors, "your email $email is not exists");

		}else{

			$foundUser = $userExists->fetch_assoc();

			if(password_verify($password, $foundUser['password'])){

			$_SESSION['logged_in'] = true;
			$_SESSION['user_email'] = $foundUser['email'];
			$_SESSION['user_id'] = $foundUser['id'];
			$_SESSION['user_name'] = $foundUser['name'];
			$_SESSION['user_role'] = $foundUser['role'];

			//  نحدد الصلاحيات للمستخدم ويتم التكرار في حالة اضافة صلاحيات لل editor فقط .. 
			if($foundUser['role'] == 'admin'){
				header('location: admin');
			}else{ 

			$_SESSION['success_message'] = "Welcome back, $foundUser[name]";

			header('location:index.php');
			}
			// for edit product just (comment..)

			// if($foundUser['role'] == 'editor'){
			// 	header('location:admin/prodcts.php');
			// }
		
		


		     }else{
				array_push($errors, ' Wrong credentials');
			}

		}
	}

/*		// password crypted

		if (!count($errors)){
			
			$password = password_hash($password , PASSWORD_DEFAULT);
		
			$query = "insert into users (name, email , password) VALUES ('$name', '$email','$password')";
			$mysqli->query($query);
		
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $mysqli->insert_id;
			$_SESSION['user_name'] = $name;
			$_SESSION['success_message'] = "Welcome back, $name";

			header('location:index.php');
			die();

		} */


?> 


<div class="login">

	<h3> welcome back </h3>
	<h5 class="text-info"> please fill in the form below to login </h5> <br><hr>

<br>

<?php include 'templates/errors.php'; ?> 
	
	<form action="" method="post">

	<div class="form-group">
	
		<label for="email"> your email </label>
		<input type="email" name="email" class="form-control" placeholder="email" id="email" value="<?php echo $email ?>">
				            									    
	</div>


	<div class="form-group">
	
		<label for="password"> your password </label>
		<input type="password" name="password" class="form-control" placeholder="password" id="password">
				            									    
	</div>

	<div class="form-group">

	<a href="password_reset.php"> forget password ? </a><br><br>
		<button class="btn btn-success">Login</button>

	</div>
</form>
</div> 
<?php  include 'templates/footer.php' ?>