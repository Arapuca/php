<h1>Users</h1>

<?php

	include 'connect.php';


    // selecting the row from the database

    $q = $DBH->prepare("select * from users");

    // running the SQL

    $q->execute();

    // pulling the data into a variable

    $check = $q->fetchAll(PDO::FETCH_ASSOC);

    // taking each individual piece

    foreach($check as $row){

       echo '<a href="profile.php?id=' . $row['id'] . '">' .$row['username'].'</a> </BR>';

    }
	

 ?>

 