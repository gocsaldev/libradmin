<?php
include("includes/header.php");
?>
<br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Könyv szerkesztése
                            <a href="allomany.php" class="btn btn-danger float-end">Vissza</a>
                        </h4>
                    </div>
                    <div class="card-body">

                            <?php
                                include("dbcon.php");
                                
                                if(isset($_GET["id"])){
                                    $key_child = $_GET['id'];
                                    $ref_table = "books";
                                    $getdata = $database->getReference('books')->getChild($key_child)->getValue();

                                    if($getdata > 0){
                                ?>
                            
                <form action="code.php" method="POST">
                <input type="hidden" name="key" value="<?=$key_child;?>">
                <div class="form-group mb-3">
                    <label for="">Cím</label>
                    <input type="text" name="title" class="form-control" value="<?=$getdata['title'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Alcím</label>
                    <input type="text" name="sec_title" class="form-control" value="<?=$getdata['sec_title'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Szerző</label>
                    <input type="text" name="writer" class="form-control" value="<?=$getdata['writer'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Csoportosítás</label>
                    <input type="text" name="category" class="form-control" value="<?=$getdata['category'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Raktári szám</label>
                    <input type="text" name="whouse_id" class="form-control" value="<?=$getdata['whouse_id'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Megjelenés éve</label>
                    <input type="number" name="rel_year" class="form-control" value="<?=$getdata['rel_year'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Lelőhely</label>
                    <input type="text" name="spot" class="form-control" value="<?=$getdata['spot'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="">Állapot</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault1" value="Új" <?= ($getdata['condition'] == 'Új') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Új
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault2" value="Újszerű" <?= ($getdata['condition'] == 'Újszerű') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Újszerű
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault3" value="Megőrzött" <?= ($getdata['condition'] == 'Megőrzött') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault3">
                            Megőrzött
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault4" value="Használt" <?= ($getdata['condition'] == 'Használt') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Használt
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault5" value="Sérült" <?= ($getdata['condition'] == 'Sérült') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault5">
                            Sérült
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault6" value="Selejt" <?= ($getdata['condition'] == 'Selejt') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexRadioDefault6">
                            Selejt
                        </label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Érték (Ft)</label>
                    <input type="text" name="worth" class="form-control">
                </div>
                <div class="form-group mb-3">
                <input class="form-check-input" type="checkbox" name="rentable" value="rentable" id="flexCheckDefault" <?= (($getdata['rentable'] ?? '') == 'rentable') ? 'checked' : ''; ?>> 
                <label class="form-check-label" for="flexCheckDefault">
                    Bérelhető?
                </label>
            </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" name="update-book" class="btn btn-primary">Szerkesztés</button>
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