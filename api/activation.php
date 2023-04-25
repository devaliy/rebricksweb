<?php
header("Content-Type: application/json");

require_once("db_connection.php"); // The database connection file we created earlier

$sql = "SELECT * FROM students";
$stmt = $db->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($students);
?>
