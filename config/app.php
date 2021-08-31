<?php 

// لو كنت ابي اسم الموقع بشكل ديناميكي ومتغير من الداتابيس
include_once 'database.php';


$settings = $mysqli->query('SELECT * from settings where id = 1')->fetch_assoc();

if(count($settings)){

     $app_name = $settings['app_name'];
     $admin_email = $settings['admin_email'];

}else{

     $app_name = 'Service App 0';
     $admin_email = 'abdullah.98ha@gmail.com';

}


$config = 
[

'app_name' => $app_name ,
'admin_email' => $admin_email,
'app_url' => 'http://127.0.0.1/flexCourses/',
'lang' => 'en',
'dir' => 'ltr',
'admin_assets' => 'http://127.0.0.1/flexCourses/admin/template/assets/'
];

?>