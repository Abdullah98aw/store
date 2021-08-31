<?php 
$title = 'password reset';
require_once 'templates/header.php';
require 'config/app.php';
require_once 'config/database.php';

if (isset($_SESSION['logged_in'])) {
	header('location:index.php');
}

$errors = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$email = mysqli_real_escape_string($mysqli , $_POST['email']);

		if (empty($email)){
			 array_push($errors, 'Email is required'); }


	if(!count($errors)){
			$userExists = $mysqli->query("SELECT id, email, name from users where email='$email' limit 1");
		
		if($userExists->num_rows){
		
			$userId = $userExists->fetch_assoc()['id'];

			$tokenExists = $mysqli->query(" DELETE from password_resets where user_id='$userId'");
			
			$token = bin2hex(random_bytes(16));

			$expires_at = date('Y-m-d H:i:s', strtotime('+1 day'));

			$mysqli->query("INSERT INTO password_resets (user_id, token, expires_at) 
			VALUES('$userId', '$token', '$expires_at'); ");
		
			$changePasswordUrl = $config['app_url'].'change_password.php?token='.$token;
			$headers = "MIME-Version: 1.0" . "\r\n"; 
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

			$headers .= 'From: '.$config['admin_email']."\r\n".
			   'Replay-To: '.$config['admin_email']."\r\n" .
			   'X-Mailer:php/'. phpversion();

			   $htmlmessage = '<html><body>';
			   $htmlmessage .= '<p style="color:#ff0000;">'.$changePasswordUrl.'</p>';
			   $htmlmessage .= '</body></html>';

			   mail($email, 'You have new message'.$htmlmessage, $headers);

		} $_SESSION['success_message'] = 'please Check your email';
			header('location:password_reset.php');
	}

}
?> 


<div class="password_resets">

	<h3> password reset </h3>
	<h5 class="text-info"> please fill in the form below to login </h5> <br><hr>

<br>

<?php include 'templates/errors.php'; ?> 
	
	<form action="" method="post">

	<div class="form-group">
	
		<label for="email"> your email </label>
		<input type="email" name="email" class="form-control" placeholder="email" id="email" value="<?php echo $email ?>">
				            									    
	</div>

	<div class="form-group">

		<button class="btn btn-primary"> request pass </button>

	</div>
</form>
</div> 
<?php  include 'templates/footer.php' ?>