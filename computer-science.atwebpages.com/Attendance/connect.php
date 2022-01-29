<?php

$con=mysqli_connect("localhost","root","","attmgsystem");

if (!$con){
    echo '<script>alert("Connection Error")</script>';
}
// $dbConnection = new PDO('mysql:dbname=attmgsystem;host=127.0.0.1;charset=utf8', 'root', '');

// $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $con = new mysqli("localhost", "root", "", "attmgsystem");
?>