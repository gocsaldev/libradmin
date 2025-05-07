<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="max-height: 56px;">
  <div class="container">
<!--<a class="navbar-brand" href="index.php">Libradmin</a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <?php if(!isset($_SESSION['verified_user_id'])): ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'login.php') ? 'active' : '' ?>" href="login.php">Bejelentkezés</a>
        </li>
        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Főoldal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'allomany.php') ? 'active' : '' ?>" href="allomany.php">Állomány</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'kolcsonzok.php') ? 'active' : '' ?>" href="kolcsonzok.php">Kölcsönzők</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'statisztika.php') ? 'active' : '' ?>" href="statisztika.php">Statisztika</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Kijelentkezés</a>
        </li>
        <?php endif; ?>
      </ul>
      <div class="ms-auto">
        <div id="currentTime" class="time-display"></div>
      </div>
    </div>
  </div>
</nav>

<script>
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString();
    document.getElementById('currentTime').textContent = `Jelenlegi idő: ${timeString}`;
}

// Call immediately and then every second
updateTime();
setInterval(updateTime, 1000);
</script>

<style>
.time-display {
    background-color: #d2b48c; /* Bézs */
    color: #4a2f1b; /* Barna szöveg */
    font-weight: bold;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    transition: background-color 0.3s;
    text-align: center;
    display: inline-block;
}

.time-display:hover {
    background-color: #8b5e3c; /* Barna hover szín */
    color: white;
}

/* Bootstrap override for active links */
.nav-link.active {
    font-weight: bold;
    background-color: rgba(0,0,0,0.1);
    border-radius: 5px;
}
</style>