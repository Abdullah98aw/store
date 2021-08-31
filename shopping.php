<?php 
$title = 'confirmation purchase';
require_once 'templates/header.php';

require 'classes/Service.php';
require 'classes/Product.php';
require 'config/app.php';
require_once 'config/database.php';

$total = new Service;


/* check connection */
if($mysqli->connect_error){
   die('Error connecting to database' . $mysqli->connect_error);
}
?>



<?php

require_once 'templates/footer.php'; 
?>