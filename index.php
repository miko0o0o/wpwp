<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Timetable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="background-image">
        <div class="overlay"></div>
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
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="text-center welcome-message">
                <h1>Welcome to University Timetable</h1>
                <p>This is your university timetable management system. Please log in or register to view and manage the schedule.</p>
                <p>For more information, visit <a href="https://www.unime.it" target="_blank">University of Messina</a>.</p>
            </div>

            <!-- Информация о факультетах -->
            <div class="faculty-info card-decor">
                <h2>About Our University</h2>
                <p>The University of Messina, known colloquially as UniME, is a state university located in Messina, Sicily, Italy. Founded in 1548 by Pope Paul III, it was the world's first Jesuit college, and today it is counted among the oldest universities in Italy.

It is organized in 12 departments offering more than 80 Graduate and Undergraduate Degrees, over 20 Master's Degrees and 13 PhD Programmes. Among them, 7 are English-taught. The University counts more than 23.000 students distributed in the 4 campus facilities spread across the city. (<a href="https://www.unime.it" target="_blank">www.unime.it</a>) is a leading educational institution committed to providing high-quality education and fostering a vibrant community of learners. We offer a wide range of academic programs across various faculties:</p>
                <ul>
                    <li><strong>Faculty of Science:</strong> Explore cutting-edge research and advanced technologies.</li>
                    <li><strong>Faculty of Engineering:</strong> Learn about innovative engineering solutions and real-world applications.</li>
                    <li><strong>Faculty of Arts and Humanities:</strong> Dive into the rich history and cultural heritage of our world.</li>
                    <li><strong>Faculty of Business and Economics:</strong> Develop essential business skills and knowledge in a dynamic environment.</li>
                </ul>
            </div>

            <!-- Контактная информация -->
            <div class="contact-info card-decor">
                <h2>Contact Us</h2>
                <p>If you have any questions or need further assistance, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:info@unime.it">info@unime.it</a></li>
                    <li><strong>Phone:</strong> +39 090 675 1111</li>
                    <li><strong>Address:</strong> Piazza Pugliatti, 1 - 98122 Messina ME, Italy</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>