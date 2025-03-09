<?php
include('authentication.php');
include("dbcon.php");
include('includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_SESSION['status'])){
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                }
            ?>

            <h2>Home page</h2>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>