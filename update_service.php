<?php
require 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=arcadia', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

$sql = 'UPDATE services SET name = :name, description = :description WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':name' => $name, ':description' => $description, ':id' => $id]);

header('Location: dashboard.php');
exit;
?>
