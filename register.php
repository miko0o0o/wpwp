<?php
require_once('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $existingUserByUsername = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUserByUsername) {
        echo "<p style='color: red;'>Username already exists. Please choose a different username.</p>";
        exit();
    }

    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $existingUserByEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUserByEmail) {
        echo "<p style='color: red;'>Email already exists. Please use a different email.</p>";
        exit();
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)');
        $stmt->execute([$username, $email, $password, 'user']);
        
        header('Location: schedule.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="text-center welcome-message">
                    <h1>Register</h1>
                    <p>Create a new account to access the university timetable.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-decor">
                            <div class="card-header text-center">
                                <h2>Sign Up</h2>
                            </div>
                            <div class="card-body">
                                <form action="register.php" method="post">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Register</button>
                                    <div class="mt-3 text-center">
                                        <p>Already have an account? <a href="login.php">Login here</a></p>
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