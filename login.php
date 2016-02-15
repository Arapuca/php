<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
	
	//Post will be executed when user pressed the button submit in the login page.
	if($_POST){

		
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		//Finding and user in the database and checking if the password is correct.
		$q = $DBH->prepare("select * from users where email = :email and password = :password LIMIT 1");
	   
		$q->bindValue(':email', $email);
		$q->bindValue(':password',  $password);
		$q->execute();
		$check = $q->fetch(PDO::FETCH_ASSOC);
	 
		$message = '';
		
		//If will be executed when $check is not empty.
		if (!empty($check)){
			
			//Saving the data from the database in the SESSION.
			$_SESSION['email'] = $check['email'];
			$_SESSION['id'] = $check['id'];
			$_SESSION['username'] = $check['username'];
			
			$id = $_SESSION['id'];
			
			//Redirecting the user for the profile page.
			echo '<script type="text/javascript"> window.location = "profile.php?id=' . $id . '"</script>';
			echo '<script> window.location="profile.php"; </script>';
		
		} else {
			echo $message= 'Sorry, your log in details are not correct';
		}
	}//End of if

?>
<h2>Login</h2><br>
<form action="login.php" method="post">
<input type="email" name="email" placeholder="Email:"/>
<input type="password" name="password" placeholder="Password:"/>
<input type="submit" value="Login"/><br>
<a href="recovery.php">Forget Password?</a>
</form>
<form action="register.php" method="post">
<input type="submit" value="Register"/><br>
</form>
