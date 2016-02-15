<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
		
	// this if will be executed when the user put a password int the form.
	if ($_POST){
		
		// Declaring the error message.
		$error = '';
		
		//If will be executed when the password put by the user be empty.
		if($_POST['password'] == ''){
			$error .= 'password field is empty'; // Append in the error message.
		}
		
		//If will be executed when the password put by the user be smaller than 8.
		else if(strlen($_POST['password']) <= 7){
			$error .= 'password too short'; // Append in the error message.
		}
		
		//If will be executed when the user put and invalid password.
		else if($error){
			
			//printing messages on the screen and sending the user to the page before, to put the password again..
			echo $error;
			echo 'Please put your password again';
			echo"<script> setTimeout(function(){window.history.back();},2000)</script>";
		}
		
		//If the password is valid, we store the value into a variable password.
		else{
			$password = $_POST['password'];
		}
		
	
		
		// Updating the server with the new password
		$query = "update users set `password` = :new_password where `id` = :user_id";
		$stmt = $DBH->prepare($query);
		$stmt->bindParam(':new_password',$password);
		$stmt->bindParam(':user_id',$_SESSION['id']);
		
		// Printing a message in the screen, saying that the password was updated or not. If yes, the user will be redicted for the login page.
		if($stmt->execute()){
			echo 'Your password is now upadted';
			
			
				// Deleting the information in the forgotpassword table.
		$query2 = "delete from forgotpassword where uid = :user_id";
		$del = $DBH->prepare($query2);
		$del->bindParam(':user_id',$_SESSION['id']);
		
		// If will be executed and will print a message, if any error happen.
		if($del->execute()){
			echo 'ok';
			echo '<script> window.location="login.php"; </script>';
		}else{
			echo ' An error happened in the process';
		}
			
		}else{
			echo 'An error happended';
		}
		
	
	}//end of if($_POST)		
	
?>