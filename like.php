 <?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
	
	$comment_id = $_GET['comment_id'];
	$sender_id = $_SESSION['id'];
	
	//Inserting the data in the database	
	$sql = "INSERT INTO likes (user_id, comment_id) VALUES (?,?);";
	$sth = $DBH->prepare($sql);
	$sth->bindParam(1, $sender_id, PDO::PARAM_INT);
	$sth->bindParam(2, $comment_id, PDO::PARAM_INT);			
								
	if($sth->execute()){
		echo ':)';
		
	}
	else {
		echo 'Error trying to get the like input';				
	
	}
	echo"<script> setTimeout(function(){window.history.back();},2000)</script>";

?>
	
