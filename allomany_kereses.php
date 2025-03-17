<?php
include('authentication.php');
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
                        Keresési eredmények
                    </h4>
                </div>
                <div class="card-body" style= "overflow: scroll;">
                        <table class="table table-bordered table striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cím</th>
                                <th>Alcím</th>
                                <th>Szerző</th>
                                <th>Csoportosítás</th>
                                <th>Leltári szám</th>
                                <th>Kiadási év</th>
                                <th>Fizikai elhelyezkedés</th>
                                <th>Állapot</th>
                                <th>Érték</th>
                                <th>Kölcsönözhető?</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                include("dbcon.php");

                                $ref_table = "books";
                                $fetchdata = $database->getReference($ref_table)->getValue();

                                $searchParams = $_SESSION['search_params'] ?? [];

                                if (!empty($fetchdata) && is_array($fetchdata)) {
                                    $i = 1;
                                    foreach ($fetchdata as $key => $row) {
                                        if (!is_array($row)) continue;

                                        // Determine which field to search based on the provided search parameters
                                        $match = false;
                                        if (!empty($searchParams['title'])) {
                                            $match = stripos($row['title'], $searchParams['title']) !== false;
                                        } elseif (!empty($searchParams['sec_title'])) {
                                            $match = stripos($row['sec_title'], $searchParams['sec_title']) !== false;
                                        } elseif (!empty($searchParams['writer'])) {
                                            $match = stripos($row['writer'], $searchParams['writer']) !== false;
                                        } elseif (!empty($searchParams['category'])) {
                                            $match = stripos($row['category'], $searchParams['category']) !== false;
                                        } elseif (!empty($searchParams['whouse_id'])) {
                                            $match = stripos($row['whouse_id'], $searchParams['whouse_id']) !== false;
                                        } elseif (!empty($searchParams['rel_year'])) {
                                            $match = stripos($row['rel_year'], $searchParams['rel_year']) !== false;
                                        } elseif (!empty($searchParams['spot'])) {
                                            $match = stripos($row['spot'], $searchParams['spot']) !== false;
                                        } elseif (!empty($searchParams['condition'])) {
                                            $match = stripos($row['condition'], $searchParams['condition']) !== false;
                                        } elseif (!empty($searchParams['worth'])) {
                                            $match = stripos($row['worth'], $searchParams['worth']) !== false;
                                        } elseif (!empty($searchParams['rentable'])) {
                                            $match = stripos($row['rentable'], $searchParams['rentable']) !== false;
                                        }

                                        // If a match is found, display the row
                                        if ($match) {
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
                                                    </div></td>
                                                <td>
                                                    <!-- Edit -->
                                                    <a href="edit_book.php?id=<?= $key; ?>" class="btn btn-primary btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                        </svg>
                                                    </a>
                                                    <!-- Delete Trigger -->
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#staticBackdrop"
                                                            data-key="<?= $key ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">No Record Found</td>
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
            <form action="code.php" method="POST">
                <button type="submit" name="delete-entry" value="<?=$key;?>" class="btn btn-danger">Törlés</button>
            </form>
        </div>
        </div>
    </div>
    </div>

<?php
    include("includes/footer.php");
?>