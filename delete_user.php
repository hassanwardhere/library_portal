<?php
// Include your database connection file here
require_once('./config/db_conn.php');

// Get user id from the URL
$id = $_GET['id'];

// Delete user from the database
$sql = "DELETE FROM registration WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

// Redirect to users page
header("Location: users.php");
exit();
?>
