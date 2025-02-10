<?php
session_start();
require_once('config/db.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $professor = $_POST['professor'];
    $time = $_POST['time'];
    $location = $_POST['location'];

    try {
        $stmt = $pdo->prepare("INSERT INTO schedule (subject, professor, time, location) VALUES (?, ?, ?, ?)");
        $stmt->execute([$subject, $professor, $time, $location]);
        header('Location: admin.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Schedule</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Add Schedule</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" class="form-control" required placeholder="Subject">
            </div>
            <div class="form-group">
                <label for="professor">Professor:</label>
                <input type="text" name="professor" class="form-control" required placeholder="Professor">
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="text" name="time" class="form-control" required placeholder="Time">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" class="form-control" required placeholder="Location">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</body>
</html>