<?php
$servername = "mysql";   
$username   = "todo_user";
$password   = "todo1234";
$dbname     = "todo";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
