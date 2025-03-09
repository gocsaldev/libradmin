<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Libradmin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <?php if(!isset($_SESSION['verified_user_id'])): ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Bejelentkezés</a>
        </li>
        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="allomany.php">Állomány</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="kolcsonzok.php">Kölcsönzők</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="statisztika.php">Statisztika</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="nevjegy.php">Névjegy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">Kijelentkezés</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>