<?php
$host = 'localhost';
$dbname = 'university_timetable'; // Название твоей базы данных
$username = 'root'; // Логин MySQL (обычно 'root' в XAMPP)
$password = ''; // Оставь пустым, если у тебя нет пароля

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

