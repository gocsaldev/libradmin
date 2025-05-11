<?php
session_start();
if (isset($_SESSION['verified_user_id'])) {
    $_SESSION['status'] = "Már be vagy jelentkezve!";
    header('Location: allomany.php');
    exit();
}
include("includes/header.php");
include("includes/footer.php");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <br>
            <?php
            if (isset($_SESSION['status'])) {
                echo "<h5 class='alert alert-success'>" . $_SESSION['status'] . "</h5>";
                unset($_SESSION["status"]);
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Bejelentkezés
                    </h4>
                </div>
                <div class="card-body">
                    <form action="logincode.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Jelszó</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="login_btn" class="btn btn-primary">Bejelentkezés</button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registration">Regisztráció</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration modal -->
<div class="modal fade" id="registration" tabindex="-1" aria-labelledby="registration" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Regisztráció</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Az oldal eléréséhez kérjük, keresse fel az egyik fejlesztőt!</p>
                <p>Gocsál Mátyás: gocsaldev@gmail.com<br>
                Petrétei Bence: petreteibence6@gmail.com<p>
            </div>
        </div>
    </div>
</div>
