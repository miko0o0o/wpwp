<?php
session_start();
require_once('config/db.php'); // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Проверка, чтобы поля не были пустыми
    if (empty($username) || empty($password)) {
        echo "<p style='color: red;'>Username and password cannot be empty.</p>";
        exit();
    }

    // Подготовка SQL запроса
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем, существует ли пользователь и совпадает ли пароль
    if ($user) {
        // Сравнение пароля (проверяем хешированный пароль)
        if (password_verify($password, $user['password'])) {
            // Устанавливаем данные в сессии
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            // Редирект на страницу расписания
            header('Location: schedule.php');
            exit(); // Прерываем выполнение
        } else {
            echo "<p style='color: red;'>Invalid password.</p>";
        }
    } else {
        echo "<p style='color: red;'>Invalid username.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="background-image">
        <div class="overlay">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo.png" alt="University Logo" class="logo">
                        University Timetable
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="text-center welcome-message">
                    <h1>Login</h1>
                    <p>Please log in to access the university timetable.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-decor">
                            <div class="card-header text-center">
                                <h2>Login</h2>
                            </div>
                            <div class="card-body">
                                <form action="login.php" method="post">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    <div class="mt-3 text-center">
                                        <p>Don't have an account? <a href="register.php">Register here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>