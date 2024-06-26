<?php
require 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=arcadia', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'];
$isvisible = $_POST['isvisible'];

$sql = 'UPDATE reviews SET isvisible = :isvisible WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':isvisible' => $is_validated, ':id' => $id]);

header('Location: dashboard.php');
exit;
?>
