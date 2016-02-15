<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
		
	//Declaring the variables.
	
	//$rand will receive the random number sent by the GET method.
	$rand = $_GET['rand'];
	//We will keep the user id int the session, by the variable $_Session['id'].
	$_SESSION['$id'] = $_GET['user_id'];
	//Getting the time by the method get.
	$time = $_GET['time'];
	//Stting the timout value;
	$timeout = $time + 3600;
	
	//Checking if the link sent for the user is still valid(30 min).
	if($time > $timeout){
		// Link was acessed more than 30 min after being sent
		echo 'sorry expired, try again';
		die;
	}else{
		
		//using a select to find the random number in the database
		$sth = $DBH->prepare("SELECT * FROM forgotpassword where rand=:rand LIMIT 1");
		
		$sth-> bindParam(":rand",$rand);
		$sth ->execute();
		$check = $sth->fetch(PDO::FETCH_ASSOC);
	}
					
?>
	<!-- Form wher the user will set a new password. This form will send the user to the page reset.php by the method post. -->
	<h2>Set your new password</h2>
	<form action="reset.php" method="post">
	<input type="password" name="password" placeholder="Password:"/>
	<input type="submit" value="Submit"/><br>
	</form>
  

