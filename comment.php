<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
		
	//If will be executed if the user write any comment in the page.	
	if($_POST){
		
		//Storing the id of the user who wrote the comment into a variable.
		$sender_id = $_SESSION['id'];
		//Storing into a variable, the id of the user who received the comment.
		$receiver_id = $_GET['id'];
		//Storing the comment in a variable .
		$comment = $_POST['comment'];
		
		//Inserting the data in(user id of who made the comment - user id of who received the comment - the comment) the database.
		$sql = "INSERT INTO comments (sender_id, receiver_id, comment) VALUES (?, ?, ?);";
		$sth = $DBH->prepare($sql);
		
		$sth->bindParam(1, $sender_id, PDO::PARAM_INT);
		$sth->bindParam(2, $receiver_id, PDO::PARAM_INT);
		$sth->bindParam(3, $comment, PDO::PARAM_STR);
		
		//Printing in the screnn message if the comment was sucessfuly saved in the database or not.
		if($sth->execute()){
			echo 'You made you post sucessfuly! You will be redirected now.';
		}else{
			echo ' An inesperade error happened. You will be redirected now. Sorry';
		}
	}//End of if($_POST)
	
	//Redirecting the user back.
    echo"<script>setTimeout(function(){window.history.back()},3000);</script>";
	
?>