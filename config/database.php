<?php 

$connection = 
[

	'host' => '127.0.0.1',
	'user' => 'root',
	'password' => '',
	'database' => 'app'

];


/* connection to data */

$mysqli = new mysqli(
	$connection['host'],
	$connection['user'],
	$connection['password'],
	$connection['database']
);

if($mysqli->connect_error) {
	die("ERROR connecting to database" . $mysqli->connect_error );
}