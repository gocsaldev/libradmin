<?php
    session_start();
    include("includes/header.php");
?>

<div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                if(isset($_SESSION['status'])){
                    echo "<br>";
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION["status"]);
                }
            ?>
            <br>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Leltárban lévő könyvek
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookAddModal">
                            Könyv felvétele
                            </button>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Cím</th>
                                    <th>Alcím</th>
                                    <th>Szerző</th>
                                    <th>Kategória</th>
                                    <th>Raktári szám</th>
                                    <th>Kiadási év</th>
                                    <th>Fizikai elhelyezkedés</th>
                                    <th>Állapot</th>
                                    <th>Érték</th>
                                    <th>Bérelhető?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include("dbcon.php");

                                    $ref_table = "books";
                                    $fetchdata = $database->getReference($ref_table)->getValue();

                                    // Check if $fetchdata is a non-empty array
                                    if (!empty($fetchdata) && is_array($fetchdata)) {
                                        $i = 1;
                                        foreach ($fetchdata as $key => $row) {
                                            // Skip entries where $row is not an array
                                            if (!is_array($row)) {
                                                continue;
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= htmlspecialchars($row['title'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['sec_title'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['writer'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['category'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['whouse_id'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['rel_year'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['spot'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['condition'] ?? ''); ?></td>
                                                <td><?= htmlspecialchars($row['worth'] ?? ''); ?></td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input type="checkbox" 
                                                            class="form-check-input" 
                                                            <?= ($row['rentable'] ?? '') === 'rentable' ? 'checked' : '' ?>
                                                            disabled>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- Edit -->
                                                    <a href="edit_book.php?id=<?= $key; ?>" class="btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                    </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Delete -->
                                                    <form action="code.php" method="POST">
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                    </svg>
                                                    </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="11">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <br>
     <!--add Modal-->
     <form action="code.php" method="POST">
    <div class="modal fade" id="bookAddModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="bookModalLabel">Könyv felvétele</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="code.php" method="POST">
            <div class="form-group mb-3">
                <label for="">Cím</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="">Alcím</label>
                <input type="text" name="sec_title" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Szerző</label>
                <input type="text" name="writer" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="">Csoportosítás</label>
                <input type="text" name="category" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Raktári szám</label>
                <input type="text" name="whouse_id" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Megjelenés éve</label>
                <input type="number" name="rel_year" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Lelőhely</label>
                <input type="text" name="spot" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="">Állapot</label>
                <!--<input type="text" name="condition" class="form-control">-->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault1" value="Új" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Új
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault2" value="Újszerű">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Újszerű
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault2" value="Megőrzött">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Megőrzött
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault2" value="Használt">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Használt
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault2" value="Sérült">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Sérült
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="condition" id="flexRadioDefault2" value="Selejt">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Selejt
                    </label>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="">Érték (Ft)</label>
                <input type="text" name="worth" class="form-control">
            </div>
            <div class="form-group mb-3">
                <input class="form-check-input" type="checkbox" name="rentable" value="rentable" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Bérelhető?
                </label>
            </div>
            <div class="form-group mb-3">
                <button type="submit" name="new-entry" class="btn btn-primary">Könyv felvétele</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    </form>

    <!--delete modal-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Törlés visszaigazolás</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Biztosan törölni szeretné?<br>
            A törlés <strong>nem</strong> visszavonható!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
            <button type="submit" name="delete-entry" class="btn btn-danger">Törlés</button>
        </div>
        </div>
    </div>
    </div>

    


<?php
    include("includes/footer.php");
?>