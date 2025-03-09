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
                            Könyv szerkesztés
                            
                            <a href="allomany.php" class="btn btn-danger float-end">Vissza</a>
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Kölcsönzés
                            </button>
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
                        <select name="category" class="form-control">
                            <option value="Regény" <?= ($getdata['category'] == 'Regény') ? 'selected' : ''; ?>>Regény</option>
                            <option value="Dráma" <?= ($getdata['category'] == 'Dráma') ? 'selected' : ''; ?>>Dráma</option>
                            <option value="Ismeretterjesztő" <?= ($getdata['category'] == 'Ismeretterjesztő') ? 'selected' : ''; ?>>Ismeretterjesztő</option>
                            <option value="Tartós tankönyv" <?= ($getdata['category'] == 'Tartós tankönyv') ? 'selected' : ''; ?>>Tartós tankönyv</option>
                            <option value="Munkafüzet" <?= ($getdata['category'] == 'Munkafüzet') ? 'selected' : ''; ?>>Munkafüzet</option>
                            <option value="Vers" <?= ($getdata['category'] == 'Vers') ? 'selected' : ''; ?>>Vers</option>
                            <option value="Mese" <?= ($getdata['category'] == 'Mese') ? 'selected' : ''; ?>>Mese</option>
                            <option value="Hanganyag" <?= ($getdata['category'] == 'Hanganyag') ? 'selected' : ''; ?>>Hanganyag</option>
                        </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Leltári szám</label>
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
                    <select name="condition" class="form-control">
                                <option value="Új" <?= ($getdata['condition'] == 'Új') ? 'selected' : ''; ?>>Új</option>
                                <option value="Újszerű" <?= ($getdata['condition'] == 'Újszerű') ? 'selected' : ''; ?>>Újszerű</option>
                                <option value="Megőrzött" <?= ($getdata['condition'] == "Megőrzött") ? 'selected' : '' ?>>Megőrzött</option>
                                <option value="Használt" <?= ($getdata['condition'] == "Használt") ? 'selected' : '' ?>>Használt</option>
                                <option value="Sérült" <?= ($getdata['condition'] == "Sérült") ? 'selected' : '' ?>>Sérült</option>
                                <option value="Selejt" <?= ($getdata['condition'] == "Selejt") ? 'selected' : '' ?>>Selejt</option>
                            </select>
                    </div>
                <div class="form-group mb-3">
                    <label for="">Érték (Ft)</label>
                    <input type="number" name="worth" class="form-control" value="<?= $getdata['worth']; ?>"">
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

                    
<!-- Modal -->
<form action="code.php" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kölcsönzés</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="key" value="<?=$key_child;?>">
                    <div class="form-group mb-3">
                        <label for="">Név</label>
                        <input type="text" name="rent_name" class="form-control" value="<?= $getdata['rent_name']; ?>"">
                    </div>            
                <div class="form-group mb-3">
                    <label for="">Kezdeti dátum</label>
                    <input type="date" name="rent_date1" class="form-control" value="<?= $getdata['rent_date1']; ?>"">
                </div>
                    <div class="form-group mb-3">
                        <label for="">Vége dátum</label>
                        <input type="date" name="rent_date2" class="form-control" value="<?= $getdata['rent_date2']; ?>"">
                    </div>
                </div>
                <div class="modal-footer">                
                    <button type="submit" name="update-book" class="btn btn-primary">Mentés</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php
include("includes/footer.php");
?>