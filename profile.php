<?php
	//Connecting to the server.
	include 'connect.php'; 
	//Starting the session.
	session_start();
	
	$id = $_GET['id'];
		
	echo 'Welcome, '.$_SESSION['username'] .'</BR>';
	
	//Doing a select in the database to find the user
	try{
		
		$q = $DBH->prepare ("select * from users where id = :id");
		$q -> bindValue (':id', $id);
		$q -> execute ();
		$profcheck = $q ->fetch(PDO::FETCH_ASSOC);
		
		$username = $profcheck ['username'];   
		$phone = $profcheck ['phone'];
		$email = $profcheck ['email'];

		//Printing the user's details in the screen
		echo '<br/><br/>';
		echo 'Your details:'; 
		echo '<br/>';
		echo 'Username: ' . $username;
		echo '<br/>';             
		echo 'phonenumber: ' . $phone;
		echo '<br/>';
		echo 'email: ' . $email; 
		echo '</center>';
		echo '<br/>';
		echo '<br/>';
		
		
		// Selecting all the comments of the user in the database.
		$query = $DBH->prepare("select * from comments where receiver_id = $id");
		$query -> execute();
		$rows = $query->rowCount();

		//Using a while to print all the comments, and the total likes of each comment
		$i = 0;
		while($i < $rows){
			$check = $query->fetch(PDO::FETCH_ASSOC, $i);
			 
			$comment_id = $check ['comment_id']; 

			$q1 = $DBH ->prepare ("select count(comment_id) as total_likes from likes where comment_id = $comment_id");
			$q1 ->execute();
			$check1 = $q1->fetch(PDO::FETCH_ASSOC);
			
			echo $check ['comment'] . "<br/>";
			echo "<a href=\"like.php?comment_id=$comment_id\">Like</a> " .  " " ."<img src=\"images\likebutton.png\">" . " " . $check1 ['total_likes'];
			echo '<br/>';
			echo '<br/>';
			$i++;
		}//End of while 
		
	} catch(PDOException $e) {echo 'Error' . $e;}  
	
	
 

?>
<br><h2>Users</h2>

<?php
	//Selecting all users from the database 	
	$q = $DBH->prepare("select * from users");
	$q->execute();

    // pulling the data into a variable

    $check = $q->fetchAll(PDO::FETCH_ASSOC);

    //Showing the users of the database

    foreach($check as $row){
		if($id != $row['id']){
			echo '<a href="profile.php?id=' . $row['id'] . '">' .$row['username'].'</a> </BR>';
		}
    }
?>

</br>
<form action="comment.php?id=<?php echo $id ?>" method="post">
<p>Leave your comment</p>
<textarea name="comment"></textarea>
<input type="submit" value="Post!"/><br>
<a href='logout.php'>Logout</a>
</form>
