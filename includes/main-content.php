  <div class="container">
    <div class="hero-card type-r-bg" id="performance">
      <div class="content">
        <h1>Honda Civic Type R</h1>
        <p>
          Precision engineering, a turbocharged 2.0L engine, and track-bred aerodynamics make the Civic Type R a performance icon built for the road and the circuit.
        </p>
        <a href="#models" class="btn">Explore Civic models</a>
        <a href="<?php echo isset($_SESSION['loggedUser']) ? 'landing.php' : 'register.php'; ?>" class="btn btn-secondary">
          <?php echo isset($_SESSION['loggedUser']) ? 'Go to dashboard' : 'Join CivicPulse'; ?>
        </a>
      </div>
      <div class="animated-car-overlay"></div>
    </div>

    <div class="hero-card classic-bg" id="models">
      <div class="content">
        <h1>Honda Civic Sedan</h1>
        <p>
          A sharper, more refined take on the everyday sedan. Explore a Civic shaped around confident handling, thoughtful comfort, and modern technology.
        </p>
        <a href="<?php echo isset($_SESSION['loggedUser']) ? 'landing.php' : 'register.php'; ?>" class="btn">
          <?php echo isset($_SESSION['loggedUser']) ? 'View dashboard' : 'Create your account'; ?>
        </a>
      </div>
    </div>
  </div>
