<?php

include 'php/connect.php';
    
$pass = password_hash('1234',PASSWORD_BCRYPT);
$sql = "INSERT INTO administrator (admin_name, password) values ('Danny','$pass')";
$stmt = $conn->prepare($sql);

if($stmt->execute())
    echo'Admin inserted';
else
    echo'fail inserting';


?>