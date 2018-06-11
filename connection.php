<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking";

// Create connection
$dbh = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}


 $user = "root";
$pass = "";   
$pdo = new PDO('mysql:host=localhost;dbname=booking', $user, $pass);
?>


