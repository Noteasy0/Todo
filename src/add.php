<?php
include "connect_db.php";

$task = $_POST['task'];
mysqli_query($conn, "INSERT INTO todos (task) VALUES ('$task')");
header("Location: index.php");
?>
