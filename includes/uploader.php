<?php 

require_once __DIR__."/../config/database.php" ;


function filterString($field)
{
	
	$field = filter_var(trim($field), FILTER_SANITIZE_STRING);
	
	if(empty($field)){
		return false;
	}else{
		return $field;
	}

}


function filterEmail($field)
{

	$field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);

	if(filter_var($field, FILTER_VALIDATE_EMAIL)){
		return $field; 
	}else{
		return false;
	}

}


$nameError = $emailError = $messageError = $phoneError = '';
$name = $email = $message = $phone = ''; 


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$name = filterString($_POST['name']);

		if(!$name){

			$_SESSION['contact_form']['name'] = '';
			$nameError = 'Your name is required';

		}else{

			$_SESSION['contact_form']['name'] = $name;

		}


		$email = filterEmail($_POST['email']);


		if(!$email){

			$_SESSION['contact_form']['email'] = '';
			$emailError = 'Your email is invalid';
	
		}else{

			$_SESSION['contact_form']['email'] = $email;

		}

/*														for phone


		$phone = filterString($_POST['phone']);

      	if(intval($_POST["phone"]) && !is_numeric($phone) && strlen($_POST["phone"]) !== 10 ){
      		$_SESSION['contact_form']['phone'] = '';
       		$phoneError = 'must be enter 10 numbers';
	
		}else{
			$_SESSION['contact_form']['phone'] = $phone;
		}


*/

$message = filterString($_POST['message']);

		if(!$message){

			$_SESSION['contact_form']['message'] = '';
			$messageError = 'You must enter a message';

		}else{

			$_SESSION['contact_form']['message'] = $message;

		}


		if(!$nameError && !$emailError && !$messageError)
		{

/*      //// #if you want send info form to db without message 
				don't show problem ////


			$message ? $filePath = $uploadDir .'/'. $fileName : $filePath = ''; 

*/
			//  this is for reduce pressure on DB *** [[ Validate from SQL injection ]]
			

			$stm = $mysqli->prepare("INSERT INTO messages 
			(contact_name, email, message, service_id) 
			Values( ?, ?, ?, ?)");


				//  this is for select the data type
			$stm->bind_param('sssi', $dbContactName, $dbEmail, $dbMessage, $dbServiceId);

			
				//  this is for execute 
			$dbContactName = $name;
			$dbEmail = $email;
			$dbMessage = $message;
			$dbServiceId = $_POST['service_id'];

			$stm->execute();


/*			
$insertMessage = "insert into messages (contact_name, email, message, service_id)".			
			"values ('$name', '$email', '$message', ".$_POST['service_id'].")";
			$mysqli->query($insertMessage);
*/			

			// session_destroy();
			header('location: index.php');
			die();

		}

};