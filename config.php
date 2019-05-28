<?php
   define('DB_SERVER', '127.0.0.1:3306');
   define('DB_USERNAME', 'portal');
   define('DB_PASSWORD', 'portal');
   define('DB_DATABASE', 'portal');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if (mysqli_connect_errno()) {
	    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
   }
?>
