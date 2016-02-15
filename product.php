<h1>Argos</h1>
<br>



<?php

$id = 1;
// making the connection to the database
    try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  

    // selecting the row from the database
    $q = $DBH->prepare("select * from products where id = :id");
    $q->bindValue(':id', $id);
    // running the SQL
    $q->execute();
    // pulling the data into a variable
    $check = $q->fetch(PDO::FETCH_ASSOC);
    // taking each individual piece
    $pname = $check['pname'];
    $price = $check['price'];
    $desc = $check['desc'];
    
echo 'Name: ' . $pname;
echo '<br>';
echo 'Description: ' . $desc;
echo '<br>';
echo 'id: ' . $id;
echo '<br>';
echo 'price: ' . $price;
echo '<br>';

 ?>