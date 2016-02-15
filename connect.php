<?php 

//Conccting to the server
try {
			$host = '127.0.0.1';
			$dbname = 'webdesign';
			$user = 'root';
			$pass = '';
			# MySQL with PDO_MYSQL
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	} catch(PDOException $e) {echo 'Error';}  
?>
