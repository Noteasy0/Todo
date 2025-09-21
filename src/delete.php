<?php
include "connect_db.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM todos WHERE id=$id");
header("Location: index.php");
?>
