<?php 

$title = 'messages';
$icon = 'comment';
include __DIR__.'../template/header.php';
require_once '../config/database.php';
require_once '../classes/User.php';
 
$user = new User;
if(!$user->isAdmin()){
  die('ليس لديك الصلاحيات الكافية للوصول ..');
}

$st = $mysqli->prepare("SELECT *, m.id as message_id, s.id as service_id FROM messages m 
  left join services s
   on m.service_id = s.id ");

$st->execute();
$messages = $st->get_result()->fetch_all(MYSQLI_ASSOC);


if(!isset($_GET['id'])){


?> 


<div class="table-responsive">
<table class="table table-hover">
<h1 class="card-header text-center">customer messages </h1><br>
  <thead>
  	<tr>
  		<th>#</th>
  		<th>Sender name</th>
  		<th>Sander email</th>
  		<th>service </th>
  		<th>message </th>
  		<th>actions </th> 
  	</tr>
  </thead>
 
<tbody>
<?php 

foreach ($messages as $message ) {

?>

<tr> 
<td> <?php echo $message['message_id'] ?></td>	
<td> <?php echo $message['contact_name']?></td>
<td> <?php echo $message['email']?></td>
<td> <?php echo $message['name']?></td>

<td> <?php echo $message['message']?></td>
<td>
<a href="?id=<?php echo $message['message_id']?>" class="btn btn-sm btn-primary"> View </a>

<form onsubmit="return confirm('are you sure?')" action="" method="post" style="display: inline-block;">

  <input type="hidden" name="message_id" value="<?php echo $message['message_id'] ?>">
  <button class="btn btn-sm btn-danger">Delete</button>

</form>


</td>
</tr>

<?php } ?>

</tbody>
</table>
</div>



<?php 
}else{

  $messageQuery = "SELECT * FROM messages WHERE id=".$_GET['id']." Limit 1";
  $message = $mysqli->query($messageQuery)->fetch_array(MYSQLI_ASSOC);
?>

<div class="card">
    <h5 class="card-header"><?php echo $message['contact_name'] ?>
      <div class="small"><?php echo $message['email'] ?></div>
    </h5>
  <div class="card-body">
    <?php echo $message['message'] ?>
  </div>
</div>


<?php 
}
if (isset($_POST['message_id'])) {

  $st = $mysqli->prepare("DELETE FROM messages where id= ?");
  $st->bind_param('i', $messageId);
  $messageId = $_POST['message_id'];
  $st->execute();

  echo "<script> location.href = 'order.php' </script>";
}

$mysqli->close();


include __DIR__.'../template/footer.php';
?>

