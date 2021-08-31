<?php 
session_start();

require_once __DIR__.'/../config/app.php';
error_reporting(E_ALL);
ini_set('display_error',1);

?>
<!DOCTYPE html>

<html dir="<?php echo $config['dir'] ?>" lang="<?php echo $config['lang'] ?>"> 

<head>

	<title> <?php echo $config['app_name']." | ".$title ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" 
	integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<style> 

.custom-card-image{
	height: 250px;

}
</style>
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo $config['admin_assets'] ?>/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>

<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-secondary shadow">
    <a class="navbar-brand" href="/"><?php echo $config['app_name'] ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $config['app_url']?>index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $config['app_url']?>contact.php">order Here<i class="pe-7s-cart"></i></a>
        </li>
      </ul>

    <ul class='navbar-nav ml-auto '>
          <?php if(!isset($_SESSION['logged_in'])): ?>
      <li class="nav-item">
          <a class="nav-link " href="<?php echo $config['app_url']?>login.php">Login</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo $config['app_url']?>register.php" >Register</a>
      </li>

      <?php else: ?>

      <li class="nav-item">
          <span class="nav-link"><?php echo $_SESSION['user_name']?></span>
      </li>
      
      <li class="nav-item">
          <a class="nav-link" href="<?php echo $config['app_url']?>logout.php" >Logout</a>
      </li>

    <?php endif; ?>
    
   </ul>
</nav>
</div>
<br> <br>
	<div class="container">
<?php include 'message.php'; ?>