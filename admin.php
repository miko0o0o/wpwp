<?php
session_start();
require_once('config/db.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM schedule WHERE id = ?");
        $stmt->execute([$delete_id]);
        header('Location: admin.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject'])) {
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


$stmt = $pdo->query("SELECT * FROM schedule");
$schedule = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php">View Schedule</a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="mb-4">Admin Panel</h1>
        
        
        <h2 class="mb-3">Add Schedule</h2>
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
            <button type="submit" class="btn btn-primary btn-block">Add</button>
        </form>
        
        
        <h2 class="mt-5 mb-3">Current Schedule</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Professor</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedule as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['professor']); ?></td>
                        <td><?php echo htmlspecialchars($row['time']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td class="action-btns">
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
