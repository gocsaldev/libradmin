<?php
include('authentication.php');
include("includes/header.php");
?>
<br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Kölcsönző szerkesztése
                            <a href="kolcsonzok.php" class="btn btn-danger float-end">Vissza</a>
                        </h4>
                    </div>
                    <div class="card-body" style= "overflow: scroll;">

                            <?php
                                include("dbcon.php");
                                
                                if(isset($_GET["id"])){
                                    $key_child = $_GET['id'];
                                    $ref_table = "loaners";
                                    $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                                    if($getdata > 0){
                                ?>
                            
                <form action="code.php" method="POST">
                <input type="hidden" name="key" value="<?=$key_child;?>">
                <div class="form-group mb-3">
                <label for="">Név</label>
                <input type="text" name="name" class="form-control" value="<?=$getdata['name'];?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="">Cím</label>
                    <input type="text" name="add" class="form-control" value="<?=$getdata['add'];?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="">Email cím</label>
                    <input type="text" name="email" class="form-control" value="<?=$getdata['email'];?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="">Telefonszám</label>
                    <input type="text" name="phone" class="form-control" value="<?=$getdata['phone'];?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="">Regisztrálás ideje</label>
                    <input type="text" name="" class="form-control" value="<?=$getdata['date'];?>" disabled>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" name="update-loaner" class="btn btn-primary">Szerkesztés</button>
                </div>
                </div>
                </form>

                            <?php

                                    } else {
                                        $_SESSION['status'] = "Invalid Id";
                                        header("Location: index.php");
                                        exit();
                                    }
                                }  else {
                                    $_SESSION['status'] = "Not found";
                                    header("Location: index.php");
                                    exit();
                                }
                            ?>

                    


<?php
include("includes/footer.php");
?>