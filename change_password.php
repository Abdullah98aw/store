<?php 
$title = 'Change password';
require_once 'template/header.php';
require 'config/app.php';
require_once 'config/database.php';

if (isset($_SESSION['logged_in'])) {
	header('location:index.php');
}

 /* validation change password */
 
if(!isset($_GET['token']) || !$_GET['token']){
    die(' token parameter is missing ');

}

$now = date('Y-m-d H:i:s');

$stmt = $mysqli->prepare("SELECT * from password_resets where token = ? and expires_at > '$now'");
$stmt->bind_param('s', $token);
$token = $_GET['token'];

$stmt->execute();

$result = $stmt->get_result();

if(!$result->num_rows){
    die('token is not valid');
}
/* for show array messages */
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = mysqli_real_escape_string($mysqli , $_POST['password']);
    $password_confirmation = mysqli_real_escape_string($mysqli , $_POST['password_confirmation']);

    if (empty($password)){ array_push($errors, 'Password is required');}
    if (empty($password_confirmation)){ array_push($errors, 'password_confirmation is required');}
    if($password != $password_confirmation){
        array_push($errors , "Passwords is not match");
    }

	if(!count($errors)){
			
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $userId = $result->fetch_assoc()['User_Id'];

		$mysqli->query("UPDATE users set password = '$hashed_password' where id = '$userId'");

        $mysqli->query("DELETE from password_resets where user_id='$userId'");

        $_SESSION['success_message']=" Your password has been changed, please log in ";


		header('location:login.php');
		die();
		 
	}

}
?> 


<div class="password_reset">

	<h3> password reset </h3>
	<h5 class="text-info"> please fill in the form below to login </h5> <br><hr>

<br>

<?php include 'template/errors.php'; ?> 
	
	<form action="" method="post">

	<div class="form-group">
	
		<label for="password"> New Password </label>
		<input type="password" name="password" class="form-control" placeholder="your new password" id="password">
				            									    
	</div>

	<div class="form-group">
	
		<label for="password_confirmation"> confirm new password </label>
		<input type="password" name="password_confirmation" class="form-control" placeholder="confirm password" 
        id="password_confirmation">
				            									    
	</div>

	<div class="form-group">

		<button class="btn btn-primary"> Save </button>

	</div>
</form>
</div> 
<?php  include 'template/footer.php' ?>