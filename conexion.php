<?php
$servername = "sql300.infinityfree.com";  
$username = "if0_35205189";    
$password = "lYiYoCi1BqNg"; 
$dbname = "if0_35205189_registros"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
