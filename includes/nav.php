  <nav class="navbar" aria-label="Main navigation">
    <a href="index.php" class="nav-brand">
      <div class="nav-logo">CivicPulse</div>
      <div class="japanese-sub">
        <span>PERFORMANCE</span>
        <span>HONDA CIVIC</span>
      </div>
    </a>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </label>

    <ul class="nav-links">
      <li><a href="#home" class="active">Home</a></li>
      <li><a href="#models">Models</a></li>
      <li><a href="#performance">Type R</a></li>
      <?php if (isset($_SESSION['loggedUser'])): ?>
        <li><a href="landing.php" class="btn-nav">Dashboard</a></li>
        <li><a href="landing.php?logout=1" class="btn-nav">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php" class="btn-nav">Account Login</a></li>
        <li><a href="register.php" class="btn-nav">Create Account</a></li>
      <?php endif; ?>
    </ul>
  </nav>
