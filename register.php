<?php
session_start();

if (isset($_SESSION['loggedUser'])) {
    header('Location: landing.php');
    exit;
}

function loadUsers(): array
{
    $path = __DIR__ . '/users.json';

    if (!file_exists($path)) {
        file_put_contents($path, '[]');
        return [];
    }

    $contents = file_get_contents($path);
    $users = json_decode($contents, true);

    return is_array($users) ? $users : [];
}

function saveUsers(array $users): void
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

function isValidName(string $name): bool
{
    return preg_match('/^[A-Za-z\s\'-]{2,80}$/u', $name) === 1;
}

function isValidEmail(string $email): bool
{
    return preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email) === 1;
}

function isValidPassword(string $password): bool
{
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password) === 1;
}

$errors = [];
$formData = ['full_name' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['full_name'] = trim($_POST['full_name'] ?? '');
    $formData['email'] = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($formData['full_name'] === '') {
        $errors[] = 'Please enter your full name.';
    } elseif (!isValidName($formData['full_name'])) {
        $errors[] = 'Full name must contain only letters, spaces, apostrophes, or hyphens.';
    }

    if ($formData['email'] === '') {
        $errors[] = 'Please enter your email address.';
    } elseif (!isValidEmail($formData['email'])) {
        $errors[] = 'Please enter a valid email address (e.g., name@example.com).';
    }

    if ($password === '') {
        $errors[] = 'Please provide a password.';
    } elseif (!isValidPassword($password)) {
        $errors[] = 'Password must be at least 8 characters long and contain at least one letter and one number.';
    }

    if ($confirmPassword === '') {
        $errors[] = 'Please confirm your password.';
    } elseif ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match. Please re-check.';
    }

    if ($errors === []) {
        $users = loadUsers();
        foreach ($users as $user) {
            if (isset($user['email']) && strcasecmp((string) $user['email'], $formData['email']) === 0) {
                $errors[] = 'An account with this email already exists. Please log in instead.';
                break;
            }
        }
    }

    if ($errors === []) {
        $users[] = [
            'name' => $formData['full_name'],
            'email' => $formData['email'],
            'password' => $password,
        ];

        saveUsers($users);
        $_SESSION['register_success'] = 'Account created successfully! Redirecting to login...';
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | CivicPulse Performance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <main class="auth-card" aria-labelledby="register-title">
        <a class="auth-brand" href="index.php">
            <span class="brand-mark"><i class="bi bi-car-front"></i></span>
            <span>Honda Civic</span>
        </a>

        <h1 id="register-title" class="auth-heading">Join CivicPulse</h1>
        <p class="auth-subtitle">Create an account to track orders and save your Civic vehicle specs.</p>

        <?php if ($errors !== []): ?>
            <div id="register-success-msg" class="alert-error-box">
                <?php foreach ($errors as $message): ?>
                    <div><?php echo htmlspecialchars($message); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" novalidate>
            <div class="form-group">
                <label class="form-label" for="full-name">Full name</label>
                <input
                    class="form-control-custom"
                    type="text"
                    id="full-name"
                    name="full_name"
                    value="<?php echo htmlspecialchars($formData['full_name']); ?>"
                    placeholder="Juan Dela Cruz"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="register-email">Email address</label>
                <input
                    class="form-control-custom"
                    type="email"
                    id="register-email"
                    name="email"
                    value="<?php echo htmlspecialchars($formData['email']); ?>"
                    placeholder="driver@example.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="register-password">Password</label>
                <input
                    class="form-control-custom"
                    type="password"
                    id="register-password"
                    name="password"
                    placeholder="Create a password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="confirm-password">Confirm password</label>
                <input
                    class="form-control-custom"
                    type="password"
                    id="confirm-password"
                    name="confirm_password"
                    placeholder="Re-enter your password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button class="auth-button" type="submit">Create account</button>
        </form>

        <p class="auth-switch">
            Already have an account?
            <a href="login.php">Log in here</a>
        </p>
    </main>
</body>
</html>
