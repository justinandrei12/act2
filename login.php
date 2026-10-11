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

function isValidEmail(string $email): bool
{
    return preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email) === 1;
}

function isValidUsername(string $username): bool
{
    return preg_match('/^(admin|[^\s@]+@[^\s@]+\.[^\s@]+)$/i', $username) === 1;
}

$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errorMessage = 'Please enter both your username/email and password.';
    } elseif (!isValidUsername($username)) {
        $errorMessage = 'Please enter a valid email address or the admin username.';
    } else {
        $registeredUsers = loadUsers();
        $registeredUser = null;

        foreach ($registeredUsers as $user) {
            if (isset($user['email'], $user['password'])
                && strcasecmp((string) $user['email'], $username) === 0
                && (string) $user['password'] === $password) {
                $registeredUser = $user;
                break;
            }
        }

        $isAdmin = $username === 'admin' && preg_match('/^\d{5}$/', $password) === 1;

        if ($isAdmin || $registeredUser) {
            $_SESSION['loggedUser'] = $isAdmin ? 'admin' : (string) $registeredUser['name'];
            $_SESSION['isLoggedIn'] = 'true';
            header('Location: landing.php');
            exit;
        }

        $errorMessage = 'Invalid email or password. Register first if you do not have an account.';
    }
}

$successMessage = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CivicPulse Performance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <main class="auth-card" aria-labelledby="login-title">
        <a class="auth-brand" href="index.php">
            <span class="brand-mark">CP</span>
            <span>CivicPulse</span>
        </a>

        <h1 id="login-title" class="auth-heading">Welcome back</h1>
        <p class="auth-subtitle">Sign in to manage your vehicle parts orders and appointments.</p>

        <?php if ($successMessage !== ''): ?>
            <div id="auth-success-msg" class="alert-success-box"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>

        <?php if ($errorMessage !== ''): ?>
            <div id="auth-error-msg" class="alert-error-box"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
            <div class="form-group">
                <label class="form-label" for="username">Email address or admin username</label>
                <input
                    class="form-control-custom"
                    type="text"
                    id="username"
                    name="username"
                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                    placeholder="driver@example.com or admin"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input
                    class="form-control-custom"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <div class="form-options">
                <label class="check-row" for="remember">
                    <input type="checkbox" id="remember" name="remember">
                    <span>Remember me</span>
                </label>
                <a class="text-link" href="#">Forgot password?</a>
            </div>

            <button class="auth-button" type="submit">Log in</button>
        </form>

        <p class="auth-switch">
            Don't have an account?
            <a href="register.php">Create an account</a>
        </p>
    </main>
</body>
</html>
