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
$name = ''; // for don't delete name if found problem    *++* see to value=""

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// this is for validation before inside to DB ** (you can use filter_var(trim($**), FILTER_ *** _EMAIL)  && also you can use $mysqli->prepare())

		$name = mysqli_real_escape_string($mysqli , $_POST['name']);
		$email = mysqli_real_escape_string($mysqli , $_POST['email']);
		$password = mysqli_real_escape_string($mysqli , $_POST['password']);
		$password_confirmation = mysqli_real_escape_string($mysqli , $_POST['password_confirmation']);
	
	// array_push() ->> take a certain job and inside to array 
		if (empty($email)){ array_push($errors/* array */, 'Email is required' /* value for this array */);}
		if (empty($name)){ array_push($errors, 'Name is required');}
		if (empty($password)){ array_push($errors, 'Password is required');}
		if (empty($password_confirmation)){ array_push($errors, 'password_confirmation is required');}
		if ($password != $password_confirmation){
			array_push($errors , "Passwords is not match");
		}


	if(!count($errors)){
			$userExists = $mysqli->query("SELECT id, email from users where email='$email' limit 1");
		
		if($userExists->num_rows){
		
			array_push($errors, "Email already registred");

		}
	}

		// password crypted

		if (!count($errors)){
			
			$password = password_hash($password , PASSWORD_DEFAULT);
		
			$query = "INSERT into users (name, email, password) VALUES ('$name', '$email','$password')";
			$mysqli->query($query);
		
			$_SESSION['login'] = true;
			$_SESSION['user_id'] = $mysqli->insert_id;
			$_SESSION['user_name'] = $name;
			$_SESSION['success_message'] = "Welcome to our web site, $name";

			header('location:index.php');
			die();

		}

}

?> 


<div class="register">

	<h3> welcome to our website </h3>
	<h5 class="text-info"> please fill in the form below to register a new account</h5> <br><hr>

<br>

<?php include 'templates/errors.php'; ?> 
	
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
		
		<label for="password_confirmation"> confirm password </label>
		<input type="password" name="password_confirmation" class="form-control" placeholder="password_confirmation" id="password_confirmation">
		          									    
	</div>

	<div class="form-group">

		<a href="login.php">Already have an acount</a> <br><br>
		<button class="btn btn-success">Register</button>

	</div>
</form>
</div>
<?php require_once 'templates/footer.php'?>