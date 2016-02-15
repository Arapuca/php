<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
	
	//Using a email configuration, setted in another page.
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	//Creating a random number.
	$number = rand(0,10000);
	
	//Seting the admin email
	$admin_email = 'matheus.olopes@gmail.com';
	
	//If the user put an email, we will execute this if
	if($_POST){
		
		
		$email = $_POST['email'];
		$mail = new PHPMailer;
				
		//Checking if the email is registered in the database.		
		$sth = $DBH->prepare("SELECT * FROM users where email=:email LIMIT 1");
			
		$sth-> bindParam(":email",$email);
		$sth ->execute();
		$check = $sth->fetch(PDO::FETCH_ASSOC);
		
		//If will be executed if the email doenst exist in the database
		if($email != $check['email']){
			
			//Saying to the user that the email is not registered and send back to the page
			echo ' This email does not exist in our System. Try a vilid email. Thanks';
			echo"<script>setTimeout(function(){window.history.back()},3000);</script>";
			
		}else{
			
			
			$id = $check['id'];
			$_SESSION['id'] = $id;
			$username = $check['username'];
			$today = time(); 
			
			// Setting the email that we will send to the user, with the link to reset the password
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'matheus.olopes@gmail.com';
			$mail->Password = 'cctcollege';
			$mail->SMTPSecure = 'tls';
			$mail->From = 'matheus.olopes@gmail.com';
			$mail->FromName = 'Admin';
			$mail->addAddress($email, $username);
			
			$mail->WordWrap = 50;
			$mail->isHTML(true);
			 
			$mail->Subject = 'Reset your password';
			$mail->Body    = "Hi there! This is the link for you to reset your password." . 'http://localhost/forgotpassword.php?rand=' . $number . '&user_id=' . $id . '&time=' . $today . '';
			
			
			//Insering into the database the random number and the user id.
			$sql = "INSERT INTO forgotpassword (rand, uid) VALUES (?, ?);";
			$query = $DBH->prepare($sql);
			$query->bindParam(1, $number, PDO::PARAM_INT);
			$query->bindParam(2, $id, PDO::PARAM_INT);
			$query->execute();
			
			  
			//Displaying a message in the screen if the email wasn't send by any reason
			if(!$mail->send()) {
				
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				exit;
			}
			
			//Redirecting the user to the login page
			echo '<script> window.location="login.php"; </script>';
		}
	}//End of if($_POST).
 
?>
  
<h2>What is your email ?</h2><br>
<!-- Form will be used to chekc the user's email -->
<form action="recovery.php" method="post">
<input type="text" name="email" placeholder="Email:"/>
<input type="submit" value="Confirm!"/><br>
</form>
