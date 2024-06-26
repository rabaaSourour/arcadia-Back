<?php
require 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=arcadia', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$animal_id = $_POST['animal_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$food = $_POST['food'];
$quantity = $_POST['grammage'];

$sql = 'INSERT INTO emplyee_reports (animal_id, date, time, food, grammage) VALUES (:animal_id, :date, :time, :food, :grammage)';
$stmt = $pdo->prepare($sql);
$stmt->execute([':animal_id' => $animal_id, ':date' => $date, ':time' => $time, ':food' => $food, ':grammage' => $grammage]);

header('Location: dashboard.php');
exit;
?>
