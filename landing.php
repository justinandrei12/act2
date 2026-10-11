<?php
session_start();

if (!isset($_SESSION['loggedUser'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$currentUser = $_SESSION['loggedUser'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | CivicPulse Performance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container py-2">
                <a class="brand-logo" href="index.php">Civic<span>Pulse</span></a>
                <a href="landing.php?logout=1" class="btn btn-outline-brand ms-auto">Log Out</a>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <div class="p-5 mb-4 bg-light rounded-3 shadow-sm text-center">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">Welcome, <?php echo htmlspecialchars($currentUser); ?>!</h1>
                <p class="col-md-8 fs-4 mx-auto text-muted mt-3">
                    You have successfully logged in to your CivicPulse account. Access your garage, track parts orders, or manage service appointments below.
                </p>
                <a href="index.php" class="btn btn-brand btn-lg mt-3">Return to Main Site</a>
            </div>
        </div>
    </main>
</body>
</html>
