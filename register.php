<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
	
	//If will be executed when the user press the submit button int the register page.
	if($_POST){
		
		//Declaring the variables and receiving the values by the post method.
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		$username = $_POST['username'];
		$phone = $_POST['phone'];
		$age = $_POST['age'];
		
		//Variable error will be printed if any error of input happen.
		$error = '';
		
		//Cheking if the password is not empty.
		if($password == ''){
			$error .= 'password field is empty';
		}
		//Cheking if the username is not empty.
		else if($username == ''){
			$error .= 'username field is empty';
		}
		//Cheking if the password is not smaller than 8 characters.
		else if(strlen($password) <= 7){
			$error .= 'password too short';
		}
		//Cheking if the username is not smaller than 8 characters.
		else if(strlen($username) <= 7){
			$error .= 'username too short';
		}
		//Cheking if the phone is not empty.
		else if($phone == ''){
			$error .= 'phone field is empty';
		}
		//Cheking if the phone is not smaller than 8 characters.
		else if(strlen($phone) <= 7){
			$error .= 'phone too short';
		}
		//Cheking if the age is not empty.
		else if($age == ''){
			$error .= 'age field is empty';
		}
		//If will be execute if any error of the input happen.
		else if($error){
			echo $error; // printing the error messages.
		}
		
		//If there is no errors we check if the email is not already registered in the server.
		else{

			$sth = $DBH->prepare("SELECT * FROM users where email=:email LIMIT 1");
			
			$sth-> bindParam(":email",$email);
			$sth ->execute();
			$check = $sth->fetch(PDO::FETCH_ASSOC);
			
			//We insert the data into the database if the email isnt registered.
			if($email != $check['email']){
				$sql = "INSERT INTO users (email, password, username, phone, age) VALUES (?, ?, ?, ?, ?);";
				$sth = $DBH->prepare($sql);
				
				
				
				$sth->bindParam(1, $email, PDO::PARAM_STR);
				$sth->bindParam(2, $password, PDO::PARAM_STR);
				$sth->bindParam(3, $username, PDO::PARAM_STR);
				$sth->bindParam(4, $phone, PDO::PARAM_STR);
				$sth->bindParam(5, $age, PDO::PARAM_STR);
				$sth ->execute();
				
				//Keep the user id in the session.
				$_SESSION['username'] = $username;	
				
				// Sending the user to the profile page.
				echo '<script> window.location="login.php"; </script>';
			
			//Printing the message of member already registered.		
			}else{
				echo("Email already exists! Try Again.");
			}
		}//End of else.
		
	}//End of IF($_POST).

?>
<h2>Register</h2>
<p>Please, enter your Details: </p>

<!-- Form to register the user. -->

<form action="register.php" method="post">
<input type="email" name="email" placeholder="Email:"/>
<input type="password" name="password" placeholder="Password:"/>
<input type="text" name="username" placeholder="Username:"/><br>
<input type="text" name="phone" placeholder="Phone no:"/><br>
<input type="text" name="age" placeholder="Age: "/><br>
<input type="submit" value="Sign up!"/><br>
</form>
