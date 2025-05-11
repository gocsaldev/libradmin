<?php
$_POST["navbar"] = 1;
include('authentication.php');
include("includes/header.php");
include("includes/footer.php");

?>
<button id="scrollToTop" onclick="scrollToTop()">⬆</button>
<script>
    window.onscroll = function () {
        const scrollButton = document.getElementById('scrollToTop');
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    };

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php
            if (isset($_SESSION['status'])) {
                echo "<br>";
                echo "<h5 class='alert alert-success'>" . $_SESSION['status'] . "</h5>";
                unset($_SESSION["status"]);
            }
        ?>
        
            <div class="card">
                <div class="card-header">
                    <h4>
                        Keresési eredmények
                        <a href="kolcsonzok.php" class="btn btn-danger float-end">Vissza</a>
                    </h4>
                </div>
                <div class="card-body" style="overflow: scroll;">
                    <table class="table table-bordered table striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Név</th>
                                <th>Cím</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Reg. idő</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("dbcon.php");

                            $ref_table = "loaners";
                            $fetchdata = $database->getReference($ref_table)->getValue();

                            $searchParams = $_SESSION['search_params'] ?? [];

                            if (!empty($fetchdata) && is_array($fetchdata)) {
                                $i = 1;
                                foreach ($fetchdata as $key => $row) {
                                    if (!is_array($row)) continue;

                                    // Determine which field to search based on the provided search parameters
                                    $match = false;
                                    if (!empty($searchParams['name'])) {
                                        $match = stripos($row['name'], $searchParams['name']) !== false;
                                    } elseif (!empty($searchParams['add'])) {
                                        $match = stripos($row['add'], $searchParams['add']) !== false;
                                    } elseif (!empty($searchParams['email'])) {
                                        $match = stripos($row['email'], $searchParams['email']) !== false;
                                    } elseif (!empty($searchParams['phone'])) {
                                        $match = stripos($row['phone'], $searchParams['phone']) !== false;
                                    }

                                    // If a match is found, display the row
                                    if ($match) {
                            ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= htmlspecialchars($row['name'] ?? ''); ?></td>
                                            <td><?= htmlspecialchars($row['add'] ?? ''); ?></td>
                                            <td><?= htmlspecialchars($row['email'] ?? ''); ?></td>
                                            <td><?= htmlspecialchars($row['phone'] ?? ''); ?></td>
                                            <td><?= htmlspecialchars($row['date'] ?? ''); ?></td>
                                            <td>
                                                <!-- Edit -->
                                                <a href="edit_loaner.php?id=<?= $key; ?>" class="btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                    </svg>
                                                </a>
                                                <!-- Delete Trigger -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-key="<?= $key ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
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

<!-- Delete Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Törlés visszaigazolás</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    Biztosan törölni szeretné?<br>
                    A törlés <strong>nem</strong> visszavonható!
                    <input type="hidden" name="delete_key" id="deleteKey">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                    <button type="submit" name="delete-loaner" class="btn btn-danger" value="<?= $key; ?>">Törlés</button>
                </div>
            </form>
        </div>
    </div>
</div>

<button id="scrollToTop" onclick="scrollToTop()">⬆</button>

<script>
    // Show or hide the "Scroll to Top" button based on scroll position of the card-body
    const cardBody = document.querySelector('.card-body');
    const scrollToTopButton = document.getElementById('scrollToTop');

    cardBody.addEventListener('scroll', function () {
        if (cardBody.scrollTop > 200) {
            scrollToTopButton.style.display = 'block';
        } else {
            scrollToTopButton.style.display = 'none';
        }
    });

    // Scroll to the top of the card-body
    function scrollToTop() {
        cardBody.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
